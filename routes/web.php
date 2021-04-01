<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['namespace' => 'Web','middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/user', 'UserController');
    Route::resource('/product', 'ProductController');
    Route::get('/supplier', 'SupplierController@index')->name('supplier.index');
    Route::get('/pengeluaran', 'PengeluaranController@index')->name('pengeluaran.index');
    Route::get('/category', 'CategoryController@index')->name('category.index');

    Route::get('pembelian', 'PembelianController@index')->name('pembelian.index');
    Route::post('pembelian', 'PembelianController@store')->name('pembelian.store');
    Route::post('pembelian/diskon', 'PembelianController@diskon')->name('pembelian.diskon');
    Route::post('pembelian/confirm', 'PembelianController@confirm')->name('pembelian.confirm');
    Route::get('pembelianform', 'PembelianController@form')->name('pembelian.form');
    Route::post('pembelian/update/{id}', 'PembelianController@update')->name('pembelian.update');
    Route::post('pembelian/delete/{id}', 'PembelianController@destroy')->name('pembelian.destroy');
    Route::get('kembali', 'PembelianController@kembali')->name('pembelian.kembali');
    Route::get('pembelian/show/{id}', 'PembelianController@show')->name('pembelian.show');

    Route::get('kasir', 'PenjualanController@index')->name('penjualan.index');
    Route::post('penjualan/bayar', 'PenjualanController@bayar')->name('penjualan.bayar');
    Route::get('penjualan/cetak_pdf', 'PenjualanController@cetak_pdf')->name('cetak.penjualan');
    Route::post('penjualan/store', 'PenjualanController@store')->name('penjualan.store');
    Route::post('penjualan/diskon', 'PenjualanController@diskon')->name('penjualan.diskon');
    Route::post('penjualan/confirm', 'PenjualanController@confirm')->name('penjualan.confirm');
    Route::post('penjualan/confirm-saldo', 'PenjualanController@confirm_saldo')->name('penjualan.confirm-saldo');
    Route::post('penjualan/update/{id}', 'PenjualanController@update')->name('penjualan.update');
    Route::post('penjualan/delete/{id}', 'PenjualanController@destroy')->name('penjualan.destroy');
    Route::get('penjualan/show/{id}', 'PenjualanController@show')->name('penjualan.show');
    Route::post('penjualan/cetak_pdf', 'PenjualanController@cetak_pdf')->name('penjualan.cetak');

    Route::get('keuangan', 'KeuanganController@index')->name('keuangan.index');
    Route::get('keuangan/cetak_pdf', 'KeuanganController@cetak_pdf')->name('cetak.keuangan');
    Route::get('keuangan/per', 'KeuanganController@per')->name('keuangan.per');

    Route::get('laporan', 'KasirController@index')->name('laporan.index');
    Route::post('laporan/cetak', 'KasirController@cetak')->name('laporan.cetak');
    Route::get('laporan/per', 'KasirController@per')->name('laporan.per');
    Route::get('laporan/{id}', 'KasirController@show')->name('laporan.show');

});
Route::view('users','livewire.home');
