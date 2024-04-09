<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Az összes várost lekéri.
     *
     * 
     */
    public function index()
    {
        // Az összes várost lekéri az adatbázisból. Alias-t ad a városoknak, hogy az API válaszban a mezőnevek értelmezhetőek legyenek.
        return City::select(['irsz_id as postal_code','counties.name as county', 'cities.name as city'])->join('counties', 'cities.county_id', '=', 'counties.id')->get();
    }

    
    /**
     * Az adott várost lekéri a paraméterben átadott városrészlet alapján.
     *
     * @param  string  $name
     * 
     */
    public function show($name)
    {
        // A várost lekéri az adatbázisból a paraméterben átadott városrészlet alapján. Alias-t ad a városoknak, hogy az API válaszban a mezőnevek értelmezhetőek legyenek.
        return City::where('cities.name', 'like', $name . '%')->join('counties', 'cities.county_id', '=', 'counties.id')->select(['irsz_id as postal_code','counties.name as county', 'cities.name as city'])->get();
    }
}
