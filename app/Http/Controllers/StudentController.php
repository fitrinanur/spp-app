<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentExports;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $data['lists'] = Student::where('name', 'like', '%' .$request->get('search') . '%')->paginate(10);  
        }else{
            $data['lists'] = Student::paginate(10);
        }
        return view('students.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $religions  = $this->religions();
        return view('students.create', compact('religions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existNisn = Student::where('nisn', $request->nisn)->first();
        if($existNisn){
            flash('NISN sudah ada !')->error();
            return redirect()->route('student.create');

        }else {
            $student = new Student();
            $student->nisn = $request->nisn;
            $student->name = $request->name;
            $student->address = $request->address;
            $student->wali_name = $request->wali_name;
            $student->wali_number = $request->wali_number;
            $student->religion = $request->religion;
            $student->wali_profession = $request->wali_profession;
            $student->save();

            flash('Tambah data siswa berhasil!')->success();
            return redirect()->route('student.index');
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nisn)
    { 
        $religions = $this->religions();
        $student = Student::find($nisn);
        return view('students.edit', compact('student','religions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $student = Student::find($request->nisn);
            $student->nisn = $request->nisn;
            $student->name = $request->name;
            $student->address = $request->address;
            $student->wali_name = $request->wali_name;
            $student->wali_number = $request->wali_number;
            $student->religion = $request->religion;
            $student->wali_profession = $request->wali_profession;
            $student->update();
        
            flash('Update data siswa berhasil!')->success();
            return redirect()->route('student.index');
        }
        catch (\Exception $exception) {
            flash($exception->getMessage())->error();
            return redirect()->back();
        }

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nisn)
    {
        $student = Student::find($nisn);
        $student->delete();
        flash('Data Siswa telah dihapus!')->success();
        return redirect()->route('student.index');
    }

    private function religions()
    {
        return $religions =
        [
            '1' => 'Islam',
            '2' => 'Kristen',
            '3' => 'Katolik',
            '4' => 'Hindu',
            '5' => 'Budha'
        ];
    }

    public function doExport()
    {
        return Excel::download(new StudentExports, 'students.xlsx');
    }

}
