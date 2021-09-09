<?php

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
            // Admin
Route::middleware(['casAuth','admin'])->group(function(){

    
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

    Route::get('/logout',function(){

        cas()->logout();
        return redirect('htpps://auth.mlouma.com/cas/logout');
    });

});


                //Client 
Route::middleware(['casAuth','client'])->group(function(){

    

    Route::get('/client', function () {
        return view('client.client');
    });

    Route::get('/logout',function(){

        cas()->logout();
        return redirect('htpps://auth.mlouma.com/cas/logout');
    });

});
