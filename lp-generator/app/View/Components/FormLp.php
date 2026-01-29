<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormLp extends Component
{
    public $page;

    /**
     * Create a new component instance.
     */
    public function __construct($page)
    {
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.form-lp');
    }
}
