<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <div class="container w-full">
                    <div class="flex">
                            <img clas="justify-self-center item-self-center" src="{{ asset('storage/'.$animal->image) }}" alt="{{ $animal->name }}">
                            <h1>{{ $animal->name }}</h1>
                    </div>
                   </div>
                </div>
            </div>
        </div>
    </div>

</x-public-layout>
