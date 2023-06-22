<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management\ApiController;


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

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/profile', 'AuthController@profile');
    Route::post('/password-verify', 'Authentications\ForgotPasswordController@verify_email');
    Route::post('/password-reset', 'Authentications\ResetPasswordController@reset_response');
});



// ***** GEPG PAYMENT ROUTES STARTS HERE ****** //

//  GePG Bill Request & Response Start//
Route::group(['prefix' => 'gepg-payment'], function() {
    Route::match(['get', 'post'],'payContr', 'GepgBillRequestController@incomingBillResponse');
    Route::match(['get', 'post'],'payInfo', 'GepgBillRequestController@incomingPayResponse');
});


//  GePG Bill Cancelation Start//
Route::group(['prefix' => 'bill-cancel'], function() {
    Route::match(['get', 'post'],'cancel', 'GepgBillCancellationController@incomingCancellationResponse');
});


//  GePG Bill Reconcilliation Start//
Route::group(['prefix' => 'bill-reconcile'], function() {
    Route::match(['get', 'post'],'reconcile', 'GepgPaymentReconcilliationController@incomingBillRecocilliationResponse');
});


// ***** GEPG PAYMENT ROUTES ENDS HERE ****** //

// ***** TLS CHECK PAYMENT ROUTES STARTS HERE ****** //

//  GePG Bill Request & Response Start//
Route::group(['prefix' => 'gepg-payment'], function() {
    Route::match(['get', 'post'],'payContr', 'GepgBillRequestController@incomingBillResponse');
    Route::match(['get', 'post'],'payInfo', 'GepgBillRequestController@incomingPayResponse');
});


//  GePG Bill Cancelation Start//
Route::group(['prefix' => 'bill-cancel'], function() {
    Route::match(['get', 'post'],'cancel', 'GepgBillCancellationController@incomingCancellationResponse');
});


//  GePG Bill Reconcilliation Start//
Route::group(['prefix' => 'bill-reconcile'], function() {
    Route::match(['get', 'post'],'reconcile', 'GepgPaymentReconcilliationController@incomingBillRecocilliationResponse');
});


// ***** TLS CHECK PAYMENT ROUTES ENDS HERE ****** //


// Route::get('/datas', 'Management\ApiController@getData');

Route::get('/newAdvocate', 'Management\ApiController@getAdvocate');
Route::get('/getRenewed', 'Management\ApiController@getToExternalApi');
Route::get('/receiveRenewed', 'Management\ApiController@postToExternalApi');
Route::get('/statusAdvocate', 'Management\ApiController@getAdvocateStatus');

// Route::middleware('auth:sanctum')->group(function () {
// Route::get('/data', 'Management\ApiController@getData');
//     Route::get('/newAdvocate', 'Management\ApiController@getAdvocate');
// });
