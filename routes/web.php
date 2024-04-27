<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ShedController;
use App\Http\Controllers\SpeciesController;

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
    return view('landing');
});

Route::prefix('code')
    ->name('code.')
    ->controller(CodeController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('datatables', 'dataTables')->name('datatables');
        Route::get('generate', 'generate')->name('generate');
        Route::get('enter', 'enter')->name('enter');
        Route::get('invalid', 'invalid')->name('invalid');
        Route::post('check', 'check')->name('check');

        Route::get('{code}', 'show')->name('show');
        Route::delete('{code}', 'destroy')->name('destroy');
    });

Route::prefix('maps')
    ->name('maps.')
    ->controller(MapController::class)
    ->middleware('code')
    ->group(function () {
        Route::get('/', 'show')->name('show');
    });

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/store', 'store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard', ['title' => 'dashboard']);
    });

    //sheds
    Route::prefix('sheds')
        ->name('sheds.')
        ->controller(ShedController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('/{shed}/edit', 'edit')->name('edit');
            Route::match(['PUT', 'PATCH'], '{shed}/update', 'update')->name('update');
            Route::get('datatables', 'datatables')->name('datatables');
            Route::get('{shed}', 'show')->name('show');
            Route::delete('{shed}', 'destroy')->name('destroy');
        });

    //species
    Route::prefix('species')
        ->name('species.')
        ->controller(SpeciesController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('/{species}/edit', 'edit')->name('edit');
            Route::match(['PUT', 'PATCH'], '{species}/update', 'update')->name('update');
            Route::get('datatables', 'datatables')->name('datatables');
            Route::get('{species}', 'show')->name('show');
            Route::delete('{species}', 'destroy')->name('destroy');
        });
});


    // Route::get('/', [QrCodeController::class, 'show']);
