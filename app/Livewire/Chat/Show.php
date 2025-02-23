<?php

namespace App\Livewire\Chat;

use App\Concerns\HasPreview;
use App\Models\Chat;
use Illuminate\View\View;
use Livewire\Component;

class Show extends Component
{
    use HasPreview;

    /**
     * The post instance.
     *
     * @var Chat
     */
    public $chat;

	/**
	 * Mount the component.
	 *
	 * @param Chat $chat
	 * @return void
	 */
    public function mount(Chat $chat): void
	{
        $this->chat = Chat::whereId($chat)->firstOrFail();
    }

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
	{
        return view('livewire.chat.show');
    }
}
