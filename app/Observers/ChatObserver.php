<?php

namespace App\Observers;

use App\Enums\ChatType;
use App\Enums\ChatUserRole;
use App\Models\Chat;
use Psr\SimpleCache\InvalidArgumentException;

class ChatObserver
{
	/**
	 * Handle the Chat "created" event.
	 */
	public function created(Chat $chat): void
	{
		$chat->addUser($chat->owner_id, $chat->type !== ChatType::Private ? ChatUserRole::Admin : ChatUserRole::Member);
		$chat->getLastMessage();
		$chat->cache();
	}

	/**
	 * Handle the Chat "updated" event.
	 */
	public function updated(Chat $chat): void
	{
		$chat->cache();
	}

	/**
	 * Handle the Chat "deleted" event.
	 * @throws InvalidArgumentException
	 */
	public function deleted(Chat $chat): void
	{
		$chat->removeCache();
	}

	/**
	 * Handle the Chat "restored" event.
	 */
	public function restored(Chat $chat): void
	{
		$chat->cache();
	}

	/**
	 * Handle the Chat "force deleted" event.
	 * @throws InvalidArgumentException
	 */
	public function forceDeleted(Chat $chat): void
	{
		$chat->removeCache();
	}
}
