<?php

namespace App\Http\Controllers\Operasional\Dokumen;

use Illuminate\Http\Request;
use App\Http\Requests\UploadOperasionalRequest as Validation;
use App\Http\Controllers\Operasional\BaseOperasionalController;
use App\Models\Operasional\Dokumen\PembatalanDokKh as Operasional;
use App\Http\Controllers\Operasional\UploadPembatalanController as Upload;

ini_set('max_execution_time', '500');

class PembatalanDokKhController extends BaseOperasionalController
{
    /**
     * menyimpan instance dari repository yang dipakai
     *
     * @var App\Repositories\Operasional\DokumenRepository
     */
    private $repository;

    /**
     * Set properties untuk class ini
     *
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->repository = (new DokumenController($request))->getRepository();
    }

    /**
     * Untuk Halaman Detail Laporan 
     *
     * @param Illuminate\Http\Request $request
     * @return to view
     */
    public function tableDetailPembatalanView(Request $request)
    {
        return view('intern.operasional.kh.data.dokumen.pembatalan_dokumen');
    }

    /**
     * Untuk Halaman Rekapitulasi Laporan 
     *
     * @param Illuminate\Http\Request $request
     * @return to view
     */
    public function rekapitulasiTableDetail(Request $request)
    {
        // return view('intern.operasional.kh.data.rekapitulasi.dokel_rekapitulasi');
    }
    
    /**
     * Untuk Halaman Upload Laporan 
     *
     * @return to view
     */
    public function uploadPageView()
    {
        return view('intern.operasional.kh.upload.pembatalan_dokumen');
    }

    /**
     *Import valid data ke database 
     *
     * @param App\Http\Requests\UploadOperasionalRequest $request
     * @return void
     */
    public function imports(Validation $request) 
    {
        /*Filter Data Sebelum Insert Database*/
        if (! $this->setDataProperty($request, new Operasional)->checkingData() ) return back();

        /*Delegate Upload Process to Upload Class*/
        (new Upload( new Operasional, $request ))->uploadData();

        return back();
    }

    /**
     * API data pembatalan dokumen 
     *
     * @param int $year
     * @param int $month
     * @param int $wilker_id
     * @return datatables JSON
     */
    public function api($year = null, $month =  null, $wilker_id = null)
    {
        return datatables($this->repository->pembatalanTableKh())
            ->addIndexColumn()->addColumn('action', function ($data){
                return '
                <a href="#" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Edit
                </a>';
            })->make(true);
    }
}