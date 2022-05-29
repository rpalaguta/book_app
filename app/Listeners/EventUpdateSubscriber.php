<?php

namespace App\Listeners;

use App\Events\AuthorUpdated;
use App\Events\BookUpdated;

class EventUpdateSubscriber
{
    public function auditBook($event): void
    {
        file_put_contents(
            storage_path() . '/book_audit.log',
            json_encode(
                [
                    'entity_id' => $event->id,
                    'event_class' => get_class($event),
                    'datetime' => date('Y-m-d H:i:s')
                ]
            ) . PHP_EOL,
            FILE_APPEND
        );
    }

    public function auditAuthor($event): void
    {
        file_put_contents(
            storage_path() . '/author_audit.log',
            json_encode(
                [
                    'entity_id' => $event->id,
                    'event_class' => get_class($event),
                    'datetime' => date('Y-m-d H:i:s')
                ]
            ) . PHP_EOL,
            FILE_APPEND
        );
    }

    public function subscribe($events): array
    {
        return [
            BookUpdated::class => 'auditBook',
            AuthorUpdated::class => 'auditAuthor',
        ];
    }
}
