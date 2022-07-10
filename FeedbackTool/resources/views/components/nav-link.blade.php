@props(['active'])

@php
$classes = ($active ?? false)
            ? 'navlink active'
            : 'navlink';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
