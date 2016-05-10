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

Route::get('/', function () {
  return View::make('hello');
});


Route::group(array('prefix' => '/cms'), function () {
  Route::get('/list', array('uses' => 'CmsController@index', 'as' => 'list'));
  Route::get('/search', array('uses' => 'CmsController@index', 'as' => 'search'));
  Route::get('/new', array('uses' => 'CmsController@refresh', 'as' => 'refresh'));
});

Route::group(array('prefix' => '/refresh'), function () {
  Route::get('/refresh', array('uses' => 'RefreshController@refresh', 'as' => 'refresh'));
});

Route::group(array('prefix' => '/excel'), function () {
  Route::get('/export', array('uses' => 'ExcelController@excelExport', 'as' => 'export'));
});

// Clients
/*Route::group(array('prefix' => '/clients'), function() {
	Route::get('/', array('as' => 'clients-home', 'uses' => 'ClientsController@index'));
	Route::get('/client-create/', array('as' => 'createClient', 'uses' => 'ClientsController@createClient'));
	Route::get('/user-clients/{id}', array('as' => 'getClients', 'uses' => 'ClientsController@getClients'));
	Route::get('/client-edit/{id}', array('as' => 'editClient', 'uses' => 'ClientsController@editClient'));
	Route::get('/client-delete/clientId/{id}/company_id/{company_id}', array('as' => 'deleteClient', 'uses' => 'ClientsController@deleteClient'));
	Route::post('/client-post/', array('as' => 'postEditClient', 'uses' => 'ClientsController@postEditClient'));
	Route::post('/client-postCreate/', array('as' => 'postCreateClient', 'uses' => 'ClientsController@postCreateClient'));
});*/

/*
Route::group(array('before' => 'guest'), function () {

  // Route::model('user', 'User');
  Route::get('/user/login', array('as' => 'login', 'uses' => 'UsersController@getLogin'));
  Route::get('/user/create', array('as' => 'create', 'uses' => 'UsersController@getCreate'));


  Route::group(array('before' => 'csrf'), function () {
    Route::post('/user/create', array('as' => 'postCreate', 'uses' => 'UsersController@postCreate'));
    Route::post('/user/login', array('as' => 'postLogin', 'uses' => 'UsersController@postLogin'));

  });

});


Route::group(array('before' => 'auth'), function() {
  Route::get('/user/logout', array('uses' => 'UsersController@getLogout', 'as' => 'getLogout'));
  Route::get('/dash', array('as' => 'dash', 'uses' => 'DashController@index'));

});

// Clients
Route::group(array('prefix' => '/clients'), function() {
  Route::get('/', array('as' => 'clients-home', 'uses' => 'ClientsController@index'));
  Route::get('/client-create/', array('as' => 'createClient', 'uses' => 'ClientsController@createClient'));
  Route::get('/user-clients/{id}', array('as' => 'getClients', 'uses' => 'ClientsController@getClients'));
  Route::get('/client-edit/{id}', array('as' => 'editClient', 'uses' => 'ClientsController@editClient'));
  Route::get('/client-delete/clientId/{id}/company_id/{company_id}', array('as' => 'deleteClient', 'uses' => 'ClientsController@deleteClient'));
  Route::post('/client-post/', array('as' => 'postEditClient', 'uses' => 'ClientsController@postEditClient'));
  Route::post('/client-postCreate/', array('as' => 'postCreateClient', 'uses' => 'ClientsController@postCreateClient'));
});

// OS
Route::group(array('prefix' => '/os'), function() {
  Route::get('/', array('as' => 'os-home', 'uses' => 'OsController@index'));
  Route::get('/create/', array('as' => 'createOs', 'uses' => 'OsController@createOs'));
  Route::get('/list/', array('as' => 'getClientOses', 'uses' => 'OsController@getOses'));
  Route::get('/edit/{id}', array('as' => 'editOs', 'uses' => 'OsController@editOs'));
  Route::get('/delete/osId/{id}', array('as' => 'deleteOs', 'uses' => 'OsController@deleteOs'));
  Route::post('/postEdit/', array('as' => 'postEditOs', 'uses' => 'OsController@postEditOs'));
  Route::post('/postCreate/', array('as' => 'postCreateOs', 'uses' => 'OsController@postCreateOs'));
});

// Dashboard
Route::group(array('prefix' => '/dash'), function() {
  Route::get('/clients', array('as' => 'dashClient', 'uses' => 'DashController@index'));
});


// Servers
Route::group(array('prefix' => '/server'), function() {
  Route::get('/', array('as' => 'server-home', 'uses' => 'ServersController@index'));
  Route::get('/list/', array('as' => 'getClientServers', 'uses' => 'ServersController@getServers'));
  Route::get('/create/', array('as' => 'createServer', 'uses' => 'ServersController@createServer'));
  Route::get('/edit/{id}', array('as' => 'editServer', 'uses' => 'ServersController@editServer'));
  Route::get('/delete/serverId/{id}/company_id/{company_id}', array('as' => 'deleteServer', 'uses' => 'ServersController@deleteServer'));
  Route::post('/post/', array('as' => 'postEditServer', 'uses' => 'ServersController@postEditServer'));
  Route::post('/postCreate/', array('as' => 'postCreateServer', 'uses' => 'ServersController@postCreateServer'));
});

// Computers
Route::group(array('prefix' => '/computers'), function() {
  Route::get('/', array('as' => 'computers-home', 'uses' => 'ComputersController@index'));
  Route::get('/list/', array('as' => 'getClientComputers', 'uses' => 'ComputersController@getComputers'));
  Route::get('/create/', array('as' => 'createComputer', 'uses' => 'ComputersController@createComputer'));
  Route::get('/edit/{id}', array('as' => 'editComputer', 'uses' => 'ComputersController@editComputers'));
  Route::get('/delete/computerId/{id}/company_id/{company_id}', array('as' => 'deleteComputer', 'uses' => 'ComputersController@deleteComputer'));
  Route::post('/post/', array('as' => 'postEditComputer', 'uses' => 'ComputersController@postEditComputer'));
  Route::post('/postCreate/', array('as' => 'postCreateComputer', 'uses' => 'ComputersController@postCreateComputer'));
});

Route::group(array('prefix' => '/db'), function() {
  Route::get('/db-hw', array('as' => 'dbHw', 'uses' => 'DashController@getHw'));
});

 */