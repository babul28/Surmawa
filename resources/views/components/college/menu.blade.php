<div class="w-full md:w-1/4 py-2 px-3 lg:px-4 xl:px-12">
    <div class="flex justify-center lg:justify-start p-5">
        <a href="/">
            <x-application-logo class="w-24 h-12 fill-current text-gray-500" />
        </a>
    </div>
    <ul class="flex md:flex-col justify-around mb-2">
        {{ $slot }}
    </ul>
</div>
