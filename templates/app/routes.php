<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Página de login
Route::any('/', array("as" => "login", "uses" => "LoginController@login"));

// Páginas seguras
Route::group(array("before" => "auth"), function() {
        
    // Páginas X
    Route::any("/dashboard"      , array("as" => "dashboard"  , "uses" => "DashboardController@index"));
    Route::get("/logout"         , array("as" => "logout"     , "uses" => "LoginController@logout"));
    Route::post("/userslist"     , array("as" => "userslist"  , "uses" => "UsersController@listAjax"));
    
    // Restfull controllers
    Route::resource('users'     , 'UsersController');
    
});

// WS

// WS, páginas protegidas
Route::group(array("before"=>"auth.token", "prefix"=>"apiv1"), function() {
   
});