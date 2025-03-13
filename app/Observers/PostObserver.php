<?php

namespace App\Observers;

use App\Models\Post;
use Psr\SimpleCache\InvalidArgumentException;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $post->cache();
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
		$post->cache();
    }

    /**
     * Handle the Post "deleted" event.
	 * @throws InvalidArgumentException
	 */
    public function deleted(Post $post): void
    {
		$post->removeCache();
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
		$post->cache();
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
		$post->removeCache();
    }
}
