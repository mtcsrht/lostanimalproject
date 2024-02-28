<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->       
        @vite(['resources/css/app.css', 'resources/js/app.js'])     
    </head>
    <body class="antialiased">
        <div class="bg-lightmode dark:bg-darkmode bg-norepeat bg-cover aspect-square sm:aspect-auto">
            <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center selection:bg-cyan-700 selection:text-white">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-cyan-600 xl:text-slate-50 hover:text-slate-300 dark:text-gray-100 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-semibold text-cyan-600 xl:text-slate-50 hover:text-slate-300 dark:text-gray-100 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 font-semibold text-cyan-600 xl:text-slate-50  hover:text-slate-300 dark:text-gray-100 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <div> 
                    <div class="text-center p-6">
                        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Üdvözöllek az eltűnt állatok oldalán!</h1>
                        <p class="mb-6 text-lg font-normal text-gray-700 lg:text-xl sm:px-16 xl:px-48 dark:text-slate-50">Ha eltűnt állatot találsz, vagy szeretnéd a saját állatodat megtalálni, jelentkezz be, vagy regisztrálj!</p>

                    </div>
                    <div class="text-2xl font-bold text-center text-blue-600">
                        <button class="bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded" onclick="window.location.replace('/posts')">Nézelődnék</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
