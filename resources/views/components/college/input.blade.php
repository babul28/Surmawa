@props(['disabled' => false])

<input {{  $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-1/6 h-20 mx-1 rounded-lg bg-gray-500
text-center font-semibold text-white text-3xl placeholder-gray-400 focus:ring-2 focus:ring-gray-300
focus:border-transparent']) !!} maxlength=1 >
