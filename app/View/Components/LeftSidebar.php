<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LeftSidebar extends Component
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
        return view('components.sidebars.left');
    }
}
