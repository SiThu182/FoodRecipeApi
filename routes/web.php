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
    return view('backtemplate');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/category','CategoryController');

Route::resource('/type','TypeController');
Route::resource('/meal','MealController');
Route::resource('/recipe','RecipeController');
Route::resource('/ingredient','IngredientController');
Route::get('/get_unit','MeasurementController@get_unit')->name('get_unit');
Route::post('/set_unit','MeasurementController@set_unit')->name('set_unit');
Route::delete('/delete_unit/{id}','MeasurementController@delete_unit')->name('delete_unit');
Route::get('/get_qty','MeasurementController@get_qty')->name('get_qty');
Route::post('/set_qty','MeasurementController@set_qty')->name('set_qty');
Route::delete('/delete_qty/{id}','MeasurementController@delete_qty')->name('delete_qty');
