<?php

use App\ModelsUdp\Prospect;
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

Auth::routes([
    'register'=>false,
    'reset'=>false,
    'verify'=>false
]);


Route::middleware('auth')->group(function(){
    Route::get('/admin/export/xlsx', 'HomeController@dataExportXLSX');
    Route::get('/admin/export/csv', 'HomeController@dataExportCSV');
    Route::get('/admin-rapport', 'HomeController@dataView');
    Route::get('/admin', 'HomeController@formResult');


});