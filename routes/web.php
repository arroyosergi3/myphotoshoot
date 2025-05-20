<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PhotoshootController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
//->middleware(['auth', 'verified'])
->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/loginForPhotographer', function () {
    return view('auth.loginForPhotographers');
})->name('loginForPhotographers');

Route::get('/registerForPhotographers', function () {
    return view('auth.registerForPhotographers');
})->name('registerForPhotographers');


Route::resource('gallery', GalleryController::class);
Route::resource('pack', PackController::class);
Route::resource('photo', PhotoController::class);
Route::resource('photoshoot', PhotoshootController::class);
Route::resource('product', ProductController::class);

require __DIR__.'/auth.php';
