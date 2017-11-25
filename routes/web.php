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

  Route::get('order',
    [
      'as'=>'order.index',
      'uses'=>'OrderController@index','middleware' => ['permission:quotation-list|order-create|order-edit|order-delete']
    ]);

  Route::get('order/{id}/create/',
    [
      'as'=>'order.create',
      'uses'=>'OrderController@create','middleware' => ['permission:order-create']
    ]);


  Route::post('order/store',
    [
      'as'=>'order.store',
      'uses'=>'OrderController@store','middleware' => ['permission:order-create']
    ]);

  Route::get('order/{id}',
    [
      'as'=>'order.show',
      'uses'=>'OrderController@show'
    ]);

  Route::get('order/{id}/edit',
    [
      'as'=>'order.edit',
      'uses'=>'OrderController@edit','middleware' => ['permission:order-edit']
    ]);

  Route::get('order/{id}/godown',
    [
      'as'=>'order.godown',
      'uses'=>'OrderController@godown','middleware' => ['permission:challan-edit']
    ]);

  Route::patch('order/{id}',
    [
      'as'=>'order.update',
      'uses'=>'OrderController@update','middleware' => ['permission:order-edit']
    ]);

  Route::delete('order/{id}',
    [
      'as'=>'order.destroy',
      'uses'=>'OrderController@destroy','middleware' => ['permission:order-delete']
    ]);

    Route::get('challan',
    [
      'as'=>'challan.index',
      'uses'=>'ChallanController@index','middleware' => ['permission:challan-list|challan-create|challan-edit|challan-delete']
    ]);

  Route::get('challan/{id}/create',
    [
      'as'=>'challan.create',
      'uses'=>'ChallanController@create','middleware' => ['permission:challan-create']
    ]);

  Route::post('challan/store',
    [
      'as'=>'challan.store',
      'uses'=>'ChallanController@store','middleware' => ['permission:challan-create']
    ]);

  Route::get('challan/{id}',
    [
      'as'=>'challan.show',
      'uses'=>'ChallanController@show'
    ]);

  Route::get('challan/{id}/edit',
    [
      'as'=>'challan.edit',
      'uses'=>'ChallanController@edit','middleware' => ['permission:challan-edit']
    ]);

  Route::patch('challan/{id}',
    [
      'as'=>'challan.update',
      'uses'=>'ChallanController@update','middleware' => ['permission:challan-edit']
    ]);

  Route::delete('challan/{id}',
    [
      'as'=>'challan.destroy',
      'uses'=>'ChallanController@destroy','middleware' => ['permission:challan-delete']
    ]);



});
