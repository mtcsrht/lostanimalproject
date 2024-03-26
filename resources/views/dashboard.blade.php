<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menü') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-2xl font-bold text-blue-600 flex flex-col justify-center items-center w-full mb-5">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("Üdvözöllek a menüben!") }}
                    </div>
                    <a href="{{route('posts.show')}}" class="relative flex h-[50px] w-40 items-center justify-center overflow-hidden bg-gray-900 text-white shadow-2xl transition-all before:absolute before:h-0 before:w-0 before:rounded-full  before:bg-cyan-500 before:duration-500 before:ease-out hover:shadow-cyan-500 hover:before:h-56 hover:before:w-56 rounded-sm">
                        <span class="relative z-10">Nézelődnék</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
