<?php

namespace App\Services\Import\Google;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Services\Import\ImportStrategy;

class Importer implements ImportStrategy
{
    private Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function support(string $type): bool
    {
        return $type === 'google';
    }

    public function import(): void
    {
        var_dump('google');
        return;
        $data = $this->client->getData();

        foreach ($data['items'] as $item) {
            if (!isset($item['volumeInfo'])) {
                continue;
            }
            $bookInfo = $item['volumeInfo'];
            $category = null;

            if (isset($bookInfo['categories']) && $bookInfo['categories']) {
                $category = Category::where('name', '=', $bookInfo['categories'][0])->first();

                if (!$category) {
                    $category = new Category();
                    $category->name = $bookInfo['categories'][0];
                    $category->active = true;
                    $category->save();
                }
            }

            $book = new Book();
            $book->name = $bookInfo['title'] ?? null;
            $book->description = $bookInfo['description'] ?? null;
            $book->year = isset($bookInfo['publishedDate']) ? (new \DateTime($bookInfo['publishedDate']))->format('Y') : null;
            $book->pages = $bookInfo['pageCount'] ?? null;
            $book->format = $bookInfo['printType'] ?? null;
            $book->language = $bookInfo['language'] ?? null;
            $book->category_id = $category ? $category->id : 1;
            $book->sku = uniqid();
            $book->iban = isset($bookInfo['industryIdentifiers']) ? $bookInfo['industryIdentifiers'][0]['identifier'] : null;
            $book->save();

            if (isset($bookInfo['authors'])) {
                foreach ($bookInfo['authors'] as $author) {
                    $authorEntity = new Author();
                    $authorEntity->first_name = $author;
                    $authorEntity->last_name = '';
                    $authorEntity->save();
                    $book->authors()->attach($authorEntity);
                    $book->save();
                }
            }
        }
    }
}
