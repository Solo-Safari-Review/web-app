<?php

namespace App\View\Components\Sidebars;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarWideButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $route = '#')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebars.sidebar-wide-button');
    }
}
