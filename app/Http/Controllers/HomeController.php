<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Classes;
use App\Payment;


class HomeController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $classes = Classes::all();
        $confirmation_payments = Payment::where('status','=',0)->get();
        $payments = Payment::all();

        return view('home', compact('students','classes','confirmation_payments','payments'));
    }
}
