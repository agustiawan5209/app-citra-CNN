<?php

use App\Http\Controllers\DataLatihController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisTanamanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/camera', [HomeController::class, 'camera'])->name('camera');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::group(['prefix'=> 'tanaman-obat', 'as'=> 'Tanaman.'], function(){
        Route::controller(JenisTanamanController::class)->group(function(){
            Route::get('/tanaman-obat', 'index')->name('index');
            Route::get('/tambah-tanaman-obat', 'create')->name('create');
            Route::get('/detail-tanaman-obat', 'show')->name('show');
            Route::get('/ubah-tanaman-obat', 'edit')->name('edit');


            Route::put('/update-tanaman-obat', 'update')->name('update');
            Route::post('/store-tanaman-obat', 'store')->name('store');
            Route::delete('/destroy-tanaman-obat', 'destroy')->name('destroy');
        });
    });


    // Data Latih
    Route::group(['prefix'=> 'data-latih', 'as'=> 'DataLatih.'], function(){
        Route::controller(DataLatihController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/tambah-data-latih', 'create')->name('create');
            Route::get('/detail-data-latih', 'show')->name('show');
            Route::post('/store-data-latih', 'store')->name('store');
            Route::delete('/destroy-data-latih', 'destroy')->name('destroy');
        });
    });



});

require __DIR__.'/auth.php';
