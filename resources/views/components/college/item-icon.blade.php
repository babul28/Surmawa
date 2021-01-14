@props(['active' => false, 'done' => false])

@php
$baseClass = 'inline-block w-7 h-7 rounded-full border-solid border-2 mr-2 text-center leading-6 box-border ';

$class = $active ? 'border-blue-600' : 'border-gray-600';

$class = $done ? 'border-blue-600 bg-blue-600 text-white' : $class;
@endphp

<span {{ $attributes->merge(['class' => $baseClass . $class ]) }}>{{ $slot }}</span>
