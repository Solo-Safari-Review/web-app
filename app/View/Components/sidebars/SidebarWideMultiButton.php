<?php

namespace App\View\Components\sidebars;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarWideMultiButton extends Component
{
    public $dropdownId, $multiItems;
    /**
     * Create a new component instance.
     */
    public function __construct($dropdownId, $multiItems = [])
    {
        $this->dropdownId = $dropdownId;
        $this->multiItems = $multiItems;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebars.sidebar-wide-multi-button');
    }
}
