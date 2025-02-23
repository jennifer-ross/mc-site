<?php

namespace App\Livewire;

use App\Models\Message;
use Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Chats extends Component
{
    use WithPagination;

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
	{
        $chats = Auth::user()->chats;
		$chatsWithMessage = [];

		foreach ($chats as $chat) {
			$chatsWithMessage[] = [
				'chat' => $chat,
				'message' => $chat->messages()->where(['is_hidden' => false, 'is_deleted' => false])->latest()->get()->first(),
			];
		}

        return view('livewire.chats', [
			'chats' => collect($chatsWithMessage),
			'count' => count($chats),
		]);
    }
}
