<?php

namespace App\Listeners;

use App\Events\BookViewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookViewedDatabaseListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BookViewed  $event
     * @return void
     */
    public function handle(BookViewed $event)
    {
        //update books set viewed_count = viewed_count + 1 where book.id = 4;
        $book = $event->book;
        $book->viewed_count = (int)$book->viewed_count + 1;
        $book->save();
    }
}
