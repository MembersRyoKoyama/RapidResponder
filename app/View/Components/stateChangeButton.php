<?php

namespace App\View\Components;

use Illuminate\View\Component;

class stateChangeButton extends Component
{
    public $to, $question;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($question, $to)
    {
        $this->question = $question;
        $this->to = $to;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.state-change-button');
    }
}
