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
    return redirect('/publicForms');
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    
    Route::resource('forms', '\App\Http\Controllers\Admin\FormsController');
});
Route::get('/publicForms', '\App\Http\Controllers\PublicFormsController@index');
Route::get('/showForm/{id}', '\App\Http\Controllers\PublicFormsController@showForm');

/*use App\Http\Controllers\FormsController;
Route::resource('/forms', 'FormsController');*/
/*Route::resource('photos', FormsController::class);*/
