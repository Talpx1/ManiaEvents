@props(['color' => 'dark', 'with_text' => true])

@php
    $logo = match (true) {
        $color === 'dark' && $with_text => asset('images/logo/logo_dark.png'),
        $color === 'light' && $with_text => asset('images/logo/logo_light.png'),
        $color === 'dark' && !$with_text => asset('images/logo/logo_dark_notext.png'),
        $color === 'light' && !$with_text => asset('images/logo/logo_dark_notext.png'),
        default => throw new \InvalidArgumentException("Logo variants are 'light' or 'dark': {$variant} passed."),
    };
@endphp

<img src="{{ $logo }}" alt="{{ config('platform.name') }} Logo" {{ $attributes }}>
