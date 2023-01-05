<?php

namespace App\View\Components;

use Illuminate\View\Component;

class button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type;
    public $class;
    public $label;
    public $icon;
    public function __construct($type,$class,$label,$icon)
    {
        $this->type=$type;
        $this->class=$class;
        $this->label=$label;
        $this->icon=$icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
