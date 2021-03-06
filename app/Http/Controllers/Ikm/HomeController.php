<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Ikm;

use App\Models\Ikm\Answer;
use App\Models\Ikm\Jadwal;
use App\Models\Ikm\Result;
use App\Models\Ikm\Question;
use Illuminate\Http\Request;
use App\Models\Ikm\Responden;
use App\Http\Controllers\Controller;
use App\Repositories\Ikm\HomeRepository;

ini_set('max_execution_time', '300');

class HomeController extends Controller
{
    /**
     * For keep repository instance on the bag
     *
     * @var App\Repositories\HomeRepository
     */
    private $repository;

    /**
     * For keep instance of repository
     *
     * @param HomeRepository $repository
     * @return void
     */
    public function __construct(HomeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create API For Main dashboard tables
     *
     * @param int $ikmId
     * @return collections | array
     */
    public function api(int $ikmId = null)
    {
        return $this->repository->api($ikmId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailApi(int $id, int $ikmId)
    {
        return $this->repository->detailApi($id, $ikmId);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $ikmId = null)
    {
        if (! isset($ikmId)) {
            $ikmId  = $this->setIkmId();

            return redirect(route('intern.ikm.home.index', $ikmId));
        }

        $ikm    = Jadwal::select('id', 'keterangan')->get();

        return view('intern.ikm.home.index')
                ->with(compact('ikmId', 'ikm'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Responden $responden, int $year)
    {
        return view('intern.ikm.home.show')
                ->with(compact('responden', 'year'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Responden $responden)
    {
        $answers            = $responden->answer;
        $question_answer    = Question::all();

        return view('intern.ikm.home.edit')
                ->with(compact('responden', 'answers', 'question_answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Responden $responden)
    {
        $this->repository->update($request, $responden);

        return redirect(route('intern.ikm.home.index'))
                ->withSuccess('Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Responden::find($request->id)->delete();

        return redirect(route('intern.ikm.home.index'))
                ->withSuccess('Data Berhasil Dihapus');
    }

    /**
     * Cetak semua hasil survey responden
     *
     * @param  Jadwal  $ikmId
     * @return PDF
     */
    public function cetakMultiple(Request $request)
    {
        $jadwal             = Jadwal::find($request->jadwal);

        $question_answer    = Question::with('question_answer')->get();

        $chunk = [

            // untuk mengambil halaman awal yang berada pada index 0
            'awal' => $request->halaman_awal - 1,
            'jumlah' => $request->jumlah 

        ];

        $datas = $jadwal->responden()
                       ->orderBy('id', 'ASC')
                       ->get()
                       ->slice($chunk['awal'], $chunk['jumlah']);


        $view = view('intern.ikm.home.cetak_multiple', 
                    compact('jadwal', 'datas', 'question_answer')
                );

        pdf()->pdf->setTitle('Rekapitulasi Responden Survey Kepuasan Masyarakat');

        pdf()->writeHTML($view->render());

        return pdf()->output('Rekapitulasi Responden Survey Kepuasan Masyarakat.pdf');
    }

    /**
     * Set default IKM id jika tidak ada yang terpilih
     *
     * @return int
     */
    private function setIkmId()
    {
        return Jadwal::active()->first() ?? 1;
    }
}
