<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public function render(): View
    {
        return view('layouts.app');
    }
}
