<?php

namespace App\Livewire\Chat;

use App\Concerns\HasPreview;
use App\Models\Chat;
use App\Services\ChatService;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Livewire\Component;
use Spatie\SchemaOrg\Schema;

class Show extends Component
{
    /**
     * The chat id
     *
     * @var int
     */
	public $chatId;
	/**
	 * The chat instance.
	 *
	 * @var Chat
	 */
	public $currentChat;
	/**
	 * Chats and last message
	 *
	 * @var array
	 */
	public $chats;

	/**
	 * Mount the component.
	 *
	 * @param ChatService $chatService
	 * @param int $chatId
	 * @return void
	 */
    public function mount(ChatService $chatService, int $chatId): void
	{
		$this->currentChat = Chat::getFromCacheById($chatId);
		$this->chats = $chatService->getChats();
    }

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
	{
		seo()
			->title($title = config('app.name'))
			->description($description = 'Lorem ipsum...')
			->canonical($url = route('home'))
			->addSchema(
				Schema::webPage()
					->name($title)
					->description($description)
					->url($url)
					->author(Schema::organization()->name($title))
			);

        return view('livewire.chat.show', [
			'chats' => $this->chats,
			'currentChat' => $this->currentChat,
		]);
    }
}
