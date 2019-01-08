<?php

/*KT Prefix*/

Route::get(
	'ktoperasional', 'HomeKtController@showMenu'
)->name('showmenu.operasional.kt');

/*Menu Data Operasional KT*/
Route::get(
	'ktoperasional/menu_operasional', 'HomeKtController@showMenuDataOperasional'
)->name('showmenu.data.operasional.kt');

/*Rekapitulasi Page*/
Route::get(
	'ktoperasional/menu_operasional/rekapitulasi/{year?}/{month?}/{wilker_id?}', 'HomeKtController@homeRekapitulasi'
)->name('show.rekapitulasi.operasional.kt');

/*Statistik Page*/
Route::get(
	'ktoperasional/menu_operasional/statistik/{year?}/{month?}/{wilker_id?}', 'HomeKtController@homeStatistik'
)->name('show.statistik.operasional.kt');

/*View Page Rekapitulasi Detail*/
Route::get(
	'rekapitulasi/dokel/{year?}/{month?}/{wilker_id?}', 'DokelKtController@rekapitulasiTableDetail'
)->name('kt.view.rekapitulasi.dokel');

Route::get(
	'rekapitulasi/domas/{year?}/{month?}/{wilker_id?}', 'DomasKtController@rekapitulasiTableDetail'
)->name('kt.view.rekapitulasi.domas');

Route::get(
	'rekapitulasi/ekspor/{year?}/{month?}/{wilker_id?}', 'EksporKtController@rekapitulasiTableDetail'
)->name('kt.view.rekapitulasi.ekspor');

Route::get(
	'rekapitulasi/impor/{year?}/{month?}/{wilker_id?}', 'ImporKtController@rekapitulasiTableDetail'
)->name('kt.view.rekapitulasi.impor');

/*View Page Table Detail Frekuensi*/
Route::get(
	'statistik/detail/frekuensi/dokel/{year?}/{month?}/{wilker_id?}', 'DokelKtController@tableDetailFrekuensiView'
)->name('kt.view.page.detail.frekuensi.dokel');

Route::get(
	'statistik/detail/frekuensi/domas/{year?}/{month?}/{wilker_id?}', 'DomasKtController@tableDetailFrekuensiView'
)->name('kt.view.page.detail.frekuensi.domas');

Route::get(
	'statistik/detail/frekuensi/ekspor/{year?}/{month?}/{wilker_id?}', 'EksporKtController@tableDetailFrekuensiView'
)->name('kt.view.page.detail.frekuensi.ekspor');

Route::get(
	'statistik/detail/frekuensi/impor/{year?}/{month?}/{wilker_id?}', 'ImporKtController@tableDetailFrekuensiView'
)->name('kt.view.page.detail.frekuensi.impor');

Route::get(
	'statistik/detail/frekuensi/reekspor/{year?}/{month?}/{wilker_id?}', 'ReeksporKtController@tableDetailFrekuensiView'
)->name('kt.view.page.detail.frekuensi.reekspor');

Route::get(
	'statistik/detail/frekuensi/serah_terima/{year?}/{month?}/{wilker_id?}', 'SerahTerimaKtController@tableDetailFrekuensiView'
)->name('kt.view.page.detail.frekuensi.serah_terima');

/*View Page Table Detail Pembatalan Dokumen*/
Route::get(
	'statistik/detail/dokumen/pembatalan_dokumen/{year?}/{month?}/{wilker_id?}', 'PembatalanDokKtController@tableDetailPembatalanView'
)->name('kt.view.page.detail.dokumen.pembatalan_dokumen');

Route::middleware('kt')->group(function(){

	/*Home Upload View (Domas, Dokel, DLL)*/
	Route::get('home_upload/{tahun?}', 'HomeKtController@homeUpload')
	->name('kt.homeupload');

	/*Home Download View (Domas, Dokel, DLL)*/
	Route::get('home_download', 'HomeKtController@homeDownload')
	->name('kt.homedownload');

	/*Rollback Laporan*/
	Route::delete('home/rollback/{id}', 'HomeKtController@destroy')
	->name('rollback.operasional.kt');

	/*
	*-------------------------------------
	* KT Upload Routes
	* ------------------------------------
	*/

	Route::get('upload/domas', 'DomasKtController@uploadPageView')
	->name('kt.upload.page.domas');

	Route::get('upload/dokel', 'DokelKtController@uploadPageView')
	->name('kt.upload.page.dokel'); 

	Route::get('upload/ekspor', 'EksporKtController@uploadPageView')
	->name('kt.upload.page.ekspor');

	Route::get('upload/impor', 'ImporKtController@uploadPageView')
	->name('kt.upload.page.impor'); 

	Route::get('upload/pembatalan_dokumen', 'PembatalanDokKtController@uploadPageView')
	->name('kt.upload.page.pembatalan_dokumen');

	Route::get('upload/reekspor', 'ReeksporKtController@uploadPageView')
	->name('kt.upload.page.reekspor');

	Route::get('upload/serah_terima', 'SerahTerimaKtController@uploadPageView')
	->name('kt.upload.page.serah_terima');

	/*
	*-------------------------------------
	* KT Proses Upload
	* ------------------------------------
	*/

	Route::post('dokel/importdata', 'DokelKtController@imports')
	->name('kt.upload.proses.dokel');

	Route::post('domas/importdata', 'DomasKtController@imports')
	->name('kt.upload.proses.domas');

	Route::post('ekspor/importdata', 'EksporKtController@imports')
	->name('kt.upload.proses.ekspor');

	Route::post('impor/importdata', 'ImporKtController@imports')
	->name('kt.upload.proses.impor');

	Route::post('pembatalan_dokumen/importdata', 'PembatalanDokKtController@imports')
	->name('kt.upload.proses.pembatalan_dokumen');

	Route::post('reekspor/importdata', 'ReeksporKtController@imports')
	->name('kt.upload.proses.reekspor');

	Route::post('serah_terima/importdata', 'SerahTerimaKtController@imports')
	->name('kt.upload.proses.serah_terima');

	/*
	*-------------------------------------
	* KT Proses Download
	* ------------------------------------
	*/

	Route::namespace('Download')->group(function () {

	    Route::post('donwload/operasional', 'LaporanOperasionalKtController@laporanOperasionalKt')
		->name('kt.download.operasional');

	});/*End Download Namespace*/

});/*End Middleware KT*/






