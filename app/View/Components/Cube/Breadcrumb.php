<?php

namespace App\View\Components\Cube;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * @var array
     */
    public array $items = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cube.breadcrumb');
    }
}
