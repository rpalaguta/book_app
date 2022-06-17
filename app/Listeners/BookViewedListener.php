<?php

namespace App\Listeners;

use App\Events\BookVIewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BookViewedListener
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
     * @param  \App\Events\BookVIewed  $event
     * @return void
     */
    public function handle(BookVIewed $event)
    {
        dd('pagavom event' . get_class($event));
    }
}
