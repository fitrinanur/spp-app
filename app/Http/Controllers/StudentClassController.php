<?php

namespace App\Http\Controllers;

use App\StudentClass;
use Illuminate\Http\Request;
use App\Student_class;
use App\Student;
use App\Classes;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $student_classes = Student_class::all();
        return view('student_classes.index', compact('student_classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::all();
        $students = Student::all();
        return view('student_classes.create', compact('classes','students'));
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
            $student_class = new Student_class();
            $student_class->id_class = $request->id_class;
            $student_class->nisn = $request->nisn;
            $student_class->save();

            flash('Tambah siswa dalam kelas berhasil!')->success();
            return redirect()->route('student_classes.index');
         }
            catch (\Exception $exception) {
             flash($exception->getMessage())->error();
             return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentClassController  $studentClassController
     * @return \Illuminate\Http\Response
     */
    public function show(StudentClassController $studentClassController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentClassController  $studentClassController
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentClassController $studentClassController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentClassController  $studentClassController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentClassController $studentClassController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentClassController  $studentClassController
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentClassController $studentClassController)
    {
        //
    }
}
