<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return City::select(['irsz_id as postal_code', 'name as city', 'county_id as county'])->join('counties', 'cities.county_id', '=', 'counties.id')->select(['irsz_id as postal_code','counties.name as county', 'cities.name as city'])->get();
    }
    public function show($name)
    {
        return City::where('cities.name', 'like', $name . '%')->join('counties', 'cities.county_id', '=', 'counties.id')->select(['irsz_id as postal_code','counties.name as county', 'cities.name as city'])->get();
    }
}
