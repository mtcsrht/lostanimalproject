<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\User;
use App\Models\Color;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Js;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;

class PostController extends Controller
{

    /**
     * Lekéri a bejelentkezett user állatait. Az állatokat a myposts.blade.php oldalon jeleníti meg.
     * 
     */
    public function self(Request $request) : View
    {
        // Az állatokat lekéri a bejelentkezett user id-je alapján.
        $animals = Animal::where("userId", auth()->user()->id)->get();
        // A myposts.blade.php oldalon jeleníti meg az állatokat.
        return view("myposts", compact("animals"));
    }

    /**
     * Az állat adatait jeleníti meg.
     * 
     */
    public function index(Animal $animal): View
    {
        // Az állat gazdájának adatait lekéri az állat userId mezője alapján.
        $user = User::where('id', $animal->userId)->first();
        // Az állat színének adatait lekéri az állat colorId mezője alapján.
        $color = Color::where('id', $animal->colorId)->first();
        // Az about-animal.blade.php oldalon jeleníti meg az állat adatait.
        return view("about-animal", compact("animal", "user", "color"));
    }
    
    /**
     * Az állatokat jeleníti meg a posts.blade.php oldalon.
     * 
     */
    public function show(Request $request): View
    {
        // Az állatokat lekéri a szűrőfeltételek alapján.
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
        // A posts.blade.php oldalon jeleníti meg az állatokat.
        return view("posts", compact("animals", "users", "colors"));
    }

    /**
     * Az állatokat jeleníti meg az API-n keresztül.
     */
    public function showApi()
    {
        $animals = Animal::all(); 
        return $animals;
    }

    /**
     * Megjeleníti a szerkesztés oldalt.
     */
    public function edit(Animal $animal) : View
    {
        $colors = Color::all();
        return view("editpost", compact('animal', 'colors'));
    }

    /**
     * Frissíti az állat adatait.
     */
    public function update(Request $request, Animal $animal) : RedirectResponse
    {
        // Az állat adatainak validálása.
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
            [ // A validálási hibák üzenetei.
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

        // Az állat adatainak frissítése.
        $animal->name = $request->name;
        $animal->chipNumber = $request->chip;
        $animal->gender = $request->gender;
        $animal->colorId = $request->color;
        $animal->description = $request->description;

        // Az állat képének frissítése, ha a kép változott.
        if ($request->hasFile('picture')) {
            $imagePath = $request->file('picture')->store(
                'animal-pictures',
                'public'
            );
            $animal->image = $imagePath;
        }
        // Az állat adatainak mentése.
        $animal->save();
        // A myposts.blade.php oldalra irányítás. Egy animal-updated státuszüzenettel.
        return Redirect::route('myposts.index')->with('status','animal-updated');
    }

    /**
     * Az állat törlése.
     */
    public function destroy(Animal $animal)
    {   
        // Az állat képének törlése, ha egyeltalán létezik az a kép(hibakezelés).
        $imagePath = $animal->image;
        if(file_exists(public_path('storage/'.$imagePath)))
        {
            unlink(public_path('storage/'.$imagePath));
        }
        // Az állat törlése.
        $animal->delete();
        // A myposts.blade.php oldalra irányítás. Egy animal-deleted státuszüzenettel.
        return Redirect::route('myposts.index')->with('status','animal-deleted');
    }

    /**
     * Az állat létrehozásához szükséges blade oldal megjelenítése.
     */
    public function create() : View
    {
        $colors = Color::all();
        return view("createpost", compact('colors'));
    }

    /**
     * Az állat létrehozása az adatbázisba.
     */
    public function store(Request $request) : RedirectResponse
    {
        // Az állat adatainak validálása.
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
            [ // A validálási hibák üzenetei.
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
        // Az állat képének elmentése.
        $imagePath = $request->file('picture')->store(
            'animal-pictures',
            'public'
        );

        // Az állat létrehozása.
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
        
        // A myposts.blade.php oldalra irányítás. Egy animal-uploaded státuszüzenettel.  
        return Redirect::route('myposts.index')->with('status','animal-uploaded');
    }
}
