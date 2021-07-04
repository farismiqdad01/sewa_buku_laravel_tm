<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'IndexController@index');

Route::get('home', function () {
    return view('home');
});

Route::get('data_peminjam', function(){
    return view('peminjams/data_peminjam');
});

Route::get('lihat_data_peminjam', 'PeminjamController@lihat_data_peminjam');

Route::get('/peminjam', 'PeminjamController@index');

Route::get('peminjam/create', 'PeminjamController@create')->name('peminjam.create');

Route::post('peminjam', 'PeminjamController@store')->name('peminjam.store');

Route::get('peminjam/edit/{id}', 'PeminjamController@edit')->name('peminjam.edit');

Route::post('peminjam/update/{id}', 'PeminjamController@update')->name('peminjam.update');

Route::post('peminjam/delete/{id}', 'PeminjamController@destroy')->name('peminjam.destroy');

Route::get('coba_collection', 'PeminjamController@cobaCollection');

Route::get('collection_first', 'PeminjamController@collection_first');

Route::get('collection_last', 'PeminjamController@collection_last');

Route::get('collection_count', 'PeminjamController@collection_count');

Route::get('collection_take', 'PeminjamController@collection_take');

Route::get('collection_pluck', 'PeminjamController@collection_pluck');

Route::get('collection_where', 'PeminjamController@collection_where');

Route::get('collection_wherein', 'PeminjamController@collection_wherein');

Route::get('collection_toarray', 'PeminjamController@collection_toarray');

Route::get('collection_tojson', 'PeminjamController@collection_tojson');

