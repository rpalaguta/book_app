<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AuthorUpdated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}
