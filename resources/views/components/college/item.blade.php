@props(['active' => false])

@php
$class = $active ? 'md:px-2 md:py-4 flex items-center text-blue-600' : 'md:px-2 md:py-4 flex items-center
text-gray-600';
@endphp

<li {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</li>
