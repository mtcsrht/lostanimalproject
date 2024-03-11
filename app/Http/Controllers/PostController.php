<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function create() : View
    {
        $colors = Color::all();

        return view("createpost", compact('colors'));
    }

    public function store(Request $request){
        dd($request->all());
    }
}
