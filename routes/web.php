<?php

use App\Http\Controllers\ClientController;
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


Route::get('/logout',function(){

    cas()->logout();
    return redirect('htpps://auth.mlouma.com/cas/logout');
});

                    /* Admin & SuperAdmin */
Route::middleware(['casAuth','admin'])->group(function(){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/admin','ClientController@index');
    
    //utilisateur
    Route::get('admin/utilisateur', 'UserController@index');
    Route::post('/admin/ajoutUtilisateur','UserController@store');
    Route::get('/admin/modifUtilisateur/{id}', 'UserController@update');
    Route::put('admin/update-utilisateur-saving/{id}', 'UserController@updateSaving');
    Route::post('/admin/deleteUtilisateur/{id}', 'UserController@delete');


    //client
    Route::get('admin/client/{id}/infos','DetailClientController@index');
    Route::get('admin/client/{id}/delete','UserController@delete');

    //campagne
    Route::get('admin/campagne', 'CampagneController@index');
    Route::post('/admin/ajoutCampagne','CampagneController@store');
    Route::get('/admin/modifCampagne/{id}', 'CampagneController@update');
    Route::put('admin/update-campagne-saving/{id}', 'CampagneController@updateSaving');
    Route::post('/admin/deleteCampagne/{id}', 'CampagneController@delete');
    Route::get('/admin/detailsCampagne/{id}', 'CampagneController@details');
    Route::post('/admin/ajoutCampagneContact','CampagneController@storeContact');
    Route::post('/admin/deleteContactCampagne/{id}', 'CampagneController@deleteContact');
    Route::post('/admin/import_contactCampagne', 'CampagneController@import');


    //contact 
    Route::get('admin/contact', 'ContactController@index');
    Route::post('/admin/ajoutContact','ContactController@store');
    Route::post('/admin/import_contact', 'ContactController@import');
    Route::get('/admin/modifContact/{id}', 'ContactController@update');
    Route::put('admin/update-contact-saving/{id}', 'ContactController@updateSaving');
    Route::get('/admin/detailsContact/{id}', 'ContactController@details');
    Route::post('/admin/deleteContact/{id}', 'ContactController@delete');



    //liste contact
    
    Route::get('admin/liste', 'ListeController@index');
    Route::post('/admin/ajoutListe','ListeController@store');
    Route::post('/admin/deleteListe/{id}', 'ListeController@delete');
    Route::get('/admin/modifListe/{id}', 'ListeController@update');
    Route::put('admin/update-liste-saving/{id}', 'ListeController@updateSaving');


});
                    /* Profil Client */
Route::middleware(['casAuth','client'])->group(function(){

    Route::get('/client', function () {
        return view('client.client');
    });
    // Route::get('/logout',function(){
    //     cas()->logout();
    //     return redirect('htpps://auth.mlouma.com/cas/logout');
    // });

});
                    /* Personnel */
Route::middleware(['casAuth','personnel'])->group(function(){
    Route::get('/client/personnel', function () {
        return view('client.personnel.index');
    });
    // Route::get('/logout',function(){
    //     cas()->logout();
    //     return redirect('htpps://auth.mlouma.com/cas/logout');
    // });

});
