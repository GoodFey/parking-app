<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClientEditFormComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client-edit-form-component', ['client' => $this->client]);
    }
}
