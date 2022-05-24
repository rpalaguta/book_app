<?php

namespace App\Mail;

use App\Models\Book;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private Book $book;
    private User $user;

    public function __construct(Book $book, User $user)
    {
        $this->book = $book;
        $this->user = $user;
    }

    public function build()
    {
        return $this->to($this->user->email)
            ->markdown('emails.book.book_created_mail')
            ->with([
                'book' => $this->book,
            ]);
    }
}
