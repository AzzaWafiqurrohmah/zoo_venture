<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShedController;

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

Route::middleware('guest')->controller(AuthController::class)->group(function(){
    Route::get('/login', 'index')->name('login');
    Route::post('/store', 'store');
});

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', function(){
        return view('pages.dashboard', [ 'title' => 'dashboard']);
    });

    //shed
    Route::prefix('sheds')
        ->name('sheds.')
        ->controller(ShedController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::match(['PUT', 'PATCH'], '{shed}/update', 'update')->name('update');

            Route::get('datatables', 'datatables')->name('datatables');
            Route::get('{shed}', 'show')->name('show');
            Route::delete('{shed}', 'destroy')->name('destroy');
        });
});
