@props(['actions'])

<div
    class="{{ $attributes['background'] ?? 'bg-white' }} rounded-lg shadow-[0px_0px_45px_0px_rgba(0,0,0,0.035)] {{ $attributes['class'] ?? '' }}">
    @if ($attributes['title'] || count($actions) > 0)
        <div class="flex flex-wrap justify-between items-start gap-x-40 gap-y-5 px-5 pt-4 pb-3">
            <h2 class="text-sm text-gray-500 font-medium uppercase {{ $attributes['titleClass'] }}">
                {{ $attributes['title'] }}
            </h2>
            @if (count($actions) > 0)
                <div class="flex flex-wrap items-center gap-5">
                    @foreach ($actions as $action)
                        <a class="btn btn-primary btn-sm btn-rounded" href="{{ $action['url'] ?? '' }}">
                            {{ $action['text'] ?? '' }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
    <div class="px-5 {{ $attributes['title'] || count($actions) > 0 ? 'pt-2' : 'pt-5' }} pb-3">
        <div class="w-full overflow-x-auto py-3">
            {{ $slot }}
        </div>
    </div>
</div>
