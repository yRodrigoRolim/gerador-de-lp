<?php

namespace App\View\Components;
use Illuminate\View\Component;

class FormEdit extends Component
{
    public $landingPage;

    public function __construct($landingPage)
    {
        $this->landingPage = $landingPage;
    }

    public function render()
    {
        return view('components.form-edit');
    }
}
