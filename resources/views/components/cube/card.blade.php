@props(['actions'])

<div class="{{ $attributes['background'] ?? 'bg-white' }} rounded-lg">
    <div class="flex flex-col lg:flex-row justify-between items-start gap-5 px-5 pt-5 pb-3">
        <h2 class="text-sm text-gray-500 font-medium uppercase">{{ $attributes['title'] }}</h2>
        @if (count($actions) > 0)
            <div class="flex flex-wrap items-center gap-5">
                @foreach ($actions as $action)
                    <a class="btn bg-primary btn-sm btn-rounded" href="{{ $action['url'] ?? '' }}">
                        {{ $action['text'] ?? '' }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
    <div class="px-5 pt-2 pb-5">
        <div class="w-full overflow-x-auto pb-3">
            {{ $slot }}
        </div>
    </div>
</div>
