<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BookController extends Controller
{
    public const DELIMETER = ';';

    public function list(): View
    {
        $books = Book::withTrashed()->get();

        return view('admin.book.list', compact('books'));
    }

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
            ]);

            $book = Book::create($request->all());

            $authors = Author::find($request->post('author_id'));
            $book->authors()->attach($authors);

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
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|between:2,255',
                'category_id' => 'required',
            ]);

            $book->update($request->all());

            $book->authors()->detach();
            $authors = Author::find($request->post('author_id'));
            $book->authors()->attach($authors);

            return redirect(route('admin.book.show', $book->id))
                ->with('success', 'Book created successfully!');
        }

        return view('admin.book.edit', [
            'categories' => Category::whereNull('category_id')->with('childrenCategories')->get(),
            'authors' => Author::all(),
            'book' => $book
        ]);
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

            if (($handle = fopen($filePath, "r")) !== false) {
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
                    'format'
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
                            $book->format
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

    public function show(Book $book): View
    {
        return view('admin.book.show', compact('book'));
    }
}
