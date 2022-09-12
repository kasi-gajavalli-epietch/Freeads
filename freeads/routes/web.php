<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertisementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/advertisement/search', [AdvertisementController::class, 'search'])->name('search');

require __DIR__.'/auth.php';

 Route::get('/', function () {
    return redirect('advertisement');
});

Route::get('advertisement/admin', [AdvertisementController::class, 'admin'])
    ->name('advertisement.admin');

Route::get('advertisement/category/{id}', [AdvertisementController::class, 'adsByCategory'])
    ->name('advertisement.adsByCategory');

Route::resource('advertisement', AdvertisementController::class);

//Auth::routes();