<?php

namespace App\Observers;

use App\Models\MessageAttachment;
use Psr\SimpleCache\InvalidArgumentException;

class MessageAttachmentObserver
{
    /**
     * Handle the MessageAttachment "created" event.
     */
    public function created(MessageAttachment $messageAttachment): void
    {
        $messageAttachment->cache();
    }

    /**
     * Handle the MessageAttachment "updated" event.
     */
    public function updated(MessageAttachment $messageAttachment): void
    {
        $messageAttachment->cache();
    }

    /**
     * Handle the MessageAttachment "deleted" event.
     *
     * @throws InvalidArgumentException
     */
    public function deleted(MessageAttachment $messageAttachment): void
    {
        $messageAttachment->removeCache();
    }

    /**
     * Handle the MessageAttachment "restored" event.
     */
    public function restored(MessageAttachment $messageAttachment): void
    {
        $messageAttachment->cache();
    }

    /**
     * Handle the MessageAttachment "force deleted" event.
     *
     * @throws InvalidArgumentException
     */
    public function forceDeleted(MessageAttachment $messageAttachment): void
    {
        $messageAttachment->removeCache();
    }
}
