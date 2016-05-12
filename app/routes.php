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

Route::get('/', array('uses' => 'HomeController@index', 'as' => 'home'));


Route::group(array('prefix' => '/cms'), function () {
  Route::get('/list', array('uses' => 'CmsController@index', 'as' => 'list'));
  Route::get('/search', array('uses' => 'CmsController@index', 'as' => 'search'));
  Route::get('/new', array('uses' => 'CmsController@refresh', 'as' => 'refresh'));
  Route::post('/single-search', array('uses' => 'CmsController@search', 'as' => 'typeahead-search'));
  Route::get('/single-display/{id}', array('uses' => 'CmsController@single', 'as' => 'display'));
  Route::get('/display/', array('uses' => 'CmsController@single', 'as' => 'singleDisplay'));
});

Route::group(array('prefix' => '/refresh'), function () {
  Route::get('/refresh', array('uses' => 'RefreshController@refresh', 'as' => 'refresh'));
});

Route::group(array('prefix' => '/excel'), function () {
  Route::get('/export', array('uses' => 'ExcelController@excelExport', 'as' => 'export'));
});