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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('qbo/oauth','QuickBookController@qboOauth');
Route::get('qbo/success','QuickBookController@qboSuccess');
Route::get('qbo/disconnect','QuickBookController@qboDisconnect');

Route::get('autocomplete',
  [
    'as'=>'autocomplete',
    'uses'=>'AutoCompleteController@index'
  ]);

Route::get('search_customer',
  [
    'as'=>'search_customer',
    'uses'=>'AutoCompleteController@searchCustomer'
  ]);

Route::get('search_item',
  [
    'as'=>'search_item',
    'uses'=>'AutoCompleteController@searchItem'
  ]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::auth();


Route::group(['middleware' => ['auth']], function() {

  Route::get('/home', 'HomeController@index');

  Route::resource('users','UserController');

  Route::get('roles',
    [
      'as'=>'roles.index',
      'uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']
    ]);

  Route::get('roles/create',
    [
      'as'=>'roles.create',
      'uses'=>'RoleController@create','middleware' => ['permission:role-create']
    ]);

  Route::post('roles/create',
    [
      'as'=>'roles.store',
      'uses'=>'RoleController@store','middleware' => ['permission:role-create']
    ]);

  Route::get('roles/{id}',
    [
      'as'=>'roles.show',
      'uses'=>'RoleController@show'
    ]);

  Route::get('roles/{id}/edit',
    [
      'as'=>'roles.edit',
      'uses'=>'RoleController@edit','middleware' => ['permission:role-edit']
    ]);

  Route::patch('roles/{id}',
    [
      'as'=>'roles.update',
      'uses'=>'RoleController@update','middleware' => ['permission:role-edit']
    ]);

  Route::delete('roles/{id}',
    [
      'as'=>'roles.destroy',
      'uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']
    ]);


  Route::get('itemCRUD2',
      [
        'as'=>'itemCRUD2.index',
        'uses'=>'ItemCRUD2Controller@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']
      ]);

  Route::get('itemCRUD2/create',
      [
        'as'=>'itemCRUD2.create',
        'uses'=>'ItemCRUD2Controller@create','middleware' => ['permission:item-create']
      ]);

  Route::post('itemCRUD2/create',
      [
        'as'=>'itemCRUD2.store',
        'uses'=>'ItemCRUD2Controller@store','middleware' => ['permission:item-create']
      ]);

  Route::get('itemCRUD2/{id}',
    [
      'as'=>'itemCRUD2.show',
      'uses'=>'ItemCRUD2Controller@show'
    ]);

  Route::get('itemCRUD2/{id}/edit',
    [
      'as'=>'itemCRUD2.edit',
      'uses'=>'ItemCRUD2Controller@edit','middleware' => ['permission:item-edit']
    ]);

  Route::patch('itemCRUD2/{id}',
    [
      'as'=>'itemCRUD2.update',
      'uses'=>'ItemCRUD2Controller@update','middleware' => ['permission:item-edit']
    ]);

  Route::delete('itemCRUD2/{id}',
    [
      'as'=>'itemCRUD2.destroy',
      'uses'=>'ItemCRUD2Controller@destroy','middleware' => ['permission:item-delete']
    ]);

  //

  Route::get('customer',
    [
      'as'=>'customer.index',
      'uses'=>'CustomerController@index','middleware' => ['permission:customer-list|customer-create|customer-edit|customer-delete']
    ]);

  Route::get('customer/create',
    [
      'as'=>'customer.create',
      'uses'=>'CustomerController@create','middleware' => ['permission:customer-create']
    ]);

  Route::post('customer/store',
    [
      'as'=>'customer.store',
      'uses'=>'CustomerController@store','middleware' => ['permission:customer-create']
    ]);

  Route::get('customer/{id}',
    [
      'as'=>'customer.show',
      'uses'=>'CustomerController@show'
    ]);

  Route::get('customer/{id}/edit',
    [
      'as'=>'customer.edit',
      'uses'=>'CustomerController@edit','middleware' => ['permission:customer-edit']
    ]);

  Route::patch('customer/{id}',
    [
      'as'=>'customer.update',
      'uses'=>'CustomerController@update','middleware' => ['permission:customer-edit']
    ]);

  Route::delete('customer/{id}',
    [
      'as'=>'customer.destroy',
      'uses'=>'CustomerController@destroy','middleware' => ['permission:customer-delete']
    ]);

  Route::get('quotation',
    [
      'as'=>'quotation.index',
      'uses'=>'QuotationController@index','middleware' => ['permission:quotation-list|quotation-create|quotation-edit|quotation-delete']
    ]);

  Route::get('quotation/create',
    [
      'as'=>'quotation.create',
      'uses'=>'QuotationController@create','middleware' => ['permission:quotation-create']
    ]);

  Route::post('quotation/store',
    [
      'as'=>'quotation.store',
      'uses'=>'QuotationController@store','middleware' => ['permission:quotation-create']
    ]);

  Route::get('quotation/{id}',
    [
      'as'=>'quotation.show',
      'uses'=>'QuotationController@show'
    ]);

  Route::get('quotation/{id}/edit',
    [
      'as'=>'quotation.edit',
      'uses'=>'QuotationController@edit','middleware' => ['permission:quotation-edit']
    ]);

  Route::patch('quotation/{id}',
    [
      'as'=>'quotation.update',
      'uses'=>'QuotationController@update','middleware' => ['permission:quotation-edit']
    ]);

  Route::delete('quotation/{id}',
    [
      'as'=>'quotation.destroy',
      'uses'=>'QuotationController@destroy','middleware' => ['permission:quotation-delete']
    ]);

});
