<?php

namespace App\Observers;

use App\Models\UserBlock;
use Psr\SimpleCache\InvalidArgumentException;

class UserBlockObserver
{
    /**
     * Handle the UserBlocks "created" event.
     */
    public function created(UserBlock $userBlocks): void
    {
        $userBlocks->cache();
    }

    /**
     * Handle the UserBlocks "updated" event.
     */
    public function updated(UserBlock $userBlocks): void
    {
        $userBlocks->cache();
    }

    /**
     * Handle the UserBlocks "deleted" event.
     *
     * @throws InvalidArgumentException
     */
    public function deleted(UserBlock $userBlocks): void
    {
        $userBlocks->removeCache();
    }

    /**
     * Handle the UserBlocks "restored" event.
     */
    public function restored(UserBlock $userBlocks): void
    {
        $userBlocks->cache();
    }

    /**
     * Handle the UserBlocks "force deleted" event.
     *
     * @throws InvalidArgumentException
     */
    public function forceDeleted(UserBlock $userBlocks): void
    {
        $userBlocks->removeCache();
    }
}
