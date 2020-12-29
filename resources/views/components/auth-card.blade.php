<div class="min-h-screen flex flex-col justify-center items-center pt-8 sm:pt-0 bg-gray-100">
    <div {!! $attributes->merge(['class' => 'w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden
        sm:rounded-lg']) !!}>
        {{ $slot }}
    </div>
</div>
