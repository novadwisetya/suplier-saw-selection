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

/* ================== Homepage + Admin Routes ================== */

require __DIR__.'/admin_routes.php';
Route::group(['prefix' => 'admin/mengelola-supplier', 'namespace' => 'Admin'], function () {
	Route::get('index', array('as' => 'admin-index-mengelola-supplier', 'uses' => 'MengelolaSupplierController@index'));
    Route::get('create', array('as' => 'admin-create-mengelola-supplier', 'uses' =>'MengelolaSupplierController@create'));
    Route::get('edit', array('as' => 'admin-edit-mengelola-supplier', 'uses' =>'MengelolaSupplierController@edit'));
    Route::post('store', array('as' => 'admin-store-tambah-supplier', 'uses' => 'MengelolaSupplierController@store'));  
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'datatables'], function () {
        Route::get('mengelola-supplier',array('as' => 'datatables-list-supplier', 'uses' => 'MengelolaSupplierController@datatables' ));
        Route::get('ubah-supplier',array('as' => 'datatables-edit-supplier', 'uses' => 'MengelolaSupplierController@datatables_edit' ));
    });
});
