<?php

namespace App\View\Components\Buttons;

use App\Models\Department;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public $departments;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public $id,
        public $showUrl = "",
        public $editUrl = "",
        public $deleteUrl = "",
        public $type,
        public $info = "")
    {
        $this->id = $id;
        $this->showUrl = $showUrl;
        $this->deleteUrl = $deleteUrl;

        if ($type == "review") {
            $this->departments = Department::where('name', '!=', 'Admin Review')->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.buttons.action-button');
    }
}
