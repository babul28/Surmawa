<x-college-layout>
    <div class="min-h-screen flex flex-col md:flex-row">
        {{-- Left Section --}}
        <x-college.menu>
            <x-college.item active>
                <x-college.item-icon active done>
                    1
                </x-college.item-icon>
                <x-college.item-label>
                    Biodata
                </x-college.item-label>
            </x-college.item>
            <x-college.item>
                <x-college.item-icon>
                    2
                </x-college.item-icon>
                <x-college.item-label>
                    Isi Kuinioner
                </x-college.item-label>
            </x-college.item>
            <x-college.item>
                <x-college.item-icon>
                    3
                </x-college.item-icon>
                <x-college.item-label>
                    Umpan Balik
                </x-college.item-label>
            </x-college.item>

        </x-college.menu>
        <div class="bg-gray-300 md:w-3/4 flex-1 py-8 px-6 md:pt-24 md:px-14 lg:px-32 xl:px-64">
            <h3 class="text-2xl font-bold text-gray-800">Biodata</h3>
            <p class="text-gray-700 mb-6">Lengkapi biodatamu sebelum mengisi kuisioner.</p>

            <form action="">
                <div class="mb-4 md:mb-5">
                    <x-label for="name">Nama Lengkap</x-label>
                    <x-input type="text" name="name" id="name" class="block mt-1 w-full" aria-label="name" required
                        autofocus />
                </div>
                <div class="mb-4 md:mb-5">
                    <x-label for="nim">NIM</x-label>
                    <x-input type="text" name="nim" id="nim" class="block mt-1 w-full" aria-label="nim" required />
                </div>
                <div class="mb-4 md:mb-5">
                    <span class="text-gray-700 text-sm">Account Type</span>
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" value="L" checked>
                            <span class="ml-2">Laki-laki</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="gender" value="P">
                            <span class="ml-2">Perempuan</span>
                        </label>
                    </div>
                </div>
                <div class="flex justify-end">
                    <x-button class="block w-full lg:w-2/6 xl:1/4 justify-center mb-4 py-4">Selanjutnya</x-button>
                </div>
            </form>
        </div>
    </div>
</x-college-layout>
