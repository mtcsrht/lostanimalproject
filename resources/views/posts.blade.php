<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class=" container">
                        <div class="flex flex-col mb-5">
                            <x-primary-button class="self-center" x-data=""
                                x-on:click="$dispatch('open-modal', 'filter')">{{ __('Szűrés') }}</x-primary-button>

                            <x-modal name="filter" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <!-- Kijavítani, hogy a ki nem valasztott optionokat ne irja ki az url-be-->
                                
                                <form method="get" action="" class="p-6" id="">

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Szűrés') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Itt tudsz szűrni az alábbi feltételek alapján!') }}
                                    </p>
                                    <div class="flex"></div>
                                    <label for="color" class="block text-gray-700 dark:text-gray-300">Szín</label>
                                    <select name="color_id" id="color"
                                        class="form-select rounded-md shadow-sm mb-4 block w-lg">
                                        <option value="">Válassz egy színt...</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="gender" class="block text-gray-700 dark:text-gray-300 ">Nem</label>
                                    <select name="gender" id="gender"
                                        class="form-select rounded-md shadow-sm mt-1 block w-lg">
                                        <option value="">Válassz egy nemet..</option>
                                        <option value="1">Hím</option>
                                        <option value="0">Nőstény</option>
                                    </select>
                                    <label for="chip" class="block text-gray-700 dark:text-gray-300 mt-4">Chip
                                        Szám</label>
                                    <select name="chipNumber" id="chipNumber"
                                        class="form-select rounded-md shadow-sm mt-1 block w-55">
                                        <option value="">Van, vagy nincs...</option>
                                        <option value="has">Van</option>
                                        <option value="empty">Nincs</option>
                                    </select>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Mégse') }}
                                        </x-secondary-button>
                                        <x-primary-button class="ms-3">
                                            {{ __('Szűrés') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </x-modal>
                        </div>
                        <!-- Sorting...
                        <form method="get">
                            <select name="sort" id="sort" onchange="this.form.submit()">
                                <option value="">Rendezés..</option>
                                <option value="created_at">Idő</option>
                                <option value="name">Név</option>
                            </select>
                        </form>
                    -->
                        <hr>
                        <div class="mt-5">
                            {{ $animals->appends(request()->all())->links() }}
                        </div>
                        <div class="flex flex-col sm:flex-row sm:flex-wrap justify-evenly item-start gap-5 mt-10">
                            <!-- $animals->sortBy('created_at') később-->
                            @forelse ($animals as $animal)
                                <div
                                    class="flex flex-col justify-between max-w-sm bg-white border border-gray-400 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-5">
                                    <img class="w-[512px] rounded transition-all duration-300 filter grayscale hover:grayscale-0"
                                        src="{{ asset("storage/$animal->image") }}" alt="" />
                                    <div class="p-5">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{ $animal->name }}</h5>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            {{ Str::of($animal->description)->limit(40) }}</p>

                                        <?php $owner = $users->where('id', $animal->userId)->first(); ?>
                                        <a class="font-normal text-gray-700 dark:text-gray-400"
                                            href="{{ url()->to('chatify/' . $owner->id) }}">{{ $owner->lastname . ' ' . $owner->firstname }}</a>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            {{ $animal->created_at->diffForHumans() }}</p>
                                        <a href="{{ route('about-animal.index', $animal) }}"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            Olvasok tovább
                                        </a>

                                    </div>
                                </div>
                            @empty
                                @if (empty(request()))
                                    <div class="text-center">
                                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">Még nincs
                                            feltöltött
                                            állat</p>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">Nincs
                                            megjeleníthető
                                            állat</p>
                                    </div>
                                @endif
                            @endforelse
                        </div>
                        <div class="mt-5">
                            {{ $animals->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
