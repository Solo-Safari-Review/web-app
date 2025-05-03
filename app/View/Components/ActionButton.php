<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public $users;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public $id,
        public $showUrl = "",
        public $deleteUrl = "",
        public $type,
        public $info = "")
    {
        $this->id = $id;
        $this->showUrl = $showUrl;
        $this->deleteUrl = $deleteUrl;

        if ($type == "review") {
            $this->users = User::role('Admin Departemen')->get();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-button');
    }
}
