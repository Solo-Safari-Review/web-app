<?php

namespace App\View\Components\items;

use App\Helpers\HashidsHelper;
use App\Models\Department;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DepartmentReviewsItem extends Component
{
    public $showUrl;

    /**
     * Create a new component instance.
     */
    public function __construct(public ?Department $department)
    {
        $this->showUrl = route('categorized-reviews.show', HashidsHelper::encode($department->id));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.items.department-reviews-item');
    }
}
