<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionDropdown extends Component
{
    public $itemId;
    public string $route;
    public function __construct(string $route, $itemId)
    {
        $this->itemId = $itemId;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-dropdown');
    }
}
