<li>
    <a href="{{ route($route, $params) }}" class="{{ $activeClass }}">
        <i class="fa-solid {{ $icon }}"></i>
        <span class="visually-hidden">{{ $text }}</span>
        {{ $text }}
    </a>
</li>
