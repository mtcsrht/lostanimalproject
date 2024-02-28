<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function GetAllCities(){
        $cities = City::all();
        return response()->json($cities);
    }
    public function GetKeywordCities($name){
        $cities = City::where('name', 'like','%'.$name.'%')->get();
        return response()->json($cities);
    }
}
