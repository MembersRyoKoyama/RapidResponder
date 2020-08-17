<?php

namespace App\View\Components;

use Illuminate\View\Component;

class endIcon extends Component
{
    public $end;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($end)
    {
        $this->end = $end ?? 1;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.end-icon');
    }
}
