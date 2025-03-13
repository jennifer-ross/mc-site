<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

class UserObserver
{
	/**
	 * Handle the User "created" event.
	 */
	public function created(User $user): void
	{
		$user->cache();
	}

	/**
	 * Handle the User "updated" event.
	 */
	public function updated(User $user): void
	{
		$user->cache();
	}

	/**
	 * Handle the User "deleted" event.
	 * @throws InvalidArgumentException
	 */
	public function deleted(User $user): void
	{
		$user->removeCache();
	}

	/**
	 * Handle the User "restored" event.
	 */
	public function restored(User $user): void
	{
		$user->cache();
	}

	/**
	 * Handle the User "force deleted" event.
	 * @throws InvalidArgumentException
	 */
	public function forceDeleted(User $user): void
	{
		$user->removeCache();
	}
}
