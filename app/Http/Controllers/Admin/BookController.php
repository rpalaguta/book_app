<?php

namespace App\Http\Controllers\Admin;

use App\Events\BookViewed;
use App\Http\Controllers\Controller;
use App\Mail\BookCreated;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends Controller
{
    public const DELIMETER = ';';
    private const BOOK_CACHE_TTL = 86400;
    private const BOOK_CACHE_KEY_PATTERN = 'book_%s';
    private const BOOK_LIST_CACHE_KEY_PATTERN = 'book_list_v2';

    public function list(): View
    {
        $books = Cache::remember(
            self::BOOK_LIST_CACHE_KEY_PATTERN,
            self::BOOK_CACHE_TTL,
            function () {
                return Book::withTrashed()->with('category')->get();
            }
        );

        //$books = Book::withTrashed()->with('category')->get();

        BookViewed::dispatch($books->first(), new \DateTime());

        return view('admin.book.list', [
            'books' => $books,
            'count' => 30,
        ]);
    }

    /**
     * @param Book $book
     * @return RedirectResponse
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect(route('admin.book'))->with('success', 'Book deleted successfully!');
    }

    public function create(Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|between:2,255',
                'category_id' => 'required',
                'image|mimes:jpeg,jpg,png:max:4096',
            ]);

            $book = Book::create($request->all());

            $authors = Author::find($request->post('author_id'));
            $book->authors()->attach($authors);

            $imagePath = Storage::disk('digitalocean')->putFile('public/books', $request->file('book_image'));
            //$imagePath = $request->file('book_image')->store('public/books');
            //$imagePath = Storage::putFile('books', new File($request->book_image));
            //$imagePath = Storage::putFile('books', $request->file('book_image'));
            //$book->image = Storage::disk('digitalocean')->url($imagePath);
            $book->image = $imagePath;
            $book->save();

            Mail::later(now()->addSeconds(30), new BookCreated($book, Auth::user()));
            Cache::forget(sprintf(self::BOOK_LIST_CACHE_KEY_PATTERN));
            Log::notice('Book created new book');

            return redirect('admin/book')
                ->with('success', 'Book created successfully!');
        }

        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->get()
        ;

        $authors = Author::all();

        return view('admin.book.create', compact('categories', 'authors'));
    }

    public function edit(Book $book, Request $request): View|RedirectResponse
    {
        BookViewed::dispatch($book, new \DateTime());

        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|between:2,255',
                'category_id' => 'required',
            ]);

            $book->update($request->all());

            $book->authors()->detach();
            $authors = Author::find($request->post('author_id'));
            $book->authors()->attach($authors);

            if ($request->file('book_image')) {
                $imagePath = Storage::disk('digitalocean')->putFile('public/books', $request->file('book_image'));
                $book->image = $imagePath;
                $book->save();
            }

            //BookUpdated::dispatch($book->id);

            Cache::forget(sprintf(self::BOOK_CACHE_KEY_PATTERN, $book->id));
            //cache()->forget(sprintf(self::BOOK_CACHE_KEY_PATTERN, $book->id));

            return redirect(route('admin.book.show', $book->id))
                ->with('success', 'Book created successfully!');
        }

        return view('admin.book.edit', [
            'categories' => Category::whereNull('category_id')->with('childrenCategories')->get(),
            'authors' => Author::all(),
            'book' => $book,
        ]);
    }

    public function deleteImage(Book $book): RedirectResponse
    {
        Storage::disk('digitalocean')->delete($book->image);

        $book->image = null;
        $book->save();

        return redirect(route('admin.book.edit', $book->id))
            ->with('success', 'Image deleted!');
    }

    public function import(Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            /** @var UploadedFile $file */
            $file = $request->file('file');
            $filePath = $file->getRealPath();
            $row = 1;
            $header = [];
            $records = [];

            $handle = fopen($filePath, "r");
            if ($handle !== false) {
                while (($data = fgetcsv($handle, null, self::DELIMETER)) !== false) {
                    if ($row === 1) {
                        $header = $data;
                        $row++;
                        continue;
                    }
                    $bookData = array_combine($header, $data);
                    $bookData['category_id'] = 1;
                    $records[] = $bookData;
                    $row++;
                }
                fclose($handle);
            }

            Book::upsert($records, ['sku'], $header);

            return redirect(route('admin.book'));
        }

        return view('admin.book.import');
    }

    public function export(): StreamedResponse
    {
        return response()->streamDownload(function () {
            $output = fopen('php://output', 'w');
            fputcsv(
                $output,
                [
                    'sku',
                    'name',
                    'description',
                    'iban',
                    'year',
                    'pages',
                    'language',
                    'format',
                ],
                self::DELIMETER
            );

            Book::chunk(200, function ($books) use ($output) {
                foreach ($books as $book) {
                    fputcsv(
                        $output,
                        [
                            $book->sku,
                            $book->name,
                            $book->description,
                            $book->iban,
                            $book->year,
                            $book->pages,
                            $book->language,
                            $book->format,
                        ],
                        self::DELIMETER
                    );
                }
            });

            fclose($output);
        }, 'file.csv');

        //        ini_set('memory_limit', '12M');

        //        $books = Book::all();
        //        $results = [];

        //        Book::chunk(200, function ($books) {
        //            foreach ($books as $book) {
        //                $results[] = [
        //                    'name' => $book->name,
        //                    'description' => $book->description
        //                ];
        //            }
        //        });

        //        foreach (Book::cursor() as $book) {
        //            $results[] = [
        //                    'name' => $book->name,
        //                    'description' => $book->description
        //                ];
        //        }
    }

    public function show(int $id): View
    {
        //$price = (new PriceFormatter())->format(6);
        //dump($price);

        /*$cacheKey = sprintf(self::BOOK_CACHE_KEY_PATTERN, $id);

        if ($book = Cache::get($cacheKey)) {
            return view('admin.book.show', [
                'book' => $book
            ]);
        }

        $book = Book::find($id);
        Cache::add($cacheKey, $book, self::BOOK_CACHE_TTL);*/

        //dd(Cache::tags(['admin', 'book'])->get(sprintf(self::BOOK_CACHE_KEY_PATTERN, $id)));

        /*$book = Cache::tags(['admin', 'book'])->remember(
            sprintf(self::BOOK_CACHE_KEY_PATTERN, $id),
            self::BOOK_CACHE_TTL,
            function () use ($id) {
                return Book::find($id);
        });*/

        $book = Cache::remember(
            sprintf(self::BOOK_CACHE_KEY_PATTERN, $id),
            self::BOOK_CACHE_TTL,
            function () use ($id) {
                return Book::find($id);
            }
        );

        BookViewed::dispatch($book, new \DateTime());

        return view('admin.book.show', compact('book'));
    }

    public function removeCache(): void
    {
        // Remove all cache
        Cache::flush();
    }
}
