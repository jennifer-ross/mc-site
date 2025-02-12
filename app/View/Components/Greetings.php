<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Greetings extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the viewModel
     */
    public function render(): View|Closure|string
    {
		$isMinecraftServerOnline = true;
		$currentPlayers = 30;
		$availablePlayers = 40;
		$percentagePlayersOnline = ceil($currentPlayers / $availablePlayers * 100);

        return view('livewire.sections.greetings', [
			'isOnline' => $isMinecraftServerOnline,
			'currentPlayers' => $currentPlayers,
			'availablePlayers' => $availablePlayers,
			'percentagePlayers' => $percentagePlayersOnline,
		]);
    }
}
