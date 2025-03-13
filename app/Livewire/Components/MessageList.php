<?php

namespace App\Livewire\Components;

use App\Models\Chat;
use App\Services\ChatService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class MessageList extends Component
{
	private $chat;
	public $messages;

	public function mount(int $chatId): void
	{
		$this->chat = Chat::getFromCacheById($chatId);
		$this->messages = $this->chat->messages;
	}

	/**
	 * Get the viewModel
	 */
	public function render(): View|Closure|string
	{
		return view('livewire.message-list', [
			'messages' => $this->messages,
		]);
	}
}
