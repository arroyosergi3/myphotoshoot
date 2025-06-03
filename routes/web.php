<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PhotoshootController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\isPhotographer;
use App\Http\Middleware\MultiAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
//->middleware(MultiAuth::class)
->name('dashboard');

Route::middleware(MultiAuth::class)->group(function () {
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

Route::post('/loginForPhotographer', [AuthenticatedSessionController::class,'storeForPhotographer'])->name('loginForPhotographers');
Route::post('/logoutForPhotographers', [AuthenticatedSessionController::class,'destroyForPhotographer'])->name('logoutForPhotographers');

Route::resource('gallery', GalleryController::class);
Route::resource('pack', PackController::class)->middleware(isPhotographer::class);
Route::resource('photo', PhotoController::class);
Route::resource('photoshoot', PhotoshootController::class)->middleware(isPhotographer::class);
Route::resource('product', ProductController::class)->middleware(isPhotographer::class);
Route::resource('appointment', AppointmentController::class);

Route::get('/available-hours', [AppointmentController::class, 'availableHours'])->name('appointment.available-hours');


Route::get('/calendar', function () {
    return view('calendar.index');
})
->name('calendar');


//VISTA PARA CLIENTES
Route::get('/photographer/{photographer}', [PhotoshootController::class,'clientIndex'])->name('photographerPhotoshoots');
Route::get('/photographer/{photographer}/{photoshoot}', [PhotoshootController::class,'clientPhotoshootIndex'])->name('photoshootPacks');

Route::get('/pack/{pack}/addcontent', [PackController::class,'content'])->name('addcontent');
Route::post('/pack/{pack}/addcontent', [PackController::class, 'addContent'])->name('pack.addcontent');



require __DIR__.'/auth.php';
