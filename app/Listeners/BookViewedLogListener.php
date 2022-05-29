<?php

namespace App\Listeners;

use App\Events\BookViewed;

class BookViewedLogListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\BookViewed  $event
     * @return void
     */
    public function handle(BookViewed $event)
    {
        file_put_contents(
            storage_path() . '/books_views.log',
            json_encode(
                [
                    'date' => $event->viewedAt->format('Y-m-d H:i:s'),
                    'name' => $event->book->name,
                ]
            ) . PHP_EOL,
            FILE_APPEND
        );
    }
}
