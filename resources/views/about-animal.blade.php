<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <div class="container w-full">
                    <div class="flex flex-col gap-7">
                            <img class="w-[512px] rounded self-center" src="{{ asset('storage/'.$animal->image) }}" alt="{{ $animal->name }}">
                            <h1>{{ $animal->name }}</h1>
                            <h2>Elérhetőség</h2>
                            <div class="flex gap-5">                         
                                <p>{{ $user->email }}</p>

                                <?php $formattedNumber = substr($user->phonenumber,2) ?>
                                <p>{{ '+36'.$formattedNumber }}</p>
                            </div>
                            <a class="font-normal text-gray-700 dark:text-gray-400" href="{{url()->to('chatify/'.$user->id)}}">{{ $user->lastname . ' ' . $user->firstname }}</a> 
                            <p>{{ $animal->description }}</p>
                            <p>{{ $color->name}}</p>
                            <p>{{ $animal->created_at->diffForHumans() }}</p>
                    </div>
                   </div>
                </div>
            </div>
        </div>
    </div>

</x-public-layout>
