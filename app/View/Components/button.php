<?php

namespace App\View\Components;

use Illuminate\View\Component;

class button extends Component
{
    public $text, $style;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text, $style = 'button')
    {
        $this->text = $text;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.button');
    }
}
