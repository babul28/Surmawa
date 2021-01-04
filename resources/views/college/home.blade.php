<x-college-layout>
    <div x-data="initData()" class="min-h-screen flex flex-col lg:flex-row pt-20 md:pt-24 lg:pt-0">
        {{-- Left Section --}}
        <div class="flex flex-col px-4 pb-16 lg:container items-center justify-center w-full lg:w-2/3 relative">
            <h1 class="text-4xl uppercase font-bold mb-12 lg:mb-20">Selamat Datang Mahasiswa</h1>

            <div class="h-72 w-72 overflow-hidden mb-12">
                <x-college.landing-page-1 x-bind:class="{'hidden': activeIndex !== 0}" />
                <x-college.landing-page-2 x-bind:class="{'hidden': activeIndex !== 1}" />
                <x-college.landing-page-3 x-bind:class="{'hidden': activeIndex !== 2}" />
            </div>

            <div class="w-full md:w-2/3 lg:w-full xl:w-2/3 h-20 overflow-hidden mb-4">
                <template x-for="(item, key) in items" :key="item">
                    <p x-show="activeIndex === key" class="text-lg text-center" x-text="item"></p>
                </template>
            </div>

            <div class="w-full flex justify-center">
                <template x-for="(item, key) in items" :key="item">
                    <span :class="{'bg-green-700': activeIndex === key}"
                        class="inline-block w-5 h-2 rounded-full m-1 bg-gray-400"></span>
                </template>
            </div>

            <div class="absolute top-50 left-5 right-5 md:top-50 md:left-20 md:right-20 flex justify-between">
                <button x-on:click="decrementActiveIndex()"
                    class="w-10 h-10 bg-gray-300 opacity-50 rounded-md focus:outline-none hover:bg-gray-400 hover:text-white font-bold text-xl">
                    <</button> <button x-on:click="incrementActiveIndex()"
                        class="w-10 h-10 bg-gray-300 opacity-50 rounded-md focus:outline-none hover:bg-gray-400 hover:text-white font-bold text-xl">
                        >
                </button>
            </div>
        </div>
        {{-- End Left Section --}}

        {{-- Right Section --}}
        <div class="w-full lg:w-2/3 xl:w-1/3 bg-gray-800 flex flex-col justify-center items-center px-4 py-16 lg:p-8">
            <div class="w-full md:w-2/3 lg:w-full mx-12 h-52 bg-gray-600 rounded-xl p-6">
                <h3 class="text-lg uppercase font-medium text-gray-100 text-center">Masukkan Kode Kelas</h3>
                <form action="" class="flex flex-col items-center mt-6">
                    <div class="flex justify-between">
                        <x-college.input type="text" name="class_code[]" placeholder="-" />
                        <x-college.input type="text" name="class_code[]" placeholder="-" />
                        <x-college.input type="text" name="class_code[]" placeholder="-" />
                        <x-college.input type="text" name="class_code[]" placeholder="-" />
                        <x-college.input type="text" name="class_code[]" placeholder="-" />
                    </div>
                </form>
            </div>
            <button class="px-20 py-4 bg-gray-100 rounded-md font-bold mt-16 hover:bg-gray-50">Submit</button>
        </div>
        {{-- End Right Section --}}
    </div>

    <script>
        function initData() {
            return {
                activeIndex: 0,
                items: [
                    'Isi kuisioner yang telah disediakan dengan sungguh - sungguh dan jangan ada satupun yang terlewat',
                    'Isi informasi lengkap tentang data pribadimu untuk dapat melanjutkan ke tahap selanjutnya, pastikan diisi dengan lengkap',
                    'Kode ruang akan diberikan oleh admin dan silahkan diisi kode tersebut dibilah sebelah kanan layar untuk memasuki ruangan'
                ],
                incrementActiveIndex() {
                    if (this.activeIndex + 1 > 2) {
                        return this.activeIndex = 0
                    }

                    return this.activeIndex += 1
                },
                decrementActiveIndex() {
                    if (this.activeIndex - 1 < 0) {
                        return this.activeIndex = 2
                    }

                    return this.activeIndex -= 1
                }
            }
        }
    </script>
</x-college-layout>
