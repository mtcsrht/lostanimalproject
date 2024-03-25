<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class=" container">
                        <div class="flex flex-col gap-5 sm:flex-row sm:justify-between sm:items-center mb-5">
                            <x-primary-button class="" x-data=""
                                x-on:click="$dispatch('open-modal', 'filter')">{{ __('Szűrés és rendezés') }}</x-primary-button>

                            <x-modal name="filter" focusable>

                                <form method="get" action="" class="p-6" id="">

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Szűrés és rendezés') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Itt tudsz szűrni az alábbi feltételek alapján és rendezni!') }}
                                    </p>
                                    <div class="flex"></div>
                                    <label for="color" class="block text-gray-700 dark:text-gray-300">Szín</label>
                                    <select name="color_id" id="color"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 rounded-md shadow-sm">
                                        <option value="">Válassz egy színt...</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}" {{ request()->query('color_id') == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="gender" class="block text-gray-700 dark:text-gray-300 ">Nem</label>
                                    <select name="gender" id="gender"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 rounded-md shadow-sm">
                                        <option value="">Válassz egy nemet..</option>
                                        <option value="1" {{ request()->query('gender') == '1' ? 'selected' : '' }}>Hím</option>
                                        <option value="0" {{ request()->query('gender') == '0' ? 'selected' : '' }}>Nőstény</option>
                                    </select>
                                    <label for="chipNumber" class="block text-gray-700 dark:text-gray-300">Chip
                                        Szám</label>
                                    <select name="chipNumber" id="chipNumber"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 rounded-md shadow-sm">
                                        <option value="">Van, vagy nincs...</option>
                                        <option value="has" {{ request()->query('gender') == 'has' ? 'selected' : '' }}>Van
                                        </option>
                                        <option value="empty" {{ request()->query('gender') == 'empty' ? 'selected' : '' }}>
                                            Nincs</option>
                                    </select>
                                    <label for="sort_by"
                                        class="block text-gray-700 dark:text-gray-300">Rendezés</label>
                                    <select name="sort_by" id="sort_by"
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-600 focus:ring-cyan-500 dark:focus:ring-cyan-600 rounded-md shadow-sm">
                                        <option value="created_at-desc">Legfrissebb</option>
                                        <option value="created_at-asc">Legrégebbi</option>
                                        <option value="name-asc">Név (A-Z)</option>
                                        <option value="name-desc">Név (Z-A)</option>
                                    </select>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Mégse') }}
                                        </x-secondary-button>
                                        <x-primary-button class="ms-3">
                                            {{ __('Szűrés és rendezés') }}
                                        </x-primary-button>
                                    </div>

                                </form>                              
                          </x-modal>
                            <a href="{{ url('/posts')}}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Szűrés és rendezés visszaállítása</a>
                        </div>

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
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            Olvasok tovább
                                        </a>
                                    </div>
                                </div>
                            @empty
                                    <div class="text-center">
                                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">Nincs
                                            megjeleníthető
                                            állat</p>
                                    </div>
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
