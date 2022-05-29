<?php

namespace App\Listeners;

use App\Events\BookUpdated;
use App\Models\Book;

class BookUpdatedListener
{
    public function handle(BookUpdated $event): void
    {
        /** @var Book $book */
        $book = Book::find($event->id);

        if (!$book) {
            return;
        }

        $book->setCreatedAt(new \DateTime('2021-01-01 11:11:11'));
        $book->save();
    }
}
