<?php

namespace App\View\Components\Cube\Auth;

use App\Models\User;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * @var array
     */
    public array $items = [];

    /**
     * @var User|null
     */
    public User|null $user = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User|null $user = null)
    {
        $this->items = $this->items();

        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cube.auth.sidebar');
    }

    /**
     * @return array
     */
    public function items()
    {
        return [
            ['type' => 'title', 'title' => 'Navigasi'],

            [
                'type' => 'link',
                'icon' => 'uil uil-apps',
                'url' => route('dashboard'),
                'text' => 'Dashboard',
                'is_active' => request()->routeIs('dashboard*'),
            ],

            ['type' => 'title', 'title' => 'Menu / Item'],

            [
                'type' => 'dropdown',
                'icon' => 'uil uil-user',
                'text' => 'Users',
                'items' => [
                    [
                        'url' => '#',
                        'text' => 'Seller',
                    ],
                    [
                        'url' => '#',
                        'text' => 'Customer',
                    ],
                ],
            ],

            ['type' => 'title', 'title' => 'Report'],

            [
                'type' => 'link',
                'icon' => 'uil uil-file-alt',
                'url' => '#',
                'text' => 'Reports',
            ],

            ['type' => 'title', 'title' => 'Preference'],

            [
                'type' => 'link',
                'icon' => 'uil uil-setting',
                'url' => '#',
                'text' => 'Settings',
            ],
        ];
    }
}
