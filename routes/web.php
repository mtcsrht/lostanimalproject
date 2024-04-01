<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\AdminController;
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
    Route::get('/myposts', [PostController::class, 'self'])->name('myposts.index');
    Route::delete('/myposts/{animal}', [PostController::class, 'destroy'])->name('myposts.destroy');
    Route::get('/myposts/{animal}/edit', [PostController::class, 'edit'])->name('myposts.edit');
    Route::post('/myposts/{animal}/edit', [PostController::class, 'update'])->name('myposts.update');
    Route::get('/createpost', [PostController::class, 'create'])->name('createpost');
    Route::post('/createpost', [PostController::class, 'store'])->name('uploadpost');
});

Route::get('/posts', [PostController::class, 'show'])->name('posts.show');
Route::get('/about-animal/{animal}', [PostController::class,'index'])->name('about-animal.index');


Route::middleware('admin')->group(function (){
    Route::get('/admin', [AdminController::class, 'show'])->name('admin.show');
    Route::delete('/admin', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::patch('/admin', [AdminController::class, 'update'])->name('admin.update');
});

require __DIR__.'/auth.php';
