<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header border-b">
            <div class="flex items-center gap-x-3 px-5">
                <div class="w-[40px] lg:w-[45px] aspect-square bg-gray-300 rounded-full"></div>
                <div>
                    <p class="text-xs lg:text-sm font-medium max-w-[175px] overflow-hidden whitespace-nowrap mb-1">
                        {{ $user->name ?? '' }}
                    </p>
                    <p
                        class="text-[0.65rem] lg:text-[0.7rem] text-gray-400 font-normal max-w-[175px] overflow-hidden whitespace-nowrap">
                        {{ $user->email ?? '' }}
                    </p>
                </div>
            </div>
        </div>
        <nav class="menu-wrapper">
            <ul class="sidebar-menu">

                @foreach ($items as $item)
                    @if ($item['type'] === 'title')
                        <li class="menu-title">{{ $item['title'] ?? '' }}</li>
                    @elseif($item['type'] === 'link')
                        <li>
                            <a class="sidebar-link {{ $item['is_active'] ?? false ? 'active' : '' }}"
                                href="{{ $item['url'] ?? '' }}">
                                <i class="{{ $item['icon'] ?? '' }}"></i>
                                <span> {{ $item['text'] ?? '' }} </span>
                            </a>
                        </li>
                    @elseif($item['type'] === 'dropdown')
                        <li class="sidebar-dropdown">
                            <a class="sidebar-link dropdown-toggler" href="#">
                                <i class="uil uil-user"></i>
                                <span> {{ $item['text'] ?? '' }} </span>
                                <i class="arrow uil uil-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($item['items'] ?? [] as $item)
                                    <li>
                                        <a class="sidebar-link {{ $item['is_active'] ?? false ? 'active' : '' }}"
                                            href="{{ $item['url'] ?? '' }}">
                                            <i class="{{ $item['icon'] ?? '' }}"></i>
                                            <span> {{ $item['text'] ?? '' }} </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach

            </ul>
        </nav>
    </div>
</aside>
