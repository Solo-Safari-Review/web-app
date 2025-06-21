<?php

namespace App\View\Components\Modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmSendReview extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $form = "")
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.confirm-send-review');
    }
}
