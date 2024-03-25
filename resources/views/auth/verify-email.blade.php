<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Köszönjük, hogy regisztráltál! Mielőtt belekezdünk, kérlek erősítsd meg az e-mail címed a linken keresztül amit a regisztrációkor megadott e-mail címre küldtünk. Ha nem kaptad meg az e-mail-t akkor kérj egy újat.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Egy új megerősítő linket küldtünk az email címedre amit megadtál a regisztrációkor.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Megerősítő email újraküldése') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Kijelentkezés') }}
            </button>
        </form>
    </div>
</x-guest-layout>
