<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Admin;

class AdminAuthenticate
{
    /**
    * Ellenőrzi, hogy a bejelentkezett user admin-e.
    */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !Admin::where('email', auth()->user()->email)->exists()) {
            return abort(403, 'Hozzáférés megtagadva!');
        }

        return $next($request);
    }
}
