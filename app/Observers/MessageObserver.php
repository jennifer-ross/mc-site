<?php

namespace App\Observers;

use App\Models\Chat;
use App\Models\Message;
use Psr\SimpleCache\InvalidArgumentException;

class MessageObserver
{
	/**
	 * Handle the Message "created" event.
	 * @throws InvalidArgumentException
	 */
    public function created(Message $message): void
    {
		/* @var Chat $chat */
		$chat = Chat::getFromCacheById($message->chat_id);
		$chat->setLastMessage($message);
        $message->cache();
    }

	/**
	 * Handle the Message "updated" event.
	 * @throws InvalidArgumentException
	 */
    public function updated(Message $message): void
    {
		/* @var Chat $chat */
		$chat = Chat::getFromCacheById($message->chat_id);
		$chat->setLastMessage($message);
		$message->cache();
    }

	/**
	 * Handle the Message "deleted" event.
	 * @throws InvalidArgumentException
	 */
    public function deleted(Message $message): void
    {
		/* @var Chat $chat */
		$chat = Chat::getFromCacheById($message->chat_id);
		$chat->setLastMessage();
		$message->removeCache();
    }

	/**
	 * Handle the Message "restored" event.
	 * @throws InvalidArgumentException
	 */
    public function restored(Message $message): void
    {
		/* @var Chat $chat */
		$chat = Chat::getFromCacheById($message->chat_id);
		$chat->setLastMessage($message);
		$message->cache();
    }

	/**
	 * Handle the Message "force deleted" event.
	 * @throws InvalidArgumentException
	 */
    public function forceDeleted(Message $message): void
    {
		/* @var Chat $chat */
		$chat = Chat::getFromCacheById($message->chat_id);
		$chat->setLastMessage();
		$message->removeCache();
    }
}
