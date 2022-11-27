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

Auth::routes();

Route::group(["middleware" => ["auth", "2fa"]], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(["prefix" => "2fa"], function() {
        Route::get("/get-qrcode", "TwoFaceAuthController@index")->name("2fa.getQrCode");
        Route::post("/enable", "TwoFaceAuthController@enable")->name("2fa.enable");
        Route::post("/disable", "TwoFaceAuthController@disable")->name("2fa.disable");
    });
});

Route::group(["middleware" => ["auth"], "prefix" => "2fa"], function() {
    Route::get("/form-verify", "VerifyTwoFaceController@index")->name("2fa.verifyForm");
    Route::post("/verify", "VerifyTwoFaceController@verify")->name("two_face.verify");
});
