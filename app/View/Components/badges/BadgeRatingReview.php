<?php

namespace App\View\Components\badges;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BadgeRatingReview extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $rating)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.badges.badge-rating-review');
    }
}
