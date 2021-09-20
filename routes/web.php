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

            // Admin
Route::middleware(['casAuth','admin'])->group(function(){

    
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });

    
Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout',function(){

    cas()->logout();
    return redirect('htpps://auth.mlouma.com/cas/logout');
});
    //utilisateur
    Route::get('admin/utilisateur', 'UserController@index');
    Route::post('/admin/ajoutUtilisateur','UserController@store');
    Route::get('/admin/modifUtilisateur/{id}', 'UserController@update');
    Route::put('admin/update-utilisateur-saving/{id}', 'UserController@updateSaving');
    Route::post('/admin/deleteUtilisateur/{id}', 'UserController@delete');

    //campagne
    Route::get('admin/campagne', 'CampagneController@index');
    Route::post('/admin/ajoutCampagne','CampagneController@store');
    Route::get('/admin/modifCampagne/{id}', 'CampagneController@update');
    Route::put('admin/update-campagne-saving/{id}', 'CampagneController@updateSaving');
    Route::post('/admin/deleteCampagne/{id}', 'CampagneController@delete');
    Route::get('/admin/detailsCampagne/{id}', 'CampagneController@details');


    //contact 
    Route::get('admin/contact', 'ContactController@index');
    Route::post('/admin/ajoutContact','ContactController@store');
    Route::post('/admin/import_contact', 'ContactController@import');



    //liste contact
    
    Route::get('admin/liste', 'ListeController@index');
    Route::post('/admin/ajoutListe','ListeController@store');
    Route::post('/admin/deleteListe/{id}', 'ListeController@delete');
    Route::get('/admin/modifListe/{id}', 'ListeController@update');
    Route::put('admin/update-liste-saving/{id}', 'ListeController@updateSaving');


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
