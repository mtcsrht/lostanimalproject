<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'firstname' => ['required','string','max:255'],
            'lastname' => ['required','string','max:255'],
            'phonenumber' => ['required','numeric','min:11'],
            'postalCode' => ['required','string', 'min:4', 'max:4'],
        ],[
            'name.required' => 'A név megadása kötelező.',
            'name.string' => 'A név csak szöveg lehet.',
            'name.max' => 'A név maximum 255 karakter hosszú lehet.',
            'email.required' => 'Az e-mail cím megadása kötelező.',
            'email.string' => 'Az e-mail cím csak szöveg lehet.',
            'email.lowercase' => 'Az e-mail cím csak kisbetűket tartalmazhat.',
            'email.email' => 'Az e-mail cím formátuma nem megfelelő.',
            'email.max' => 'Az e-mail cím maximum 255 karakter hosszú lehet.',
            'email.unique' => 'Az e-mail cím már foglalt.',
            'password.required' => 'A jelszó megadása kötelező.',
            'password.confirmed' => 'A jelszavak nem egyeznek.',
            'password.min' => 'A jelszó legalább :min karakter hosszú kell legyen.',
            'password.pw' => 'A jelszó legalább egy kisbetűt, egy nagybetűt, egy számot és egy speciális karaktert tartalmazzon.',
            'firstname.required' => 'A keresztnév megadása kötelező.',
            'firstname.string' => 'A keresztnév csak szöveg lehet.',
            'firstname.max' => 'A keresztnév maximum 255 karakter hosszú lehet.',
            'lastname.required' => 'A vezetéknév megadása kötelező.',
            'lastname.string' => 'A vezetéknév csak szöveg lehet.',
            'lastname.max' => 'A vezetéknév maximum 255 karakter hosszú lehet.',
            'phonenumber.required' => 'A telefonszám megadása kötelező.',
            'phonenumber.numeric' => 'A telefonszám csak szám lehet.',
            'phonenumber.min' => 'A telefonszám minimum 11 karakter hosszú kell legyen.',
            'postalCode.required' => 'Az irányítószám megadása kötelező.',
            'postalCode.string' => 'Az irányítószám csak szöveg lehet.',
            'postalCode.max' => 'Az irányítószám maximum 4 karakter hosszú lehet.',
            'postalCode.min' => 'Az irányítószám minimum 4 karakter hosszú kell legyen.',
        ]);
       
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'firstname' => $request->firstname,
            'lastname'=> $request->lastname,
            'phonenumber' => $request->phonenumber,
            'IRSZ_Id' => $request->postalCode,
        ]);
        
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
