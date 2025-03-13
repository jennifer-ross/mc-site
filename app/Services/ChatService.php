<?php

namespace App\Services;

use App\Models\Chat;
use App\Models\ChatParticipant;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ChatService
{
	protected array $chats;

	public function __construct()
	{
		$this->updateChats();
	}

	public function getChats(): array
	{
		return $this->chats;
	}

	public function updateChats(): void
	{
		$userId = Auth::id();

		$usersCacheKey = User::getClassName().":{$userId}:".ChatParticipant::getClassName();
		/* @var ChatParticipant[] $chatParticipants */
		$chatParticipants = Cache::rememberForever($usersCacheKey, function () use ($userId) {
			return ChatParticipant::where(['user_id' => $userId])->get();
		});

		/* @var Chat[] $chats */
		$chats = [];
		foreach ($chatParticipants as $chatParticipant) {
			$chats[] = Chat::getFromCacheById($chatParticipant->chat_id);
		}

		$chatsWithMessage = [];
		foreach ($chats as $chat) {
			if (! $chat) {
				continue;
			}

			$lastMessage = $chat->getLastMessage();
			$chatsWithMessage[] = [
				'chat' => $chat,
				'message' => $lastMessage,
			];
		}

		$this->chats = $chatsWithMessage;
	}
}
