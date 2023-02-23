<?php

namespace App\View\Components\Cube\Auth;

use App\Models\User;
use Illuminate\View\Component;

class Topbar extends Component
{
    /**
     * @var User|null
     */
    public User|null $user = null;

    /**
     * @var string
     */
    public string $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User|null $user = null, string $title = "")
    {
        $this->user = $user;

        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cube.auth.topbar');
    }
}
