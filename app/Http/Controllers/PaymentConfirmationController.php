<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use DataTables;
use Illuminate\Support\Facades\DB;


class PaymentConfirmationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $data['lists'] = DB::table('payments')
                            ->leftJoin('student_classes','payments.id_student_classes','=','student_classes.id')
                            ->leftJoin('students','student_classes.nisn_student','=','students.nisn')
                            ->select('payments.id as id','payments.image_payment','students.name as name', 'students.nisn as nisn','students.wali_number as wali_number','payments.status','payments.description','payments.year_payment','payments.created_at')
                            ->where([
                                ['payments.status','=',0],
                                ['students.name','like', '%' .$request->get('search') . '%']
                            ])
                            ->paginate(10);
        }else{
            $data['lists'] = DB::table('payments')
                            ->leftJoin('student_classes','payments.id_student_classes','=','student_classes.id')
                            ->leftJoin('students','student_classes.nisn_student','=','students.nisn')
                            ->select('payments.id as id','payments.image_payment','students.name as name', 'students.nisn as nisn','students.wali_number as wali_number','payments.status','payments.description','payments.year_payment','payments.created_at')
                            ->where('payments.status','=',0)
                            ->paginate(10);
            
        }
        return view('payments.payment_confirmation_list', $data);
        
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
            $payment = Payment::find($id);
            $payment->status = 1;
            $payment->update();

            flash('Pembayaran Diverifikasi! Status telah berhasil di update!')->success();
            return redirect()->route('payment_confirmation.index');
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
}
