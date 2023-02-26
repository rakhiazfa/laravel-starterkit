@props(['actions'])

<div class="{{ $attributes['background'] ?? 'bg-white' }} rounded-xl shadow-xxs {{ $attributes['class'] ?? '' }}">
    @if ($attributes['title'] || count($actions) > 0)
        <div
            class="flex flex-wrap justify-between items-center gap-x-40 gap-y-5 px-5 pt-4 pb-3 {{ $attributes['headerClass'] ?? '' }}">
            <h2 class="text-sm text-gray-600 font-medium capitalize {{ $attributes['titleClass'] ?? '' }}">
                {{ $attributes['title'] }}
            </h2>
            @if (count($actions) > 0)
                <div class="flex flex-wrap items-center gap-5">
                    @foreach ($actions as $action)
                        @if ($action['type'] ?? '' === 'button')
                            <button type="button" class="btn btn-primary btn-xs btn-rounded {{ $action['class'] ?? '' }}"
                                data-target="{{ $action['target'] ?? '' }}">
                                {{ $action['text'] ?? '' }}
                            </button>
                        @else
                            <a class="btn btn-primary btn-xs btn-rounded" href="{{ $action['url'] ?? '' }}">
                                {{ $action['text'] ?? '' }}
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @endif
    <div class="px-5 {{ $attributes['title'] ?? null || count($actions) > 0 ? 'pt-2' : 'pt-5' }} pb-2">
        <div class="w-full overflow-x-auto py-3">
            {{ $slot }}
        </div>
    </div>
</div>
