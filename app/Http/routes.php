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
    Route::get('import', array('as' => 'admin-import-mengelola-supplier', 'uses' =>'MengelolaSupplierController@import'));
    Route::post('import', array('as' => 'admin-import-tambah-supplier', 'uses' => 'MengelolaSupplierController@storeImport'));
    Route::get('{id}/penilaian', array('as' => 'admin-penilaian-mengelola-supplier', 'uses' =>'MengelolaSupplierController@penilaian'));
    Route::get('supplier-print-pdf', array('as' => 'supplier-print-pdf', 'uses' =>'MengelolaSupplierController@cetakData'));
});

Route::group(['prefix' => 'admin/mengelola-barang', 'namespace' => 'Admin'], function () {
    Route::get('index', array('as' => 'admin-index-mengelola-barang', 'uses' => 'MengelolaBarangController@index'));
    Route::get('create', array('as' => 'admin-create-mengelola-barang', 'uses' =>'MengelolaBarangController@create'));
    Route::get('{id}/edit', array('as' => 'admin-edit-mengelola-barang', 'uses' =>'MengelolaBarangController@edit'));
    Route::get('{id}/ajax-get-data-barang-show', array('as' => 'ajax-get-data-barang-show', 'uses' =>'MengelolaBarangController@ajaxGetData'));
    Route::post('{id}/update', array('as' => 'admin-update-mengelola-barang', 'uses' =>'MengelolaBarangController@update'));
    Route::post('store', array('as' => 'admin-store-tambah-barang', 'uses' => 'MengelolaBarangController@store'));  
    Route::get('{id}/destroy', array('as' => 'admin-destroy-mengelola-barang', 'uses' =>'MengelolaBarangController@destroy'));
    Route::get('import', array('as' => 'admin-import-mengelola-barang', 'uses' =>'MengelolaSupplierController@import'));
    Route::get('product-print-pdf', array('as' => 'product-print-pdf', 'uses' =>'MengelolaBarangController@cetakData'));
    Route::post('import', array('as' => 'admin-import-tambah-barang', 'uses' => 'MengelolaBarangController@storeImport'));

});

Route::group(['prefix' => 'admin/kriteria-penilaian', 'namespace' => 'Admin'], function () {
    Route::get('index', array('as' => 'admin-index-kriteria-penilaian', 'uses' => 'KriteriaPenilaianController@index'));
    Route::get('create', array('as' => 'admin-create-kriteria-penilaian', 'uses' =>'KriteriaPenilaianController@create'));
    Route::get('{id}/ajax-get-data-kriteria-penilaian', array('as' => 'ajax-get-data-kriteria-penilaian', 'uses' =>'KriteriaPenilaianController@ajaxGetData'));
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

Route::group(['prefix' => 'admin/mengelola-penilaian-supplier', 'namespace' => 'Admin'], function () {
    Route::get('index', array('as' => 'admin-index-mengelola-penilaian-supplier', 'uses' => 'MengelolaPenilaianSupplierController@index'));
    Route::get('{supplier_id}/ajax-get-data-barang', array('as' => 'ajax-get-data-barang', 'uses' => 'MengelolaPenilaianSupplierController@ajaxGetDataBarang'));
    Route::post('store', array('as' => 'admin-store-penilaian-supplier', 'uses' => 'MengelolaPenilaianSupplierController@store'));  
});

Route::group(['prefix' => 'admin/laporan-perangkingan', 'namespace' => 'Admin'], function () {
    Route::get('index', array('as' => 'admin-index-laporan-perangkingan', 'uses' => 'LaporanPerangkinganController@index'));
    Route::get('penilaian', array('as' => 'admin-index-laporan-penilaian', 'uses' => 'LaporanPerangkinganController@penilaian'));
    Route::post('cari-laporan-perangkingan', array('as' => 'cari-laporan-perangkingan', 'uses' => 'LaporanPerangkinganController@search'));
     Route::get('laporan-cetak-pdf', array('as' => 'laporan-cetak-pdf', 'uses' =>'LaporanPerangkinganController@cetakData'));
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'datatables'], function () {
        Route::get('mengelola-supplier',array('as' => 'datatables-list-supplier', 'uses' => 'MengelolaSupplierController@datatables' ));
        Route::get('{id}/datatables-matrix-keputusan',array('as' => 'datatables-matrix-keputusan', 'uses' => 'MengelolaSupplierController@dtMatrixKeputusan' ));
        Route::get('{id}/datatables-matrix-keputusan-x',array('as' => 'datatables-matrix-keputusan-x', 'uses' => 'MengelolaSupplierController@dtMatrixKeputusanX' ));
        Route::get('{id}/datatables-matrix-normalisasi-r',array('as' => 'datatables-matrix-normalisasi-r', 'uses' => 'MengelolaSupplierController@dtMatrixNormalisasiR' ));
        Route::get('mengelola-barang',array('as' => 'datatables-list-barang', 'uses' => 'MengelolaBarangController@datatables' ));
        Route::get('kriteria-penilaian',array('as' => 'datatables-list-kriteria-penilaian', 'uses' => 'KriteriaPenilaianController@datatables' ));
        Route::get('{id}/sub-kriteria-penilaian',array('as' => 'datatables-list-sub-kriteria-penilaian', 'uses' => 'KriteriaPenilaianController@detailDatatables' ));
        Route::get('{id}/sub-kriteria-penilaian-cost',array('as' => 'datatables-list-sub-kriteria-penilaian-cost', 'uses' => 'KriteriaPenilaianController@detailCostDatatables' ));
        Route::get('ubah-supplier',array('as' => 'datatables-edit-supplier', 'uses' => 'MengelolaSupplierController@datatables_edit' ));
        Route::get('laporan-perangkingan',array('as' => 'datatables-laporan-perangkingan', 'uses' => 'LaporanPerangkinganController@laporan_perangkingan' ));
    });
});
