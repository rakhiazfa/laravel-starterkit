<div class="bg-white rounded-lg px-5 py-4 {{ $attributes['class'] }}">
    <nav>
        <ul class="flex items-center gap-2">
            @foreach ($items as $item)
                <li>
                    <a class="{{ !isset($item['url']) ? 'select-none pointer-events-none text-gray-400 font-medium' : 'font-normal text-blue-500 hover:underline' }}"
                        href="{{ $item['url'] ?? '' }}">
                        {{ $item['text'] ?? '' }}
                    </a>
                </li>
                {{ $loop->iteration !== count($items) ? '/' : '' }}
            @endforeach
        </ul>
    </nav>
</div>
