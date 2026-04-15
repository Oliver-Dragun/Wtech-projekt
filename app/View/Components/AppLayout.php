<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    // Return the view that represents this component.
    public function render(): View
    {
        return view('layouts.app');
    }
}
