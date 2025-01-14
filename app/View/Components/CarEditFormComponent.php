<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use function Termwind\render;

class CarEditFormComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct($car, $i)
    {
        $this->car = $car;
        $this->i = $i;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.car-edit-form-component', ['car' => $this->car, 'i' => $this->i]);
    }
}
