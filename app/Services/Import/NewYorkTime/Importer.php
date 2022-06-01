<?php

namespace App\Services\Import\NewYorkTime;

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
        return $type === 'nyt';
    }

    public function import(): void
    {
        var_dump('NYT');
        return;
        $data = $this->client->getData();

        if ($data['status'] === "OK" && $data['num_results'] > 0) {
            $category = new Category();
            $category->name = $data['results']['list_name'];
            $category->active = true;
            $category->save();

            foreach ($data['results']['books'] as $book) {
                $bookEntity = new Book();
                $bookEntity->name = $book['title'];
                $bookEntity->description = $book['description'];
                $bookEntity->iban = $book['primary_isbn10'];
                $bookEntity->sku = uniqid();
                $bookEntity->category_id = $category->id;
                $bookEntity->save();

                $authors = str_replace(" and ", ",", $book['author']);
                $authorsArray = explode(',', $authors);

                foreach ($authorsArray as $author) {
                    $authorEntity = new Author();
                    $authorEntity->first_name = $author;
                    $authorEntity->last_name = "";
                    $authorEntity->save();
                    $bookEntity->authors()->attach($authorEntity);
                    $bookEntity->save();
                }
            }
        }
    }
}
