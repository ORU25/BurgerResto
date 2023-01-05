<?php

namespace App\View\Components;

use Illuminate\View\Component;

class nav-button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $class;
    public $icon;
    public $label;
    public function __construct($id,$class,$icon,$label)
    {
        $this->id=$id;
        $this->class=$class;
        $this->icon=$icon;
        $this->label=$label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav-button');
    }
}
