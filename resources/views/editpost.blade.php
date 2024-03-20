<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-5 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="mb-1 text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Állat szerkesztése') }}
                </h2>

                <p class="mb-6 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Módosítsd az állatodat ahogy csak szeretnéd!') }}
                </p>
                <form action="{{ route('myposts.edit', $animal) }}" method="POST" enctype="multipart/form-data"
                    class="sm:grid sm:grid-cols-2 sm:grid-rows-2 sm:gap-2 sm:max-h-full">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Állat neve')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" value="{{ $animal->name }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="chip" :value="__('Chip száma (amennyiben az állat rendelkezik vele)')" />
                        <x-text-input id="chip" class="block mt-1 w-full" type="text" name="chip"
                            :value="old('chip')" value="{{ $animal->chipNumber }}" />
                        <x-input-error :messages="$errors->get('chip')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <label for="gender" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Állat
                            neme</label>
                        <select name="gender" id="gender"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 rounded-md shadow-sm">
                            @for ($i = 0; $i < 2; $i++)
                                <option {{ $animal->gender === $i ? 'selected' : '' }} value="{{ $i }}">
                                    {{ $i === 1 ? 'Hím' : 'Nőstény' }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="color" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Állat
                            színe</label>
                        <select name="color" id="color_id"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 rounded-md shadow-sm">
                            @foreach ($colors as $color)
                                <option {{ $animal->colorId === $color->id ? 'selected' : ' ' }}
                                    value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="picture" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kép az
                            állatról (512x512)</label>
                        <input type="file" name="picture" id="picture"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 shadow-sm">
                        <x-input-error :messages="$errors->get('picture')" class="mt-2" />
                        <p class="mt-5 block font-medium text-sm text-gray-700 dark:text-gray-300">Jelenlegi kép (ha nem
                            szeretnél változtatni ne tölts fel semmit!)</p>
                        <img class=" w-[128px] h-[128px] object-contain" src="{{ asset('storage/' . $animal->image) }}"
                            alt="{{ $animal->name }}">
                    </div>

                    <div class="mb-4">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Leírás</label>
                        <textarea id="description" name="description" rows="4"
                            class="block p-2.5 max-w-sm w-full h-44 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Írj az állatodról.">{{ $animal->description }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="sm:row-start-4 sm:col-start-2 sm:justify-self-end">
                        <x-primary-button class="sm:row-start-5 sm:col-start-2">
                            {{ __('Mentés') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
