<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{
    
    public function self(Request $request)
    {
        $animals = Animal::where("userId", auth()->user()->id)->get();
        return view("myposts", compact("animals"));
    }

    public function index(Animal $animal){
        $animal = Animal::where('uuid', $animal->uuid)->first();
        $user = User::where('id', $animal->userId)->first();
        $color = Color::where('id', $animal->colorId)->first();
        return view("about-animal", compact("animal", "user", "color"));
    }
    
    public function show(Request $request){

        $animals = Animal::when($request->color_id, function ($query, $color_id) {
                    return $query->where('colorId', $color_id);
                })->when($request->gender, function ($query, $gender) {
                    return $query->where('gender', $gender);
                })->when($request->chipNumber, function ($query, $chipNumber) {
                    if($chipNumber == "has"){
                        return $query->whereNotNull('chipNumber');
                    }else{
                        return $query->whereNull('chipNumber');
                    }
                })->when($request->query('sort_by'), function($query, $sort_by){
                    if($sort_by){
                        list($column, $direction) = explode('-', $sort_by);
                        return $query->orderBy($column, $direction);
                    }else{
                        return $query;
                    }
                })->paginate(6);
        $users = User::all();
        $colors = Color::all();
        return view("posts", compact("animals", "users", "colors"));
    }
    public function showApi() {
        $animals = Animal::all(); 
        return $animals;
    }

    public function edit(Animal $animal) : View
    {
        $colors = Color::all();
        return view("editpost", compact('animal', 'colors'));
    }

    public function update(Request $request, Animal $animal) : RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'chip' => ['nullable','string', 'max:16'],
            'gender' => ['required'],
            'color' => ['required'],
            'description' => ['required', 'string', 'max:1000'],
            'picture' => [
                'nullable',
                'image',
                'mimes:jpg,png,jpeg,svg',
                'max:2048'
            ],
        ],
            [
                'name.required' => 'A név mezőt kötelező kitölteni',
                'name.string' => 'A név mezőnek karakterláncnak kell lennie',
                'chip.string' => 'A chip mezőnek karakterláncnak kell lennie',
                'chip.max' => 'A chip mező nem haladhatja meg a 16 számjegyet',
                'description.required' => 'A leírás mezőt kötelező kitölteni',
                'description.string' => 'A leírás mezőnek karakterláncnak kell lennie',
                'description.max' => 'A leírás mező nem haladhatja meg az 1000 karaktert',
                'picture.required' => 'A kép mezőt kötelező kitölteni',
                'picture.image' => 'A fájlnak képnek kell lennie',
                'picture.mimes' => 'A fájlnak jpg, png, jpeg, vagy svg kiterjesztésű fájlnak kell lennie',
                'picture.max' => 'A fájl mérete nem haladhatja meg a 2048 kilobájtot',

            ]
        );

        
        $animal->name = $request->name;
        $animal->chipNumber = $request->chip;
        $animal->gender = $request->gender;
        $animal->colorId = $request->color;
        $animal->description = $request->description;

        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture')->store(
                'animal-pictures',
                'public'
            );
            $animal->image = $imagePath;
        }

        $animal->save();

        return Redirect::route('myposts.index')->with('status','animal-updated');
    }
    public function destroy(Animal $animal)
    {   
        $imagePath = $animal->image;
        if(file_exists(public_path('storage/'.$imagePath)))
        {
            unlink(public_path('storage/'.$imagePath));
        }
        $animal->delete();
        return Redirect::route('myposts.index')->with('status','animal-deleted');
    }
    public function create() : View
    {
        $colors = Color::all();

        return view("createpost", compact('colors'));
    }
    
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'chip' => ['nullable','string', 'max:16'],
            'gender' => ['required'],
            'color' => ['required'],
            'description' => ['required', 'string', 'max:1000'],
            'picture' => [
                'required',
                'image',
                'mimes:jpg,png,jpeg,svg',
                'max:2048'
            ],
        ],
            [
                'name.required' => 'A név mezőt kötelező kitölteni',
                'name.string' => 'A név mezőnek karakterláncnak kell lennie',
                'chip.string' => 'A chip mezőnek karakterláncnak kell lennie',
                'chip.max' => 'A chip mező nem haladhatja meg a 16 számjegyet',
                'description.required' => 'A leírás mezőt kötelező kitölteni',
                'description.string' => 'A leírás mezőnek karakterláncnak kell lennie',
                'description.max' => 'A leírás mező nem haladhatja meg az 1000 karaktert',
                'picture.required' => 'A kép mezőt kötelező kitölteni',
                'picture.image' => 'A fájlnak képnek kell lennie',
                'picture.mimes' => 'A fájlnak jpg, png, jpeg, vagy svg kiterjesztésű fájlnak kell lennie',
                'picture.max' => 'A fájl mérete nem haladhatja meg a 2048 kilobájtot',

            ]
        );

        $imagePath = $request->file('picture')->store(
            'animal-pictures',
            'public'
        );


        Animal::create([
            'uuid' => Uuid::uuid4()->toString(),
            'userId' => $request->user()->id,
            'name'=> $request->name,
            'chipNumber' => $request->chip,
            'gender' => $request->gender,
            'colorId' => $request->color,
            'description' => $request->description,
            'image' => $imagePath,
        ]);
        
                
        return Redirect::route('myposts.index')->with('status','animal-uploaded');
    }
}
