<?php

use App\Http\Controllers\Auth\LoginController;
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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout',function(){

    cas()->logout();
    return redirect('https://auth.mlouma.com/cas/logout');
});
Route::middleware(['casAuth'])->get('/login','RedirectController@redirectUser');

                    /* Admin & SuperAdmin */
Route::middleware(['casAuth','admin'])->group(function(){

    Route::get('/admin','ClientController@index');
    //utilisateur
    Route::get('admin/utilisateur', 'UserController@index');
    Route::post('/admin/ajoutUtilisateur','UserController@store');
    Route::get('/admin/modifUtilisateur/{id}', 'UserController@update');
    Route::put('admin/update-utilisateur-saving/{id}', 'UserController@updateSaving');
    Route::get('/admin/deleteUtilisateur/{id}', 'UserController@delete');

    // Packs




    //client
    Route::get('admin/client/{id}/infos','DetailClientController@index');
    Route::get('admin/client/{id}/delete','UserController@delete');

    //campagne
    Route::get('admin/campagne', 'CampagneController@index');
    Route::post('/admin/ajoutCampagne','CampagneController@store');
    Route::get('/admin/modifCampagne/{id}', 'CampagneController@update');
    Route::put('admin/update-campagne-saving/{id}', 'CampagneController@updateSaving');
    Route::get('/admin/deleteCampagne/{id}', 'CampagneController@delete');
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
    Route::get('/admin/deleteContact/{id}', 'ContactController@delete');

    //



    //liste contact

    Route::get('admin/liste', 'ListeController@index');
    Route::post('/admin/ajoutListe','ListeController@store');
    Route::post('/admin/deleteListe/{id}', 'ListeController@delete');
    Route::get('/admin/modifListe/{id}', 'ListeController@update');
    Route::put('admin/update-liste-saving/{id}', 'ListeController@updateSaving');






    //Message
    Route::get('admin/message', 'MessageController@index');
    //historique
    Route::get('admin/historique', 'HistController@index');

    Route::post('/admin/envoi-message','MessageController@store');

    //notifications
    Route::get('admin/notifications', 'NotificationController@index');





});
                    /* Profil Client */
Route::middleware(['casAuth','client'])->group(function(){

    Route::get('/client','ClientController@index');
    Route::get('/client/{id}/dashbaord','DetailClientController@index');

    Route::get('client/utilisateur', 'UserController@index');
    Route::post('/client/ajoutUtilisateur','UserController@store');
    Route::get('/client/modifUtilisateur/{id}', 'UserController@update');
    Route::put('client/update-utilisateur-saving/{id}', 'UserController@updateSaving');
    Route::get('/client/deleteUtilisateur/{id}', 'UserController@delete');



    //contact
    Route::get('client/contact', 'ContactController@index');
    Route::post('/client/ajoutContact','ContactController@store');
    Route::post('/client/import_contact', 'ContactController@import');
    Route::get('/client/modifContact/{id}', 'ContactController@update');
    Route::put('client/update-contact-saving/{id}', 'ContactController@updateSaving');
    Route::get('/client/detailsContact/{id}', 'ContactController@details');
    Route::get('/client/deleteContact/{id}', 'ContactController@delete');



    Route::get('/client/packs','PackController@index');
    Route::get('/client/packs/paiement','PackController@buy');
    Route::get('/client/packs/retourpaiement','PackController@retourpaiement');
    Route::get('/client/packs/detailPaiement','PackController@detailPaiement');

    #HISTORIQUE
    Route::get('client/historique','HistController@index');
    //campagne
    Route::get('client/campagne', 'CampagneController@index');
    Route::post('/client/ajoutCampagne','CampagneController@store');
    Route::get('/client/modifCampagne/{id}', 'CampagneController@update');
    Route::put('client/update-campagne-saving/{id}', 'CampagneController@updateSaving');
    Route::get('/client/deleteCampagne/{id}', 'CampagneController@delete');
    Route::get('/client/detailsCampagne/{id}', 'CampagneController@details');
    Route::post('/client/ajoutCampagneContact','CampagneController@storeContact');
    Route::get('/client/deleteContactCampagne/{id}', 'CampagneController@deleteContact');
    Route::post('/client/import_contactCampagne', 'CampagneController@import');

    //Message
    Route::get('client/message', 'MessageController@index');
    Route::post('/client/envoi-message','MessageController@store');

    //Notifications
    Route::get('client/notifications', 'NotificationController@index');


});

    //choix dynamique

    Route::get('choixdept/{dept}', 'ChoixController@choixDept');
    Route::get('choixcomm/{comm}', 'ChoixController@choixComm');
                    /* Personnel */
// Route::middleware(['casAuth','personnel'])->group(function(){
//     Route::get('/client/personnel', function () {
//         return view('client.personnel.index');
//     });
    // Route::get('/logout',function(){
    //     cas()->logout();
    //     return redirect('htpps://auth.mlouma.com/cas/logout');
    // });

// });
Route::middleware(['casAuth'])->group(function(){

    Route::get('/admin/packs','PackController@index');
    Route::get('/admin/packs/paiement','PackController@buy');
    Route::get('/admin/packs/retourpaiement','PackController@retourpaiement');
    Route::get('/admin/packs/detailPaiement','PackController@detailPaiement');

    Route::get('admin/markAsRead/{id}', 'NotificationController@notificationsMarkAsRead');

});
