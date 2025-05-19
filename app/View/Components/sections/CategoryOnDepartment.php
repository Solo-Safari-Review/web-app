<?php

namespace App\View\Components\sections;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryOnDepartment extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $categories, public $departmentName)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sections.category-on-department');
    }
}
