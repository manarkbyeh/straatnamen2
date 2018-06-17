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




Route::get('/straat',  'HomepageController@index')->name('straat');
Route::get('/gemeenten/{gemeente?}',  'GemeenteController@index')->name('gemeentensug');

Route::get('/street/{street?}',  'StreetnameController@index')->name('street');
Route::get('/street/search/{street}',  'StreetnameController@Search')->name('Search');
Route::get('/personen',  'PersonController@index')->name('personen');
Route::get('/antwerpen',  'AntwerpenController@index')->name('antwerpen');
Route::get('/detailpage/{gemeente}/{straat}',  'StreetnameController@detail')->name('detail');

Route::get('/',  'OverzichtController@index')->name('home'); 
Route::get('/gemeente',  'HomepageController@gemeente')->name('gemeente');
Route::get('/{gemeenten}',  'HomepageController@gemeentesuggestions');
Route::get('/gemeentesuggestions/{gemeenten}',  'HomepageController@gemeentesuggestions');
Route::get('/gemeente/{gemeente?}',  'GemeenteController@index')->name('gemeenteN');

Route::get('/{street}',  'HomepageController@suggestions');

Route::get('/suggestions/{suggest}',  'StreetnameController@suggestions');
//api
Route::get('/excel',  'ExcelController@index');

Route::get('/mens/{id}/{mens}', 'MensController@update');

Route::get('/extend/{mens}', 'ExtentstraatnaamController@index');//suggestions





