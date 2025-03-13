<?php

namespace App\Observers;

use App\Models\UserProfile;
use Psr\SimpleCache\InvalidArgumentException;

class UserProfileObserver
{
    /**
     * Handle the UserProfile "created" event.
     */
    public function created(UserProfile $userProfile): void
    {
		$userProfile->cache();
    }

    /**
     * Handle the UserProfile "updated" event.
     */
    public function updated(UserProfile $userProfile): void
    {
		$userProfile->cache();
    }

	/**
	 * Handle the UserProfile "deleted" event.
	 * @throws InvalidArgumentException
	 */
    public function deleted(UserProfile $userProfile): void
    {
		$userProfile->removeCache();
    }

    /**
     * Handle the UserProfile "restored" event.
     */
    public function restored(UserProfile $userProfile): void
    {
		$userProfile->cache();
    }

	/**
	 * Handle the UserProfile "force deleted" event.
	 * @throws InvalidArgumentException
	 */
    public function forceDeleted(UserProfile $userProfile): void
    {
		$userProfile->removeCache();
    }
}
