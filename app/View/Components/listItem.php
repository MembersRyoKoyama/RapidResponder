<?php

namespace App\View\Components;

use Illuminate\View\Component;

class listItem extends Component
{
    public $question;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($question)
    {
        $this->question = $question;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.list-item');
    }
}
