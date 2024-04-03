<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased bg-mobile-waves-lightmode sm:bg-waves-lightmode sm:dark:bg-waves-darkmode dark:bg-mobile-waves-darkmode bg-no-repeat bg-cover">
    <div class="min-h-screen ">
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">
                        <div
                            class="text-2xl font-bold text-blue-600 flex flex-col justify-center items-center w-full mb-5">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                {{ __('Üdvözöllek') }} {{ Auth::user()->firstname }} {{ __('az admin menüben!') }}
                            </div>
                            @if (session('status') == 'user-deleted')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                                    class="text-md text-gray-600 dark:text-gray-400">{{ __('Sikeres törlés!') }}</p>
                            @endif
                            @if (session('status') == 'user-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                                    class="text-md text-gray-600 dark:text-gray-400">{{ __('Sikeres módosítás!') }}</p>
                            @endif


                        </div>

                        <div class="flex justify-between">
                            <form action="{{ route('admin.destroy') }}" method="POST" class="flex flex-col w-80 mb-5">
                                @csrf
                                @method('delete')
                                <label for="user" class="dark:text-white text-black">Válaszd ki melyik felhasználót
                                    szeretnéd törölni</label>
                                <select name="user" id="user" class="mb-5">
                                    <option value="">Válassz felhasználót...</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}:
                                            {{ $user->email }}</option>
                                    @endforeach
                                </select>
                                <input type="submit" value="Felhasználók törlése"
                                    class="bg-black hover:bg-gray-900 dark:bg-white dark:hover:bg-gray-300 font-bold p-1 rounded cursor-pointer">
                            </form>
    
    
                            <form action="{{ route('admin.update') }}" method="POST" class="flex flex-col w-80">
                                @csrf
                                @method('patch')
                                <label for="user" class="dark:text-white text-black">Válaszd ki melyik felhasználót
                                    szeretnéd módosítani</label>
                                <select name="user" id="userEdit" class="mb-5">
                                    <option value="">Válassz felhasználót...</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}:
                                            {{ $user->email }}</option>
                                    @endforeach
                                </select>
    
                                <label for="firstname" class="dark:text-white text-black">Keresztnév</label>
                                <input type="text" name="firstname" id="firstname" class="mb-5">
                                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />

                                <label for="lastname" class="dark:text-white text-black">Vezetéknév</label>
                                <input type="text" name="lastname" id="lastname" class="mb-5">
                                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />

                                <label for="phone" class="dark:text-white text-black">Telefonszám</label>
                                <input type="text" name="phone" id="phone" class="mb-5">
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />

                                <label for="irsz" class="dark:text-white text-black">Irányítószám</label>
                                <select name="irsz" id="irsz">
                                    @foreach ($cities->sortBy('IRSZ_Id') as $city)
                                        <option value="{{ $city->IRSZ_Id }}">{{ $city->IRSZ_Id }} {{ $city->name }}</option>
                                    @endforeach
                                </select>

                                <input type="submit" value="Felhasználó módosítása"
                                    class="bg-black hover:bg-gray-900 dark:bg-white dark:hover:bg-gray-300 font-bold p-1 rounded cursor-pointer mt-5">
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        let userEditselect = document.getElementById('userEdit');

        let users = @json($users);

        userEditselect.addEventListener('change', (e) => {
            if (e.target.value == '') {
                document.getElementById('firstname').value = '';
                document.getElementById('lastname').value = '';
                document.getElementById('phone').value = '';
                document.getElementById('irsz').value = '';
                return;
            }
            let filteredUser = users.filter(user => user.id == e.target.value);
            document.getElementById('firstname').value = filteredUser[0].firstname;
            document.getElementById('lastname').value = filteredUser[0].lastname;
            document.getElementById('phone').value = filteredUser[0].phonenumber;
            document.getElementById('irsz').value = filteredUser[0].IRSZ_ID;
        });

    </script>
</body>

</html>
