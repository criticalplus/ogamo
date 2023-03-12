<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\UnirseController;
use App\Http\Livewire\MainLive;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])
        ->group(function () {

            Route::get('/dashboard', MainLive::class)   ->name('dashboard');

            Route::controller( UnirseController::class)->group(function () {
            
                Route::get ('/uniReg', 'index' )->name('indexUni');
                Route::post ('/uniReg/{id}', 'unirse' )->name('uniReg');
            
            });

            Route::get('/test', [TestController::class, 'index'] )   ->name('test');

});
