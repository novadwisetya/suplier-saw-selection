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
    Route::get('{id}/edit', array('as' => 'admin-edit-mengelola-supplier', 'uses' =>'MengelolaSupplierController@edit'));
    Route::get('{id}/ajax-get-data-supplier', array('as' => 'ajax-get-data-supplier', 'uses' =>'MengelolaSupplierController@ajaxGetData'));
    Route::post('{id}/update', array('as' => 'admin-update-mengelola-supplier', 'uses' =>'MengelolaSupplierController@update'));
    Route::post('store', array('as' => 'admin-store-tambah-supplier', 'uses' => 'MengelolaSupplierController@store'));  
    Route::get('{id}/destroy', array('as' => 'admin-destroy-mengelola-supplier', 'uses' =>'MengelolaSupplierController@destroy'));
});

Route::group(['prefix' => 'admin/mengelola-barang', 'namespace' => 'Admin'], function () {
    Route::get('index', array('as' => 'admin-index-mengelola-barang', 'uses' => 'MengelolaBarangController@index'));
    Route::get('create', array('as' => 'admin-create-mengelola-barang', 'uses' =>'MengelolaBarangController@create'));
    Route::get('{id}/edit', array('as' => 'admin-edit-mengelola-barang', 'uses' =>'MengelolaBarangController@edit'));
    Route::get('{id}/ajax-get-data-barang', array('as' => 'ajax-get-data-barang', 'uses' =>'MengelolaBarangController@ajaxGetData'));
    Route::post('{id}/update', array('as' => 'admin-update-mengelola-barang', 'uses' =>'MengelolaBarangController@update'));
    Route::post('store', array('as' => 'admin-store-tambah-barang', 'uses' => 'MengelolaBarangController@store'));  
    Route::get('{id}/destroy', array('as' => 'admin-destroy-mengelola-barang', 'uses' =>'MengelolaBarangController@destroy'));
});

Route::group(['prefix' => 'admin/kriteria-penilaian', 'namespace' => 'Admin'], function () {
    Route::get('index', array('as' => 'admin-index-kriteria-penilaian', 'uses' => 'KriteriaPenilaianController@index'));
    Route::get('create', array('as' => 'admin-create-kriteria-penilaian', 'uses' =>'KriteriaPenilaianController@create'));
    Route::get('{id}/ajax-get-data-barang', array('as' => 'ajax-get-data-kriteria-penilaian', 'uses' =>'KriteriaPenilaianController@ajaxGetData'));
    Route::post('{id}/update', array('as' => 'admin-update-kriteria-penilaian', 'uses' =>'KriteriaPenilaianController@update'));
    Route::post('store', array('as' => 'admin-store-tambah-kriteria', 'uses' => 'KriteriaPenilaianController@store'));  
    Route::get('{id}/destroy', array('as' => 'admin-destroy-kriteria-penilaian', 'uses' =>'KriteriaPenilaianController@destroy'));
    Route::get('{id}/ajax-get-data-kriteria', array('as' => 'ajax-get-data-kriteria', 'uses' =>'KriteriaPenilaianController@ajaxGetKriteria'));

    //sub kriteria
    Route::get('{id}/detail', array('as' => 'admin-detail-kriteria-penilaian', 'uses' =>'KriteriaPenilaianController@detail'));
    Route::post('store-sub-kriteria', array('as' => 'admin-store-sub-kriteria', 'uses' => 'KriteriaPenilaianController@store_sub_kriteria')); 
    Route::get('{id}/{parent_id}/destroy-sub-kriteria', array('as' => 'admin-destroy-kriteria-penilaian', 'uses' =>'KriteriaPenilaianController@destroy_sub_kriteria'));
    Route::post('{id}/{parent_id}/update-sub-kriteria', array('as' => 'admin-update-sub-kriteria-penilaian', 'uses' =>'KriteriaPenilaianController@updateSubKriteria'));
    Route::get('{id}/ajax-get-data-sub-kriteria', array('as' => 'ajax-get-data-sub-kriteria', 'uses' =>'KriteriaPenilaianController@ajaxGetSubKriteria'));
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'datatables'], function () {
        Route::get('mengelola-supplier',array('as' => 'datatables-list-supplier', 'uses' => 'MengelolaSupplierController@datatables' ));
        Route::get('mengelola-barang',array('as' => 'datatables-list-barang', 'uses' => 'MengelolaBarangController@datatables' ));
        Route::get('kriteria-penilaian',array('as' => 'datatables-list-kriteria-penilaian', 'uses' => 'KriteriaPenilaianController@datatables' ));
        Route::get('{id}/sub-kriteria-penilaian',array('as' => 'datatables-list-sub-kriteria-penilaian', 'uses' => 'KriteriaPenilaianController@detailDatatables' ));
        Route::get('ubah-supplier',array('as' => 'datatables-edit-supplier', 'uses' => 'MengelolaSupplierController@datatables_edit' ));
    });
});
