<?php

namespace App\Http\Controllers\Operasional;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Operasional\ImporKh as Operasional;
use App\User;
use App\Wilker;
use DataTables;

ini_set('max_execution_time', 200);

class ImporKh extends UploadOperasional implements OperasionalInterface
{
    public function sendToData($year = null)
    {
        $titles = $this->tableTitleKh();

        return view('intern.operasional.kh.data.tables.impor')
        ->with('titles', $titles)
        ->with('tahun', $year);
    }
    /**
     *Ambil Data User Yang Sedang Aktif Dan Kirim ke view 
     *
     * @return to View
     */
    public function sendToUpload()
    {
        $user_id    = Auth::user()->id;

        $user       = User::where('id', $user_id)->first();

        if (Auth::user()->role_id == 1) {

            $wilker     = Wilker::where('nama_wilker', '!=', 'Kantor induk')->get();

        }else{

            $wilker     = User::find($user_id)->wilker->toArray();
        }

        return view('intern.operasional.kh.upload.impor')
        ->with('user', $user)
        ->with('wilker', $wilker);
    }

    /**
     *Import valid data ke database 
     *
     * @return void
     */
    public function imports(Request $request) 
	{
        $request->validate([

            'wilker_id' => 'required',
            'filenya' => 'mimes:xls,xlsx'

        ]);

        $user_id = $request->user_id;

        $wilker_user = User::find($user_id)->wilker;

        $wilker_user = $wilker_user->nama_wilker;

        if (strpos($wilker_user, '.') !== false) {

            $wilker_user = str_replace('.', ' ', $wilker_user);
        }

        $wilker_user = str_replace(' ', '', $wilker_user);

        $wilker_id = $request->wilker_id;

	    if($request->hasFile('filenya')){

            $path = $request->file('filenya')->getRealPath();

            /*Filter Data Sebelum Insert Database*/
            if($this->checkingData($path, 'operasional_karantina_hewan', 'impor', $wilker_user) === false){

                return redirect()->back();

            }
 
            /*Ambil Bulan Dan Tahun Pada Laporan Di Row 3*/
            $headings = Excel::selectSheetsByIndex(0)->load($path, function($reader) {

                config(['excel.import.startRow' => 3]);

            })->first()->toArray();

            /*Data Asli Dimulai Dari Row Ke 7*/
            $datas = Excel::selectSheetsByIndex(0)->load($path, function($reader) {
                
                config(['excel.import.startRow' => 7]);

            })->get();

            /*set tanggal format Y-m-d*/
            foreach ($headings as $heading) {
                $lowereing  = strtolower($heading);
                $getContent = explode(' ', $lowereing);
                $bulan      = $getContent[2];
                $tahun      = $getContent[6];
                $tanggal_laporan[] = $tahun.'-'.$bulan.'-01';
            }

            $success = 0;

            /*Jika semua validasi berhasil & jika file tidak kosong maka insert ke database*/
            if (!empty($datas) && $datas->count() > 0) :

                    foreach ($datas as $key => $value) :

                        $impor = new Operasional;

                        $impor->wilker_id = $wilker_id;
                        $impor->user_id = $user_id;
                        $impor->no = $value->no;
                        $impor->bulan = $tanggal_laporan[0]; 
                        $impor->no_permohonan = $value->no_permohonan; 
                        $impor->no_aju = $value->no_aju; 
                        $impor->tanggal_permohonan = $value->tanggal_permohonan; 
                        $impor->jenis_permohonan = $value->jenis_permohonan; 
                        $impor->nama_pemohon = $value->nama_pemohon; 
                        $impor->nama_pengirim = $value->nama_pengirim; 
                        $impor->alamat_pengirim = $value->alamat_pengirim; 
                        $impor->nama_penerima = $value->nama_penerima; 
                        $impor->alamat_penerima = $value->alamat_penerima; 
                        $impor->jumlah_kemasan = $value->jumlah_kemasan; 
                        $impor->kota_asal = $value->kota_asal; 
                        $impor->asal = $value->asal; 
                        $impor->kota_tuju = $value->kota_tuju; 
                        $impor->tujuan = $value->tujuan; 
                        $impor->port_asal = $value->port_asal; 
                        $impor->port_tuju = $value->port_tuju; 
                        $impor->moda_alat_angkut_terakhir = $value->moda_alat_angkut_terakhir; 
                        $impor->tipe_alat_angkut_terakhir = $value->tipe_alat_angkut_terakhir; 
                        $impor->nama_alat_angkut_terakhir = $value->nama_alat_angkut_terakhir; 
                        $impor->status_internal = $value->status_internal; 
                        $impor->peruntukan = $value->peruntukan; 
                        $impor->jenis_mp = $value->jenis_mp; 
                        $impor->kelas_mp = $value->kelas_mp; 
                        $impor->kode_hs = $value->kode_hs; 
                        $impor->nama_mp = $value->nama_mp; 
                        $impor->nama_latin = $value->nama_latin; 
                        $impor->jumlah = $value->jumlah; 
                        $impor->satuan = $value->satuan; 
                        $impor->jantan = $value->jantan; 
                        $impor->betina = $value->betina; 
                        $impor->netto = $value->netto; 
                        $impor->sat_netto = $value->sat_netto; 
                        $impor->bruto = $value->bruto; 
                        $impor->sat_bruto = $value->sat_bruto; 
                        $impor->keterangan = $value->keterangan; 
                        $impor->breed = $value->breed; 
                        $impor->volumeP1 = $value->volumeP1; 
                        $impor->nettoP1 = $value->nettoP1; 
                        $impor->volumeP8 = $value->volumeP8; 
                        $impor->nettoP8 = $value->nettoP8; 
                        $impor->dok_pelepasan = $value->dok_pelepasan; 
                        $impor->nomor_dok_pelepasan = $value->nomor_dok_pelepasan; 
                        $impor->tanggal_pelepasan = $value->tanggal_pelepasan; 
                        $impor->no_seri = $value->no_seri; 
                        $impor->dokumen_pendukung = $value->dokumen_pendukung; 
                        $impor->kontainer = $value->kontainer; 
                        $impor->biaya_perjalanan_dinas = $value->biaya_perjalanan_dinas; 
                        $impor->total_pnbp = $value->total_pnbp; 

                        $cek = Operasional::where('nomor_dok_pelepasan', $value->nomor_dok_pelepasan)
                        ->where('no_seri', $value->no_seri)
                        ->where('tanggal_pelepasan', $value->tanggal_pelepasan)
                        ->where('no_permohonan', $value->no_permohonan)->first();

                        /*Jika data yang sama atau file yang sama sudah pernah diupload maka data jangan dimasukkan ke dalam database*/ 

                        if ($cek !== null) {

                            $success = 1;

                            continue;

                        }else{

                            $impor->save();

                            $success = 2;
                        }

                    endforeach;

                    /*Jika data berhasil di insert ke database*/ 
                    if ($success > 0) {

                        /*Jika data berhasil di insert ke database tetapi file sudah pernah diupload tampilkan pesan*/ 
                        if ($success == 1) {
                        
                            \Session::flash('success','File Sudah Pernah Diunggah, Tidak Ada Data Untuk Diperbarui!');

                        }else{

                            \Session::flash('success','Data Berhasil Diimport!');

                        }       

                    /*Error tidak terduga / bad connection??*/
                    }else{

                        \Session::flash('warning','Gagal Import Data!');

                    }

            endif;

        /*Jika file ksoong tampilkan pesan error*/    
        }else{

            \Session::flash('warning','Harap Pilih File Untuk Diimport Terlebih Dahulu!');

        }

        return redirect()->back();

	}

    /**
     *Export data dengan format excel dari database
     *
     * @return void
     */
    public function exports($tahun = '', $bulan = 'all')
    {

        if ($tahun != '') :
            
            if ($bulan != 'all') {
                
                $Datas = Operasional::whereMonth('tanggal_permohonan', $bulan)->get()->toArray();
                
            }else{

                $Datas = Operasional::whereYear('tanggal_permohonan', $tahun)->get()->toArray();

            }

        else :

            if ($bulan != 'all') {
                
                $Datas = Operasional::whereMonth('tanggal_permohonan', $bulan)->get()->toArray();

            }else{

                $Datas = Operasional::all()->toArray();
            }

        endif;

        \Session::flash('success','Data Berhasil Didownload!');

        return Excel::create('Datas', function($excel) use ($Datas) {
            $excel->sheet('Data Details', function($sheet) use ($Datas){

                $sheet->fromArray($Datas);
                
            });
        })->download('xlsx');
  
    }

    public function api($year)
    {
        $impor = Operasional::whereYear('bulan', $year);

        return Datatables::of($impor)->addIndexColumn()->make(true);
    }
}

