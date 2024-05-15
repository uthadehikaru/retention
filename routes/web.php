<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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

Route::get('/', HomeController::class)->name('home');
Route::redirect('/login', 'admin/login')->name('login');

Route::middleware('auth')->group(function() {
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
});

if(config('app.env')=='production'){
    Livewire::setScriptRoute(function ($handle) {
        return Route::get('/retention/public/livewire/livewire.js', $handle);
    });

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/retention/public/livewire/update', $handle);
    });
}