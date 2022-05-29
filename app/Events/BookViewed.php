<?php

namespace App\Events;

use App\Models\Book;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use DateTime;

class BookViewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Book */
    public $book;

    /** @var DateTime */
    public $viewedAt;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Book $book, DateTime $viewedAt)
    {
        $this->book = $book;
        $this->viewedAt = $viewedAt;
    }
}
