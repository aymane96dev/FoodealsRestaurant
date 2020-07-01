<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('service','DocumentController@test');

Route::post('/inserer', 'ServiceController@InsererClient');
Route::post('/login', 'ServiceController@loginClient');
Route::post('/listeProduits', 'ServiceController@listPro');
Route::post('/login', 'ServiceController@login');
Route::post('/supprimerProd', 'ServiceController@SupprimerPro');
Route::post('/newCommande', 'ServiceController@AjouterPanier');



