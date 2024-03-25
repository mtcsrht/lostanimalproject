<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env("APP_NAME")}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

        <!-- Styles -->       
        @vite(['resources/css/app.css', 'resources/js/app.js'])     
    </head>
    <body class="antialiased bg-lightmode dark:bg-darkmode bg-norepeat bg-cover aspect-square sm:aspect-auto">
            <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center selection:bg-cyan-700 selection:text-white">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-cyan-600 xl:text-slate-50 hover:text-slate-300 dark:text-gray-100 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-cyan-500">Menü</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-xl text-cyan-600 xl:text-slate-50 hover:text-slate-300 dark:text-gray-100 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-cyan-500">Bejelentkezés</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-xl text-cyan-600 xl:text-slate-50  hover:text-slate-300 dark:text-gray-100 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-cyan-500">Regisztráció</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <div class="flex flex-col items-center justify-center"> 
                    <div class="text-center p-6">
                        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Üdvözöllek az eltűnt állatok oldalán!</h1>
                        <p class="mb-6 text-lg font-normal text-gray-700 lg:text-xl sm:px-16 xl:px-48 dark:text-slate-50">Ha eltűnt állatot találsz, vagy szeretnéd a saját állatodat megtalálni, jelentkezz be, vagy regisztrálj!</p>

                    </div>
                    
                    <div class="text-2xl font-bold text-blue-600">
                        <!--
                        <button class="bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded">Nézelődnék</button>
                        -->
                      
                      <a href="{{route('posts.show')}}" class="relative flex h-[50px] w-40 items-center justify-center overflow-hidden bg-gray-800 text-white shadow-2xl transition-all before:absolute before:h-0 before:w-0 before:rounded-full  before:bg-cyan-500 before:duration-500 before:ease-out hover:shadow-cyan-500 hover:before:h-56 hover:before:w-56 rounded-sm">
                        <span class="relative z-10">Nézelődnék</span>
                      </a>
                      </div>
                </div>
                <div class="fixed bottom-0 right-0 p-6 text-right z-1">
                    <p class="font-semibold dark:text-white">weboldalt készítette: Alex Kosik & Mate Cserhati</p>
                </div>
            </div>


        
        
        

    </body>
</html>
