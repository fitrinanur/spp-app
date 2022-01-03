<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Student;
use App\Student_class;
use App\Exports\ClassesExports;
use Maatwebsite\Excel\Facades\Excel;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $data['lists'] = Classes::orderBy('level')->where('name', 'like', '%' .$request->get('search') . '%')->paginate(10);  
        }else{
            $data['lists'] = Classes::orderBy('level')->paginate(10);
        }
        return view('classes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = $this->levels();
        return view('classes.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $class = new Classes();
            $class->level = $request->level;
            $class->name = $request->name;
            $class->save();

            flash('Tambah data kelas berhasil!')->success();
            return redirect()->route('class.index');
         }
         catch (\Exception $exception) {
             flash($exception->getMessage())->error();
             return redirect()->back();
        }
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
    public function edit($id)
    {
        $levels =  $this->levels();
        $class = Classes::find($id);
        return view('classes.edit', compact('class', 'levels'));
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
            $class = Classes::find($request->id);
            $class->level = $request->level;
            $class->name = $request->name;
            $class->update();

            flash('Update data kelas berhasil!')->success();
            return redirect()->route('class.index');
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
    public function destroy($id)
    {
        $class = Classes::find($id);
        $class->delete();
        flash('Data kelas telah dihapus!')->success();
        return redirect()->route('class.index');
    }

    private function levels()
    {
        return $levels =
        [
            '1' => '7',
            '2' => '8',
            '3' => '9'
        ];
    }

    // public function createStudent($id)
    // {
    //     $classes = Classes::find($id);
    //     $students = Student::all();
    //     return view('student_classes.create',compact('classes','students'));
    // }

    public function storeStudent(Request $request,$id)
    { 
        $existNisn = Student_class::where('nisn_student', $request->nisn)
        ->first();
        $existStudent =Student::where('nisn',$request->nisn)->first();

        if($existStudent){
            if($existNisn){
                flash('Data Siswa Sudah Ada / Siswa Sudah Terdaftar Ditempat Lain !')->error();
                return redirect()->route('class.student.index', $id);
            }else{
                $student_class = new Student_class();
                $student_class->id_class = $id;
                $student_class->nisn_student = $request->nisn;
                $student_class->save();

                flash('Tambah siswa kedalam kelas berhasil!')->success();
                return redirect()->route('class.student.index', $id);
            }
            
        }else{
            flash('NISN Siswa belum terdaftar!')->error();
            return redirect()->route('class.student.index', $id);
        }
    }

    public function indexStudentClass($id)
    {
        $class = Classes::find($id);
        $student_classes = Student_class::where('id_class',$id)->with('student')->get();
        
        return view('student_classes.index',compact('class','student_classes'));
    }

    public function deleteStudent($class_id, $student_class_id)
    {
        $del_student = Student_class::find($student_class_id);
        $del_student->delete();
        
        flash('Data Berhasil Dihapus !')->success();
        return redirect()->route('class.student.index', $class_id);
    }
}
