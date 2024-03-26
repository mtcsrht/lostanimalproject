<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Animal;
use App\Models\City;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function checkIfAdmin()
    {
        try
        {
            Admin::where('email', auth()->user()->email)->firstOrFail();
        }
        catch(\Exception $e)
        {
            return abort(403, 'Hozzáférés megtagadva!');
        }
    }
    public function show()
    {
        
        $this->checkIfAdmin();
        $users = User::all();
        $cities = City::all();
        return view('admin', compact('users', 'cities'));
    }

    public function destroy(Request $request)
    {       
        $this->checkIfAdmin();
        User::where('id', $request->user)->delete();
        return redirect()->route('admin.show')->with('status', 'user-deleted');
    }

    public function update(Request $request)
    {
        
        $this->checkIfAdmin();

        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required|min:11',
            'irsz'  => 'required',
        ],
        [
            'firstname.required' => 'Keresztnév megadása kötelező!',
            'lastname.required' => 'Vezetéknév megadása kötelező!',
            'phone.required' => 'Telefonszám megadása kötelező!',
            'phone.min' => 'A telefonszám hossza legalább 11 karakter kell legyen!',
            'irsz.required' => 'Irányítószám megadása kötelező!',
        ]);
        $user = User::where('id', $request->user)->first();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phonenumber = $request->phone;
        $user->irsz_id = $request->irsz;
        $user->save();

        return redirect()->route('admin.show')->with('status', 'user-updated');
    }
}
