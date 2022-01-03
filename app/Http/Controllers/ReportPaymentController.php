<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\PaymentExports;
use App\Classes;
use Maatwebsite\Excel\Facades\Excel;

class ReportPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_date_now       = Carbon::now();
        $years              = $this->years();
        $semesters             = $this->semesters();
        $statuses           = $this->statuses();
        $classes            = Classes::all();
        return view('reports.payment_index',compact('years','semesters','get_date_now','statuses','classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function years()
    {
        $year = collect();

        for($i = 2020; $i < 2023; $i ++){
            $year->push($i);
        }

        return $year->toArray();
    }

    public function selectedYear()
    {
        $year = \request('year') ?: Carbon::now()->year;
        return $year;
    }

    private function semesters()
    {
        return $semesters =
        [
            '1' => 'Ganjil',
            '2' => 'Genap',
        ];
    }

    private function statuses()
    {
        return $status =
        [
            '1' => 'Approved',
            '0' => 'Pending'
        ];
    }

    public function doExport(Request $request)
    {
        $year = $request->year_payment;
        $semester = $request->semester;
        $class = $request->class;
        $status = $request->status;

        // dd($request->all());
        return (new PaymentExports)->filter($year,$semester,$class,$status)->download('Payments.xlsx');

    }
}
