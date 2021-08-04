<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Student_class;
use App\Grade_spp;
use App\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Response;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;



class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data['lists'] = Payment::paginate(3);

        if($request->has('search')){
            $data['lists'] = DB::table('payments')
                            ->leftJoin('student_classes','payments.id_student_classes','=','student_classes.id')
                            ->leftJoin('students','student_classes.nisn_student','=','students.nisn')
                            ->select('payments.id as id','payments.image_payment','students.name as name', 'students.nisn as nisn','students.wali_number as wali_number','payments.status','payments.description','payments.year_payment','payments.created_at','payments.updated_at')
                            ->where('students.name','like', '%' .$request->get('search') . '%')
                            ->paginate(10);
        }else{
            $data['lists'] = DB::table('payments')
                            ->leftJoin('student_classes','payments.id_student_classes','=','student_classes.id')
                            ->leftJoin('students','student_classes.nisn_student','=','students.nisn')
                            ->select('payments.id as id','payments.image_payment','students.name as name', 'students.nisn as nisn','students.wali_number as wali_number','payments.status','payments.description','payments.year_payment','payments.created_at','payments.updated_at')
                            ->paginate(10);
            
        }
        return view('payments.index', $data);

        // $payments = Payment::with('student_classes','grade_spp')->get();
        // return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $get_date_now       = Carbon::now();
        $student_classes    = Student_class::all();
        $grade_spp          = Grade_spp::all();
        $religions          = $this->religions();
        $statuses           = $this->statuses();
        $months             = $this->months();
        $years              = $this->years();
        // $students           = Student::all();
        return view('payments.create', compact('student_classes','grade_spp','religions','statuses','months','years','get_date_now'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $existNisn = Payment::where('id_student_classes', $request->student_class_id)->where([
                    ['month_payment',$request->month_payment],
                    ['year_payment', $request->year_payment]
                    ])->first();
        // dd($existNisn);
        //validasi image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($existNisn){
            flash('Siswa dengan NISN tersebut sudah membayar / Cek status verifikasi pembayaran!')->error();
            return redirect()->route('payment.create');
        }else{
            $payment = new Payment;
            $payment->id_student_classes = $request->student_class_id;
            $payment->id_grade_spp = $request->grade_spp;
    
            if ($request->file('image')) {
                $imagePath = $request->file('image');
                $extension = $request->image->extension();
                // dd($extension);
                $name = time().".".$extension;
                $request->image->move(storage_path('app/images'),$name);
            }
            if(auth()->user()->id == 1){
                $payment->status = 1;
            }
            $payment->description = $request->description;
            $payment->month_payment = $request->month_payment;
            $payment->year_payment = $request->year_payment;
            $payment->image_payment = $name;
            $payment->save();
            
            flash('Data Pembayaran Berhasil Ditambahkan!')->success();
            return redirect()->route('payment.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentController  $paymentController
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentController  $paymentController
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $get_date_now       = Carbon::now();
        $student_classes    = Student_class::all();
        $grade_spp          = Grade_spp::all();
        $religions          = $this->religions();
        $statuses           = $this->statuses();
        $months             = $this->months();
        $years              = $this->years();
        $payment           = Payment::find($id);

        return view('payments.edit', compact('payment','student_classes','grade_spp','religions','statuses','months','years','get_date_now'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentController  $paymentController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
            $payment = Payment::find($request->id);
            // dd($payment);
            $payment->status = $request->status;
            $payment->year_payment = $request->year_payment;
            $payment->month_payment = $request->month_payment;
            $payment->description = $request->description;
            $payment->status = $request->payment_status;
            $payment->update();
        
            flash('Update status pembayaran siswa berhasil!')->success();
            return redirect()->route('payment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentController  $paymentController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        flash('Data pembayaran telah dihapus!')->success();
        return redirect()->route('payment.index');
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

    private function statuses()
    {
        return $status =
        [
            '1' => 'Approved',
            '0' => 'Pending'
        ];
    }

    private function months()
    {
        return $month =
        [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
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

    public function getStudent(Request $request)
    {
        $search = $request->search;
        if($search == ''){
            $studentClasses = Student_class::orderby('nisn_student','asc')->select('nisn_student','id','id_class')->limit(5)->get();
         }else{
            $studentClasses = Student_class::orderby('nisn_student','asc')->select('nisn_student','id','id_class')
                ->with('Student','Classes')
                ->where('nisn_student', 'like', '%' .$search . '%')->limit(1)->get();
         }
         $response = array();
         foreach($studentClasses as $studentClass){
            //  dd($studentClass);
            $response[] = array(
                 "id"=>$studentClass->nisn_student,
                 "student_class_id"=>$studentClass->id,
                 "nisn"=>$studentClass->student->nisn,
                 "text"=>$studentClass->student->name,
                 "wali_name"=>$studentClass->student->wali_name,
                 "wali_number"=>$studentClass->student->wali_number,
                 "wali_profession"=>$studentClass->student->wali_profession,
                 "religion"=>$studentClass->student->religion
            );
         }
   
         return response()->json($response);
    }

    public function getUserStudent(Request $request)
    {
        $search = $request->search;
        if($search == ''){
            $studentClasses = Student_class::orderby('nisn_student','asc')->select('nisn_student','id','id_class')->limit(5)->get();
         }else{
            $studentClasses = Student_class::orderby('nisn_student','asc')->select('nisn_student','id','id_class')
                ->with('Student','Classes')
                ->where('nisn_student', 'like', '%' .$search . '%')->limit(1)->get();
         }
         $response = array();
         foreach($studentClasses as $studentClass){
            //  dd($studentClass);
            $response[] = array(
                 "id"=>$studentClass->nisn_student,
                 "student_class_id"=>$studentClass->id,
                 "nisn"=>$studentClass->student->nisn,
                 "text"=>$studentClass->student->name,
                 "wali_name"=>$studentClass->student->wali_name,
                 "wali_profession"=>$studentClass->student->wali_profession,
                 "religion"=>$studentClass->student->religion
            );
         }
   
         return response()->json($response);
    }

    public function getImage($id)
    {
        
        $payments = Payment::find($id);
        $path = 'images/' . $payments->image_payment;
        
        if ($exists = Storage::exists($path)) {

            // $fullPath = storage_path('app') . '/' . $path;
            return Storage::response($path);
    
        } else {
            abort(404);
        }
    }

    public function userPayment()
    {
        $months             =  $this->months();
        $years              =  $this->years();
        $get_date_now       = Carbon::now();
        $statuses           = $this->statuses();
        $student_classes    = Student_class::all();
        $grade_spp          = Grade_spp::all();

        return view('users.form_payment', compact('months','years','get_date_now','grade_spp', 'statuses', 'student_classes'));
    }

    public function doUploadUser(Request $request)
    {
        $existNisn = Payment::where('id_student_classes', $request->student_class_id)->first();
        $existWaliNumber = Student::where('wali_number', $request->wali_number)->first();
        // dd($existWaliNumber);
        //validasi image
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if($existNisn){
            flash('Siswa dengan NISN tersebut sudah membayar / Cek status verifikasi pembayaran!')->error();
            return redirect()->route('payment.create');
        }else{
            if($existWaliNumber){
                // dd($request->all());
                $payment = new Payment;
                $payment->id_student_classes = $request->student_class_id;
                $payment->id_grade_spp = $request->grade_spp;
        
                if ($request->file('image')) {
                    $imagePath = $request->file('image');
                    $extension = $request->image->extension();
                    $name = time().".".$extension;
                    $request->image->move(storage_path('app/images'),$name);
                }
                $payment->status = $request->payment_status;
                $payment->description = $request->description;
                $payment->month_payment = $request->month_payment;
                $payment->year_payment = $request->year_payment;
                $payment->image_payment = $name;
                $payment->save();
                
                flash('Upload Bukti Pembayaran Berhasil!')->success();
                return redirect()->route('user.success_page');
            }else{
                flash('Nomor wali murid belum terdaftar!')->error();
                return redirect()->route('payment.create');
            }
           
        }
    }

    public function getCheckSpp(Request $request)
    {
        return view('users.form_check_spp');
    }

    public function doCheckSpp(Request $request)
    {
        
        $get_month = Carbon::now()->month;
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 =>'Agustus',
            9 =>'September',
            10 =>'Oktober',
            11 =>'November',
            12 =>'Desember'
        ];
        for($i=1;$i<=$get_month;$i++){
            $valid_months[] = $months[$i];
        }
        $query = DB::table('payments')
                ->leftJoin('student_classes','payments.id_student_classes','=','student_classes.id')
                ->leftJoin('students','student_classes.nisn_student','=','students.nisn')
                ->where([
                    ['students.nisn','=', $request->nisn],
                    ['students.wali_number','=', $request->mobile_number]
                ])
                ->get();
        
        foreach($query as $q){
            $name = $q->name;
            $nisn = $q->nisn;
            $periode = $q->year_payment;
        }
        return view('users.result_list_spp', compact('query', 'name','nisn','periode','valid_months'));
    }
    

    public function successPage(Request $request)
    {
        return view('users.success_page');
    }

    public function paymentConfirmationList()
    {
        $payments = Payment::with('student_classes','grade_spp')
                    ->where('status','=',0)
                    ->get();
        
        return view('payments.payment_confirmation_list', compact('payments'));
    }
}
