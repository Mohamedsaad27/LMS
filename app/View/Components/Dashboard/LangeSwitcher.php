<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LangeSwitcher extends Component
{
    public $locales;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->locales = LaravelLocalization::getSupportedLocales();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.lange-switcher');
    }
}
