<?php

namespace App\View\Components\Cube;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * @var array
     */
    public array $actions = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cube.card');
    }
}
