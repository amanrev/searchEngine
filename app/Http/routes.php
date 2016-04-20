<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


  //Route::any('/admin','UserController@admin_login');


Route::group(['prefix' => 'admin'], function () {


   	  Route::any('/','UserController@admin_login');
   	  Route::any('/dashboard','UserController@admin_dashboard');
   	  Route::any('/login','UserController@admin_login');
   	  Route::any('/log','UserController@admin_log');
   	  Route::any('/logout','UserController@admin_logout');
   	  Route::any('/profile','UserController@admin_profile');
   	  Route::any('/saveProfile','UserController@admin_saveProfile');
   	  Route::any('/checkAdminPassword ','UserController@admin_checkAdminPassword');
   	  Route::any('/changePassword','UserController@admin_changePassword');
      Route::any('/changeAdminImage','UserController@admin_changeAdminImage');
      Route::any('/addUser','UserController@admin_addUser');
      Route::any('/checkEmail','UserController@admin_checkEmail');
      Route::any('/forgotPassword','UserController@admin_forgotPassword');
      Route::any('/resetPassword/{id}/{key}','UserController@admin_resetPassword');
      Route::any('/setNewPassword','UserController@admin_setNewPassword');
      Route::any('/selectPlan','UserController@admin_selectPlan');
      Route::any('/editPlans','UserController@admin_editPlans');
      Route::any('/selectMethod/{id}','UserController@admin_selectMethod');








});
define('HTTP_ROOT','http://'.$_SERVER['HTTP_HOST'].'/smartsearch/admin/');
/*define('HTTP_ROOT_MAIN','http://'.$_SERVER['HTTP_HOST'].'/boutique/public/');
define('HTTP_ROOT_ROO','http://'.$_SERVER['HTTP_HOST'].'/boutique/');*/
