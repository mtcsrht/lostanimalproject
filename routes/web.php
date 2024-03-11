<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController; 
use App\Models\Animal;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/myposts', [AnimalController::class, 'index'])->name('myposts.index');
    Route::get('/createpost', [PostController::class, 'create'])->name('createpost');
    Route::post('/createpost', [PostController::class, 'store'])->name('uploadpost');
});



require __DIR__.'/auth.php';
