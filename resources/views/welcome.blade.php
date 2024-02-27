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
        <style>
            .typing-container {
                text-align: center; /* Center typing animation */
                margin-bottom: 20px;   /* Space below animation */
            }
            .typing-text {
                font-size: 20px;
                font-weight: bold;
                color: black; 
                overflow: hidden;
                border-right: 0.2em solid; /* Typing 'cursor' */
                white-space: nowrap;       
                animation: typing 2s steps(20) forwards, blink 0.5s infinite;
            }
    
            @keyframes typing {
                from { width: 0 }
                to { width: 100% } 
            }
            @keyframes blink { 
                50% { border-color: transparent }
            }
        </style>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])       
    </head>
    <body class="antialiased bg-slate-100">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div> 
                <div class="typing-container">
                    <span class="typing-text"></span>
                </div>
                <div class="text-3xl font-bold text-center text-blue-600">
                    <button class="bg-cyan-600 hover:bg-cyan-500 text-white font-bold py-2 px-4 rounded" onclick="window.location.replace('/posts')">Nézelődnék</button>
                </div>
            </div>
        </div>
    </body>
    <script>
        const typingText = document.querySelector('.typing-text');
        const textToType = "Üdvözöllek, kérlek jelentkezz be, vagy regisztrálj, ha csak nézelődni szeretnél kattins az alattam lévő gombra!";

        let index = 0;
        function type() {
            if (index < textToType.length) {
                typingText.textContent += textToType.charAt(index);
                index++;
                setTimeout(type, 50); // Adjust typing speed
            }
        }
        type(); 
    </script>
</html>
