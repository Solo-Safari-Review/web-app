<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public $review, $showUrl, $editUrl, $deleteUrl;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $review,
        $showUrl = "",
        $editUrl = "",
        $deleteUrl = "")
    {
        $this->review = $review;
        $this->showUrl = $showUrl;
        $this->editUrl = $editUrl;
        $this->deleteUrl = $deleteUrl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-button');
    }
}
