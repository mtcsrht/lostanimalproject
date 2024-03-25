<x-public-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container w-full">
                        <div class="flex flex-col gap-7">
                            <img id="animal-image" class="w-[512px]  self-center cursor-pointer rounded shadow-xl" src="{{ asset('storage/'.$animal->image) }}" alt="{{ $animal->name }}">
                            <div class="flex flex-col gap-6 items-center justify-center mb-12">
                                <h1 class="font-bold text-xl gap-3">Állat jellemzői</h1>
                                <div class="flex flex-col sm:flex-row gap-3 ">
                                        <p><span class="font-bold">Név:</span> {{ $animal->name }}</p>
                                        <p><span class="font-bold">Szín:</span> {{ $color->name }}</p>
                                        <p><span class="font-bold">Nem:</span> {{ $animal->gender==1 ? 'Hím':'Nőstény' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-6 items-center justify-center ">
                                <h1 class="font-bold text-xl gap-3">Elérhetőség</h1>
                                <div class="flex flex-col sm:flex-row gap-3 ">
                                    <p><span class="font-bold">Név: <a class="font-normal text-gray-700 dark:text-gray-400" href="{{ url()->to('chatify/'.$user->id) }}">{{ $user->lastname . ' ' . $user->firstname }}</a></span></p>
                                    <p></p>
                                    <a href="mailto:{{ $user->email }}"><span class="font-bold">Email:</span> {{ $user->email }}</a>
                                    <?php $formattedNumber = substr($user->phonenumber,2) ?>
                                    <a href="tel:{{ '+36'. $user->phonenumber }}"><span class="font-bold">Telefonszám:</span> {{ '+36'.$formattedNumber }}</a>
                                  
                            </div>
                            </div>
                            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
                            <h1 class="font-bold text-xl">Leírás</h1>
                            <p class="text-left max-w-full">{{ $animal->description }}</p>
                            <p class="text-gray-500 mt-5 "><span class="font-bold text-black">Feltöltés: </span>{{ $animal->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="image-modal" class="fixed top-0 left-0 z-50 w-full h-full bg-gray-900 bg-opacity-75 flex justify-center items-center hidden">
        <div class=""> 
            <img id="enlarged-image" class="object-contain max-h-full " src="{{ asset('storage/'.$animal->image) }}" alt="{{ $animal->name }}"> <!-- Added object-contain and max-h-full classes -->
        </div>
    </div>
</x-public-layout>

<script>
    let animalImage = document.getElementById('animal-image');
    let enlargedImage = document.getElementById('enlarged-image');
    let imageModal = document.getElementById('image-modal');

    animalImage.addEventListener('click', () => {
        enlargedImage.src = animalImage.src;
        imageModal.classList.remove('hidden');
    });

    imageModal.addEventListener('click', (event) => {
        if (event.target === imageModal) {
            imageModal.classList.add('hidden');
        }
    });
</script>
