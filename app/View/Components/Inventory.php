<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Inventory extends Component
{
    /**
     * Create a new component instance.
     */
    public ?array $data = [];
    public function __construct( ?array $data = null)
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.inventory');
    }
    
}
