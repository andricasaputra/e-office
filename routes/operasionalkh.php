<?php

/*KH Prefix*/

Route::get(
	'khoperasional', 'HomeKhController@showMenu'
)->name('showmenu.operasional.kh');

/*Menu Data Operasional KH*/
Route::get(
	'khoperasional/menu_operasional', 'HomeKhController@showMenuDataOperasional'
)->name('showmenu.data.operasional.kh');

/*Rekapitulasi Page*/
Route::get(
	'khoperasional/menu_operasional/rekapitulasi/{year?}/{month?}/{wilker_id?}', 'HomeKhController@homeRekapitulasi'
)->name('show.rekapitulasi.operasional.kh');

/*Statistik Page*/
Route::get(
	'khoperasional/menu_operasional/statistik/{year?}/{month?}/{wilker_id?}', 'HomeKhController@homeStatistik'
)->name('show.statistik.operasional.kh');

/*View Page Rekapitulasi Detail*/
Route::get(
	'rekapitulasi/dokel/{year?}/{month?}/{wilker_id?}', 'DokelKhController@rekapitulasiTableDetail'
)->name('kh.view.rekapitulasi.dokel');

Route::get(
	'rekapitulasi/domas/{year?}/{month?}/{wilker_id?}', 'DomasKhController@rekapitulasiTableDetail'
)->name('kh.view.rekapitulasi.domas');

Route::get(
	'rekapitulasi/ekspor/{year?}/{month?}/{wilker_id?}', 'EksporKhController@rekapitulasiTableDetail'
)->name('kh.view.rekapitulasi.ekspor');

Route::get(
	'rekapitulasi/impor/{year?}/{month?}/{wilker_id?}', 'ImporKhController@rekapitulasiTableDetail'
)->name('kh.view.rekapitulasi.impor');

/*View Page Table Detail Frekuensi*/
Route::get(
	'statistik/detail/frekuensi/dokel/{year?}/{month?}/{wilker_id?}', 'DokelKhController@tableDetailFrekuensiView'
)->name('kh.view.page.detail.frekuensi.dokel');

Route::get(
	'statistik/detail/frekuensi/domas/{year?}/{month?}/{wilker_id?}', 'DomasKhController@tableDetailFrekuensiView'
)->name('kh.view.page.detail.frekuensi.domas');

Route::get(
	'statistik/detail/frekuensi/ekspor/{year?}/{month?}/{wilker_id?}', 'EksporKhController@tableDetailFrekuensiView'
)->name('kh.view.page.detail.frekuensi.ekspor');

Route::get(
	'statistik/detail/frekuensi/impor/{year?}/{month?}/{wilker_id?}', 'ImporKhController@tableDetailFrekuensiView'
)->name('kh.view.page.detail.frekuensi.impor');

Route::get(
	'statistik/detail/frekuensi/reekspor/{year?}/{month?}/{wilker_id?}', 'ReeksporKhController@tableDetailFrekuensiView'
)->name('kh.view.page.detail.frekuensi.reekspor');

Route::get(
	'statistik/detail/frekuensi/serah_terima/{year?}/{month?}/{wilker_id?}', 'SerahTerimaKhController@tableDetailFrekuensiView'
)->name('kh.view.page.detail.frekuensi.serah_terima');

/*View Page Table Detail Pembatalan Dokumen*/
Route::get(
	'statistik/detail/dokumen/pembatalan_dokumen/{year?}/{month?}/{wilker_id?}', 'PembatalanDokKhController@tableDetailPembatalanView'
)->name('kh.view.page.detail.dokumen.pembatalan_dokumen');

Route::middleware('kh')->group(function(){

	Route::get('home_upload/{year?}', 'HomeKhController@homeUpload')
	->name('kh.homeupload');

	Route::delete('home/rollback/{id}', 'HomeKhController@destroy')
	->name('rollback.operasional.kh');

	/*KH Upload Routes*/
	Route::get('upload/domas', 'DomasKhController@uploadPageView')
	->name('kh.upload.page.domas');

	Route::get('upload/dokel', 'DokelKhController@uploadPageView')
	->name('kh.upload.page.dokel'); 

	Route::get('upload/ekspor', 'EksporKhController@uploadPageView')
	->name('kh.upload.page.ekspor');

	Route::get('upload/impor', 'ImporKhController@uploadPageView')
	->name('kh.upload.page.impor');

	Route::get('upload/pembatalan_dokumen', 'PembatalanDokKhController@uploadPageView')
	->name('kh.upload.page.pembatalan_dokumen');

	Route::get('upload/reekspor', 'ReeksporKhController@uploadPageView')
	->name('kh.upload.page.reekspor');

	Route::get('upload/serah_terima', 'SerahTerimaKhController@uploadPageView')
	->name('kh.upload.page.serah_terima');

	/*Proses Upload*/
	Route::post('dokel/importdata', 'DokelKhController@imports')
	->name('kh.upload.proses.dokel');

	Route::post('domas/importdata', 'DomasKhController@imports')
	->name('kh.upload.proses.domas');

	Route::post('ekspor/importdata', 'EksporKhController@imports')
	->name('kh.upload.proses.ekspor');

	Route::post('impor/importdata', 'ImporKhController@imports')
	->name('kh.upload.proses.impor');

	Route::post('pembatalan_dokumen/importdata', 'PembatalanDokKhController@imports')
	->name('kh.upload.proses.pembatalan_dokumen');

	Route::post('reekspor/importdata', 'ReeksporKhController@imports')
	->name('kh.upload.proses.reekspor');

	Route::post('serah_terima/importdata', 'SerahTerimaKhController@imports')
	->name('kh.upload.proses.serah_terima');

});/*End Middleware KH*/




