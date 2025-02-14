<?php

namespace App\Observers;

use App\Enums\ChatUserRole;
use App\Models\Chat;

class ChatObserver
{
    /**
     * Handle the Chat "created" event.
     */
    public function created(Chat $chat): void
    {
		$chat->participants()->create([
			'chat_id' => $chat->id,
			'user_id' => $chat->owner_id,
			'role' => ChatUserRole::Admin
		]);
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
