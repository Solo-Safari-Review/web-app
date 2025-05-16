<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectAll extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $form, public $title, public $message)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-all');
    }
}
