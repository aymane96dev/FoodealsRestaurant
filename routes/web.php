<?php

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

Auth::routes();

//  Route::get('/home', 'HomeController@commandeCourante')->name('home');
Route::get('/home', 'ProduitRestoController@commandeCourante')->name('home');
Route::get('/Mesproduits', 'ProduitRestoController@index');
Route::post('/addProduits', 'ProduitRestoController@store');
Route::post('/modifierProduits', 'ProduitRestoController@update');
Route::get('/poduitDeleted/{id}', 'ProduitRestoController@bloquer');
Route::get('/afficheModel/{id}', 'ProduitRestoController@checking');
Route::get('/profile', 'ProduitRestoController@profile');
Route::post('/modifierRestoC', 'ProduitRestoController@modifierResto');
Route::get('/historique', 'ProduitRestoController@historique');
Route::post('/confirm', 'ProduitRestoController@check');
Route::get('/verify', 'ProduitRestoController@print');
Route::get('/annulerProd/{id}', 'ProduitRestoController@cancel');
Route::get('/supprimerProd/{id}', 'ProduitRestoController@supprimer');

Route::get('/documents', 'DocumentController@index')->name('documents');
Route::post('/addDocument', 'DocumentController@store')->name('addDocument.store');
Route::get('/Document/{id}','DocumentController@destroy')->name('document.destroy');
Route::get('/commandeTimer', 'ProduitRestoController@commandeCouranteTimer');


Route::post('/produitsCourants', 'ProduitRestoController@ProduitsCourants');
Route::get('/commandeCouranteA', 'ProduitRestoController@commandeCouranteA');

Route::get('/commandeslivrees', 'ProduitRestoController@commandeLivree');
Route::post('/produitsLivres', 'ProduitRestoController@produitsLivrees');

Route::get('/cpt_com', 'ProduitRestoController@cpt_com');





