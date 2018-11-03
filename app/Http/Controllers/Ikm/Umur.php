<?php

namespace App\Http\Controllers\Ikm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Ikm\Umur as Model;

class Umur extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $umur = Model::all();
        return view('intern.ikm.umur.index')->with('umur', $umur);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intern.ikm.umur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'umur' => 'required'

        ]);

        Model::create([

            'umur' => $request->umur

        ]);

        return redirect(route('intern.ikm.umur.index'))
        ->with('success', 'Data Berhasil Ditambah');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $umur = Model::find($id);

        return view('intern.ikm.umur.edit')->with('umur', $umur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'umur' => 'required'

        ]);

        Model::find($id)->update([

            'umur' => $request->umur

        ]);

        return redirect(route('intern.ikm.umur.index'))
        ->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Model::destroy($id);

        return redirect(route('intern.ikm.umur.index'))
        ->with('success', 'Data Berhasil Dihapus');
    }
}