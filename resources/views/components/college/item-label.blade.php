@props(['active' => false])

@php
$class = $active
? 'inline font-bold'
: 'inline';
@endphp

<p {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</p>
