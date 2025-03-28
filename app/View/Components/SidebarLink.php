<?php
namespace App\View\Components;

use Illuminate\View\Component;

class SidebarLink extends Component
{
    public $route;
    public $icon;
    public $text;
    public $params;
    public $activeClass;

    public function __construct($route, $icon, $text, $params = [])
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->text = $text;
        $this->params = $params;
        $this->activeClass = request()->routeIs($route) ? 'active' : '';
    }

    public function render()
    {
        return view('components.sidebar-link');
    }
}
