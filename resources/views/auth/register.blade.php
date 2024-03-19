<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Felhasználónév')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder=""/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="yourname@domain.com"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Jelszó')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Jelszó újra')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <!-- First name -->
        <div class="mt-4">
            <x-input-label for="firstname" :value="__('Keresztnév')"/>
            <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" placeholder="pl: János"/>
            <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
        </div>

        <!-- Last name -->
        <div class="mt-4">
            <x-input-label for="lastname" :value="__('Vezetéknév')"/>
            <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" placeholder="pl: Nagy"/>
            <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
        </div>
        <!-- Phone number -->
        <div class="mt-4">
            <x-input-label for="phonenumber" :value="__('Telefonszám')"/>
            <x-text-input id="phonenumber" class="block mt-1 w-full" type="text" name="phonenumber" :value="old('phonenumber')" required autofocus autocomplete="phonenumber" placeholder="0630" />
            <x-input-error :messages="$errors->get('phonenumber')" class="mt-2" />
        </div>

        <!-- Postal code -->
        <div class="mt-4">
            <x-input-label for="postalCode" :value="__('Irányítószám')"/>
            <x-text-input id="postalCode" maxlength="4" class="block mt-1 w-full" type="text" name="postalCode" :value="old('postalCode')" required autofocus autocomplete="postalCode"  placeholder="pl: 2660" />
            <x-input-error :messages="$errors->get('postalCode')" class="mt-2" />
        </div>
        <div class="mt-4">
            <select multiple id="cities_multiple" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </select>
        </div>
        <script>
           let postalCode = document.getElementById('postalCode');
           let cities_select= document.getElementById('cities_multiple');
/*
           postalCode.addEventListener('input', function(){
            let name = postalCode.value;
            let response = fetch(`api/cities/${name}`).then(response => response.json()).then(data => {
            console.log(data);
            cities_select.innerHTML = '';
            for(let varos of data){
                cities_select.options.add(new Option(`${varos.city} ${varos.postal_code}`, varos.postal_code));
            }
            }).catch(error => {
                console.log(error);
            });
           })
*/
            let allCityData = []; 

            // Fetch the city data once at application load
            fetch('api/cities')
            .then(response => response.json())
            .then(data => allCityData = data)
            .catch(error => console.error("Error loading initial city data:", error));

            postalCode.addEventListener('input', function() {
                const inputValue = postalCode.value; 
                const regex = new RegExp('^'+inputValue + '.*'); 
                // Filter in-memory
                const filteredCities = allCityData.filter(city =>
                    regex.test(city.postal_code));

                cities_select.length = 0; // Clear existing options

                // Add options using options.add
                for (const { city, postal_code } of filteredCities) {
                    const newOption = new Option(`${city} ${postal_code}`, postal_code);
                    cities_select.options.add(newOption);
                }
            });


           cities_select.addEventListener('change', function(){
            postalCode.value = cities_select.options[cities_select.selectedIndex].value
           })
           //TODO beletenni a citiname mezőbe a kiválasztottat illetve alapvetően betölteni a városokat
            
        </script>
        
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Már regisztráltál??') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Regisztrálás') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
