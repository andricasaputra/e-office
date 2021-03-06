<?php 

namespace App\Repositories\Ikm;

use App\Models\Ikm\Jadwal;
use App\Models\Ikm\Result;
use App\Traits\Repository;
use App\Models\Ikm\Question;
use App\Models\Ikm\Responden;
use App\Contracts\RepositoryInterface;

class HomeRepository implements RepositoryInterface
{
	use Repository;

    /**
     * Untuk API IKM yang dipilih berdasarkan table responden (database), default id 1 
     * Digunakan pada table halaman dashboard / home
     *
     * @param int $ikmId
     * @return collections of Datatables 
     */
	public function api(int $ikmId = null)
    {
        $ikmId 		= $ikmId ?? 1;

        $responden  = Responden::whereIkmId($ikmId)->latest()->get();

        return  datatables($responden)->addIndexColumn()
                ->addColumn('action', function ($responden) use ($ikmId) {
                    return '
                    <a href="'.route('intern.ikm.home.edit', $responden->id).'" class="btn btn-xs btn-primary">
                        <i class="glyphicon glyphicon-edit"></i> Edit
                    </a>
                    <a href="'.route('intern.ikm.home.show', [$responden->id, $ikmId]).'" class="btn btn-xs btn-success">
                        <i class="glyphicon glyphicon-eye-open"></i> Detail
                    </a>
                    <a href="#" data-id = "'.$responden->id.'"  class="btn btn-danger btn-xs" id="deleteIkm">
                        <i class="glyphicon glyphicon-trash"></i> Delete
                    </a>';
                })->make(true);
    }

    /**
     * Untuk Detail API Per Responden, menampilkan jawaban dan nilai dari responden 
     *
     * @param int $id
     * @param int $ikmId
     * @return collections of Datatables 
     */
    public function detailApi(int $id, int $ikmId)
    {
        $result =  Result::whereIn('responden_id', [$id])->whereIkmId($ikmId)->get();

        return datatables($result)->addIndexColumn()->make(true);
    }

    /**
     * Untuk update jawaban responden 
     *
     * @param Request $request
     * @param instance of App\Models\Ikm\Responden
     * @return bool
     */
    public function update($request, $responden)
    {
    	$answer 	= $request->except(['responden_id','submit','_method','_token']);

        $combined 	= Question::select('id')->get()->map(function($question){

            return $question->id;

        })->combine(collect($answer)->flatMap(function($value){

            return $value;

        }));

        foreach ($combined as $key => $value) {

            $result 			= Result::whereRespondenId($responden->id)
                        			->whereQuestionId($key)
                        			->first();

            $result->answer_id 	= $value;

            $result->save();

        }

        return true;
    }

}