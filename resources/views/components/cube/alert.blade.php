@if ($attributes['type'] === 'success')
    <div class="alert success {{ $attributes['class'] ?? '' }}">
        <i class="icon uil uil-check-circle"></i>
        {{ $attributes['message'] ?? '' }}
        <i class="close-alert uil uil-times"></i>
    </div>
@elseif($attributes['type'] === 'error')
    <div class="alert error {{ $attributes['class'] ?? '' }}">
        <i class="icon uil uil-exclamation-octagon"></i>
        {{ $attributes['message'] ?? '' }}
        <i class="close-alert uil uil-times"></i>
    </div>
@elseif($attributes['type'] === 'warning')
    <div class="alert warning {{ $attributes['class'] ?? '' }}">
        <i class="icon uil uil-exclamation-triangle"></i>
        {{ $attributes['message'] ?? '' }}
        <i class="close-alert uil uil-times"></i>
    </div>
@elseif($attributes['type'] === 'info')
    <div class="alert info {{ $attributes['class'] ?? '' }}">
        <i class="icon uil uil-info-circle"></i>
        {{ $attributes['message'] ?? '' }}
        <i class="close-alert uil uil-times"></i>
    </div>
@endif
