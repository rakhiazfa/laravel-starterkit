<?php

namespace App\View\Components\Cube\Auth;

use App\Models\User;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * @var SidebarMenu
     */
    public SidebarMenu $sidebarMenu;

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
        $this->user = $user;

        $this->sidebarMenu = new SidebarMenu();

        $this->registerItems();
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
    protected function registerItems()
    {
        $this->sidebarMenu->addMenuTitle('Navigation');

        $this->sidebarMenu->addLinkItem(
            'Dashboard',
            'uil uil-apps',
            route('dashboard'),
            request()->routeIs('dashboard*'),
        );

        $canManageRolePermissions = $this->user->can('users_and_roles') ||
            $this->user->can('users_and_permissions') ||
            $this->user->can('roles_and_permissions');

        $this->sidebarMenu->addMenuTitle('Roles and Permissions', $canManageRolePermissions);

        $this->sidebarMenu->addDropdownMenu(
            'Permissions',
            'uil uil-pricetag-alt',
            [
                $this->sidebarMenu->addDropdownItem(
                    'Users and Roles',
                    route('users_and_roles'),
                    request()->routeIs('users_and_roles*'),
                    $this->user->can('users_and_roles'),
                ),
                $this->sidebarMenu->addDropdownItem(
                    'Users and Pemissions',
                    route('users_and_permissions'),
                    request()->routeIs('users_and_permissions*'),
                    $this->user->can('users_and_permissions'),
                ),
                $this->sidebarMenu->addDropdownItem(
                    'Roles and Pemissions',
                    route('roles_and_permissions'),
                    request()->routeIs('roles_and_permissions*'),
                    $this->user->can('roles_and_permissions'),
                )
            ],
            $canManageRolePermissions,
        );
    }
}

class SidebarMenu
{
    /**
     * @var array
     */
    public array $items = [];

    /**
     * @param string $title
     * 
     * @return void
     */
    public function addMenuTitle(string $title, bool $condition = true)
    {
        $condition && array_push($this->items, ['type' => 'title', 'title' => $title]);
    }

    /**
     * @param string $text
     * @param string $icon
     * @param string $route
     * @param bool $isActive
     * @param bool $condition
     * 
     * @return void
     */
    public function addLinkItem(string $text, string $icon, string $route, bool $isActive = false, bool $condition = true)
    {
        $condition && array_push(
            $this->items,
            [
                'type' => 'link',
                'icon' => $icon,
                'url' => $route,
                'text' => $text,
                'is_active' => $isActive,
            ]
        );
    }

    /**
     * @param string $text
     * @param string $icon
     * @param array $items
     * @param bool $condition
     * 
     * @return void
     */
    public function addDropdownMenu(string $text, string $icon, array $items = [], bool $condition = true)
    {
        $condition && array_push(
            $this->items,
            [
                'type' => 'dropdown',
                'icon' => $icon,
                'text' => $text,
                'items' => $items,
            ]
        );
    }

    public function addDropdownItem(string $text, string $route, bool $isActive = false, bool $condition = true)
    {
        return $condition ? [
            'url' => $route,
            'text' => $text,
            'is_active' => $isActive,
        ] : null;
    }
}
