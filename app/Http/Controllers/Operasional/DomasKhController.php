<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Operasional;

use Illuminate\Http\Request;
use App\Contracts\BaseOperasionalInterface;
use App\Models\Operasional\DomasKh as Operasional;
use App\Http\Requests\UploadOperasionalRequest as Validation;
use App\Http\Controllers\Operasional\UploadOperasionalController as Upload;

ini_set('max_execution_time', '500');

class DomasKhController extends BaseOperasionalController implements BaseOperasionalInterface
{
    /**
     * Untuk Halaman Detail Laporan 
     *
     * @param Illuminate\Http\Request $request
     * @return to view
     */
    public function tableDetailFrekuensiView(Request $request)
    {
        return view('intern.operasional.kh.data.statistik.detail.bigtable.domas');
    }

    /**
     * Untuk Halaman Rekapitulasi Laporan 
     *
     * @param Illuminate\Http\Request $request
     * @return to view
     */
    public function rekapitulasiTableDetail(Request $request)
    {
        return view('intern.operasional.kh.data.rekapitulasi.domas_rekapitulasi');
    }
    
    /**
     * Untuk Halaman Upload Laporan 
     *
     * @return to view
     */
    public function uploadPageView(Request $request)
    {
        return view('intern.operasional.kh.upload.domas');
    }

    /**
     * Import valid data ke database 
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
     * API untuk detail big tabel 
     *
     * @param int $year
     * @return datatables JSON
     */
    public function api($year = null, $month =  null, $wilker_id = null)
    {
        $domas = Operasional::sortTableDetail($year, $month, $wilker_id)
                    ->with('wilker')
                    ->get();

        return datatables($domas)->addIndexColumn()->make(true);
    }
}
