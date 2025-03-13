<?php

namespace App\Observers;

use App\Models\Media;
use Psr\SimpleCache\InvalidArgumentException;

class MediaObserver
{
    /**
     * Handle the Media "created" event.
     */
    public function created(Media $media): void
    {
        $media->cache();
    }

    /**
     * Handle the Media "updated" event.
     */
    public function updated(Media $media): void
    {
        $media->cache();
    }

    /**
     * Handle the Media "deleted" event.
     *
     * @throws InvalidArgumentException
     */
    public function deleted(Media $media): void
    {
        $media->removeCache();
    }

    /**
     * Handle the Media "restored" event.
     */
    public function restored(Media $media): void
    {
        $media->cache();
    }

    /**
     * Handle the Media "force deleted" event.
     *
     * @throws InvalidArgumentException
     */
    public function forceDeleted(Media $media): void
    {
        $media->removeCache();
    }
}
