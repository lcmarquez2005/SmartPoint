<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ProductForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $action;
    public $type;
    public function __construct($action, int $type = 1)
    {
        $this->action = $action;
        $this->type = $type;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-form');
    }
}
