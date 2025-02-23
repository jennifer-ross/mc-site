<?php

namespace App\Observers;

use App\Enums\ChatType;
use App\Enums\ChatUserRole;
use App\Models\Chat;

class ChatObserver
{
	/**
	 * Handle the Chat "created" event.
	 */
	public function created(Chat $chat): void
	{
		$chat->addUser($chat->owner_id, $chat->type !== ChatType::Private ? ChatUserRole::Admin : ChatUserRole::Member);
	}

	/**
	 * Handle the Chat "updated" event.
	 */
	public function updated(Chat $chat): void
	{
		//
	}

	/**
	 * Handle the Chat "deleted" event.
	 */
	public function deleted(Chat $chat): void
	{
		//
	}

	/**
	 * Handle the Chat "restored" event.
	 */
	public function restored(Chat $chat): void
	{
		//
	}

	/**
	 * Handle the Chat "force deleted" event.
	 */
	public function forceDeleted(Chat $chat): void
	{
		//
	}
}
