<?php

namespace App\View\Components\Cube\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $originTitle;

    /**
     * @var User|null
     */
    public User|null $user = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title = "")
    {
        $this->originTitle = $title;

        $this->title = $title . ' - ' . env('APP_NAME');

        $this->user = Auth::user() ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cube.auth.layout');
    }
}
