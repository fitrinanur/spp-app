<?php

namespace App\Http\Controllers;

use App\Grade_spp;
use App\Classes;
use Illuminate\Http\Request;

class GradeSppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grade_spps = Grade_spp::all();
        return view('grade_spp.index', compact('grade_spps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade_spp  $grade_spp
     * @return \Illuminate\Http\Response
     */
    public function show(Grade_spp $grade_spp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade_spp  $grade_spp
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade_spp = Grade_spp::find($id);
        $levels = $this->levels();
        return view('grade_spp.edit',compact('grade_spp','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade_spp  $grade_spp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // try {
            $grade_spp = Grade_spp::find($id);
            $grade_spp->level = $request->level;
            $grade_spp->total = $request->total;
            $grade_spp->update();

            flash('Update jumlah SPP berhasil!')->success();
            return redirect()->route('grade_spp.index');
        //  }
        //  catch (\Exception $exception) {
        //      flash($exception->getMessage())->error();
        //      return redirect()->back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade_spp  $grade_spp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade_spp $grade_spp)
    {
        //
    }

    private function levels()
    {
        return $levels =
        [
            '1' => '7',
            '2' => '8',
            '3' => '9',
        ];
    }
}
