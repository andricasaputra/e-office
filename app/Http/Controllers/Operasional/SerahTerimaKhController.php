<?php

namespace App\Http\Controllers\Operasional;

use Illuminate\Http\Request;
use App\Contracts\BaseOperasionalInterface;
use App\Models\Operasional\SerahTerimaKh as Operasional;
use App\Http\Controllers\Operasional\Upload\UploadFactory;
use App\Http\Requests\UploadOperasionalRequest as Validation;

ini_set('max_execution_time', '500');

class SerahTerimaKhController extends BaseOperasionalController implements BaseOperasionalInterface
{
    /**
     * Untuk Halaman Detail Laporan 
     *
     * @param Illuminate\Http\Request $request
     * @return to view
     */
    public function tableDetailFrekuensiView(Request $request)
    {
        return view('intern.operasional.kh.data.statistik.detail.bigtable.serah_terima');
    }

    /**
     * Untuk Halaman Rekapitulasi Laporan 
     *
     * @param Illuminate\Http\Request $request
     * @return to view
     */
    public function rekapitulasiTableDetail(Request $request)
    {
        // return view('intern.operasional.kh.data.rekapitulasi.serah_terima_rekapitulasi');
    }
    
    /**
     * Untuk Halaman Upload Laporan 
     *
     * @return to view
     */
    public function uploadPageView(Request $request)
    {
        return view('intern.operasional.kh.upload.serah_terima');
    }

    /**
     *Import valid data ke database 
     *
     * @return void
     */
    public function imports(Validation $request)
	{
        // Filter Data Sebelum Insert Ke Database
        if (! $this->setDataProperty($request, new Operasional)->checkingData() ) return back();

        // Upload Data
        $factory = new UploadFactory();

        $upload  = $factory->initializeUploadType(new Operasional, $request);

        $upload->uploadData();

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
        $serahTerima  = Operasional::sortTableDetail([$year, $month, $wilker_id])
                        ->with('wilker')
                        ->get();

        return datatables($serahTerima)->addIndexColumn()->make(true);
    }
}
