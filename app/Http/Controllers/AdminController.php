<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Animal;
use App\Models\City;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * Az admin oldalon jeleníti meg a felhasználókat és a városokat.
     * 
     * @return \Illuminate\View\View
     */
    public function show()
    {       
        // Az összes felhasználót és várost lekéri az adatbázisból.
        $users = User::all();
        $cities = City::all();
        // Az admin.blade.php oldalon jeleníti meg a felhasználókat és a városokat.
        return view('admin', compact('users', 'cities'));
    }


    /**
     * Az destroy metódus törli a felhasználót.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {     
        // A felhasználót törli az adatbázisból.
        User::where('id', $request->user)->delete();
        // Az admin oldalra visszatér egy státusszüzüzenettel.
        return redirect()->route('admin.show')->with('status', 'user-deleted');
    }

    
    /**
     * Az update metódus frissíti a felhasználó adatait.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // A felhasználó adatait validálja.
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|min:11',
            'irsz'  => 'required',
        ],
        [ // A hibás validáció esetén hibaüzenetet küld.
            'firstname.required' => 'Keresztnév megadása kötelező!',
            'lastname.required' => 'Vezetéknév megadása kötelező!',
            'phone.required' => 'Telefonszám megadása kötelező!',
            'phone.min' => 'A telefonszám hossza legalább 11 karakter kell legyen!',
            'irsz.required' => 'Irányítószám megadása kötelező!',
        ]);
        // A felhasználót lekéri az adatbázisból.
        $user = User::where('id', $request->user)->first();
        // A felhasználó adatait frissíti.
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phonenumber = $request->phone;
        $user->irsz_id = $request->irsz;
        // A felhasználó adatait menti.
        $user->save();
        // Az admin oldalra visszatér egy státusszüzüzenettel.
        return redirect()->route('admin.show')->with('status', 'user-updated');
    }
}
