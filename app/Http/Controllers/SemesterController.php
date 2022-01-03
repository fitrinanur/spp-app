<?php

namespace App\Http\Controllers;

use App\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $semesters = Semester::all();
            return view('semesters.index', compact('semesters'));
        }
    
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $semestersalias = $this->semestersalias();
            $statuses = $this->statuses();
            return view('semesters.create' , compact('semestersalias','statuses'));
        }
    
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $semester = new Semester();
            $semester->year = $request->year;
            $semester->cost_level_7 = $request->cost_level_7;
            $semester->cost_level_8 = $request->cost_level_8;
            $semester->cost_level_9 = $request->cost_level_9;
            $semester->status = $request->status;
            $semester->semester = $request->semester;
            $semester->update();

            flash('Data berhasil di tambah!')->success();
            return redirect()->route('semester.index');
        }
    
        /**
         * Display the specified resource.
         *
         * @param  \App\Grade_spp  $grade_spp
         * @return \Illuminate\Http\Response
         */
        public function show(Semester $semester)
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
            $semester = Semester::find($id);
            $semestersalias = $this->semestersalias();
            $statuses = $this->statuses();
            return view('semesters.edit',compact('semester','semestersalias','statuses'));
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
                $semester = Semester::find($id);
                $semester->year = $request->year;
                $semester->cost_level_7 = $request->cost_level_7;
                $semester->cost_level_8 = $request->cost_level_8;
                $semester->cost_level_9 = $request->cost_level_9;
                $semester->status = $request->status;
                $semester->semester = $request->semester;
                $semester->update();
    
                flash('Update berhasil!')->success();
                return redirect()->route('semester.index');
            //  }
            //  catch (\Exception $exception) {
            //      flash($exception->getMessage())->error();
            //      return redirect()->back();
            // }
        }

        public function changeStatus(Request $request, $id)
        {

            $semester = Semester::find($id);
            if($request->status == 1){
                $semester->status = 0;
            }else{
                $semester->status = 1;
            }
            $semester->update();

            flash('Semester aktif diganti!')->success();
            return redirect()->route('semester.index');
        }
    
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Grade_spp  $grade_spp
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $semester = Semester::find($id);
            $semester->delete();
            flash('Data nilai sumbangan telah dihapus!')->success();
            return redirect()->route('semester.index');
        }
    
        private function semestersalias()
        {
            return $semestersalias =
            [
                '1' => 'Ganjil',
                '2' => 'Genap',
            ];
        }

        private function statuses()
        {
            return $statuses =
            [
                '0' => 'Nonaktif',
                '1' => 'Aktif',
            ];
        }
}
