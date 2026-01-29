<?php

namespace App\View\Components;
use Illuminate\View\Component;

class ListLp extends Component
{
    public $landingPages;

    public function __construct($landingPages)
    {
        $this->landingPages = $landingPages;
    }

    public function render()
    {
        return view('components.list-lp');
    }
}
