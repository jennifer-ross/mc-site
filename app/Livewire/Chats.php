<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\ChatParticipant;
use App\Models\User;
use App\Services\ChatService;
use Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\SchemaOrg\Schema;

class Chats extends Component
{
    use WithPagination;

    public $chats = [];

    public function mount(ChatService $chatService): void
    {
        $this->chats = $chatService->getChats();
    }

    /**
     * Render the component.
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

        return view('livewire.chats', [
            'chats' => collect($this->chats),
            'count' => count($this->chats),
        ]);
    }
}
