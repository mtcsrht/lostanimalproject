<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('uploadpost') }}" method="POST" class="p-5 ">
                    @csrf
                    <div class="flex flex-row w-full justify-around">
                        <div class="flex flex-col">
                            <div class="mb-6">
                                <x-input-label for="name" :value="__('Állat neve')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required/>
                            </div>
                            <div class="mb-6">
                                <x-input-label for="name" :value="__('Chip száma (amennyiben az állat rendelkezik vele)')" />
                                
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"/>
                            </div>
                            <div class="mb-6">
                                <label for="gender" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Állat neme</label>
                                <select name="gender" id="gender" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="1">Hím</option>
                                    <option value="0">Nőstény</option>
                                </select>
                            </div>
    
                            <div class="mb-6">
                                <label for="color" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Állat színe</label>
                                <select name="color" id="color" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach ($colors as $color)
                                        <option value="{{$color->id}}">{{$color->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="">
                            <label for="picture" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kép az állatról</label>
                            <input type="file" name="picture" id="picture" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                        </div>
                    </div>
                </div>

                    
                </form>
            </div>
        </div>
    </div>
</x-app-layout>