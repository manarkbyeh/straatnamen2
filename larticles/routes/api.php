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

// List articles
Route::get('/mens', 'MensController@index')->name("path");
Route::get('persoon', 'ArticleController@index');
Route::get('uniek/{gemeente?}', 'ArticleController@uniek');

Route::get('persoon/{extent}', 'ArticleController@persoonGemeente');
Route::get('straat/{extent}', 'ArticleController@getExtentions');
Route::get('gemeentenaam/{extent}', 'ArticleController@getAllextentions');
Route::get('voorvoegsels', 'ArticleController@getvoorvoegsels');
Route::get('koningfamilie', 'ArticleController@getkoningfamilie');

Route::get('achtervoegsels', 'ArticleController@getachtervoegsels');
Route::get('getachtervoegselsgemeente/{extent?}', 'ArticleController@getachtervoegselsgemeente');
Route::get('voorvoegselsgemeente/{extent}', 'ArticleController@getvoorvoegselsgemeente');




