<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Student_class;
use App\Semester;
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
                            ->select('payments.id as id','payments.image_payment','students.name as name', 'students.nisn as nisn','students.wali_number as wali_number','payments.status','payments.description','payments.year_payment','payments.semester','payments.created_at','payments.updated_at')
                            ->where('students.name','like', '%' .$request->get('search') . '%')
                            ->paginate(10);
        }else{
            $data['lists'] = DB::table('payments')
                            ->leftJoin('student_classes','payments.id_student_classes','=','student_classes.id')
                            ->leftJoin('students','student_classes.nisn_student','=','students.nisn')
                            ->select('payments.id as id','payments.image_payment','students.name as name', 'students.nisn as nisn','students.wali_number as wali_number','payments.status','payments.description','payments.year_payment','payments.semester','payments.created_at','payments.updated_at')
                            ->paginate(10);
            
        }
        return view('payments.index', $data);

        
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
        $semesters          = Semester::all();
        $religions          = $this->religions();
        $statuses           = $this->statuses();
        $semesters             = $this->semesters();
        $years              = $this->years();
        // $students           = Student::all();
        return view('payments.create', compact('student_classes','religions','statuses','semesters','years','get_date_now'));
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
                    ['semester',$request->semester],
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
            $payment->semester = $request->semester;
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
       
        $get_date_now       = Carbon::now();
        $student_classes    = Student_class::all();
        
        $religions          = $this->religions();
        $statuses           = $this->statuses();
        $semesters             = $this->semesters();
        $years              = $this->years();
        $payment           = Payment::find($id);
        $semester          = Semester::where('status','=',1);

        return view('payments.edit', compact('semester','payment','student_classes','religions','statuses','semesters','years','get_date_now'));
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
        dd($request->all());
            $payment = Payment::find($request->id);
            // dd($payment);
            $payment->status = $request->status;
            $payment->year_payment = $request->year_payment;
            $payment->semester = $request->semester;
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

    private function semesters()
    {
        return $semester =
        [
            '1' => 'Ganjil',
            '2' => 'Genap'
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
            $studentClasses = Student_class::orderby('nisn_student','asc')->select('nisn_student','id','id_class')
            ->with('Student','Classes')
            ->get();
         }else{
            $studentClasses = Student_class::orderby('nisn_student','asc')->select('nisn_student','id','id_class')
            ->with('Student','Classes')
            ->where('nisn_student', 'like', '%' .$search . '%')->limit(1)->get();
         }
         $response = array();
         $semester = DB::table('semesters')
                        ->where('status',1)
                        ->first();
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
                 "religion"=>$studentClass->student->religion,
                 "class"=>$studentClass->classes->level,
                 'year' => $semester->year,
                 'semester' => $semester->semester,
                 'cost' => $semester->{'cost_level_' . $studentClass->classes->level}
            );
         }
   
         return response()->json($response);
    }

    public function getUserStudent(Request $request)
    {
        $search = $request->search;
        if($search == ''){
            $studentClasses = Student_class::orderby('nisn_student','asc')->select('nisn_student','id','id_class')
            ->with('Student','Classes')
            ->limit(10)->get();
         }else{
            $studentClasses = Student_class::orderby('nisn_student','asc')->select('nisn_student','id','id_class')
                ->with('Student','Classes')
                ->where('nisn_student', 'like', '%' .$search . '%')->limit(5)->get();
         }
         $semester = DB::table('semesters')
                        ->where('status','=',1)
                        ->first();
                        // dd($semester);
                     
         $response = array();
         foreach($studentClasses as $studentClass){
            $response[] = array(
                 "id"=>$studentClass->nisn_student,
                 "student_class_id"=>$studentClass->id,
                 "nisn"=>$studentClass->student->nisn,
                 "text"=>$studentClass->student->name,
                 "wali_name"=>$studentClass->student->wali_name,
                 "wali_profession"=>$studentClass->student->wali_profession,
                 "religion"=>$studentClass->student->religion,
                 "class"=>$studentClass->classes->level,
                 "year" => $semester->year,
                 "semester" => $semester->semester,
                 'cost' => $semester->{'cost_level_' . $studentClass->classes->level},
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
        $semesters             =  $this->semesters();
        $years              =  $this->years();
        $get_date_now       = Carbon::now();
        $statuses           = $this->statuses();
        $student_classes    = Student_class::all();

        return view('users.form_payment', compact('semesters','years','get_date_now', 'statuses', 'student_classes'));
    }

    public function doUploadUser(Request $request)
    {
        $existNisn = Payment::where('id_student_classes', $request->student_class_id)->where([
                    ['semester',$request->semester],
                    ['year_payment', $request->year_payment]
                    ])->first();

        $existWaliNumber = Student::where('wali_number', $request->wali_number)->first();

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
                $payment->semester = $request->semester;
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
        
        // $get_month = Carbon::now()->month;
        $semesters = [
            1 => 'Ganjil',
            2 => 'Genap',
        ];
        // for($i=1;$i<=$get_month;$i++){
        //     $valid_months[] = $months[$i];
        // }
            try{
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
            }catch(\Exception $exception) {
                flash($exception->getMessage())->error();
                return redirect()->back();
            }
       
        return view('users.result_list_spp', compact('query', 'name','nisn','periode','semesters'));
    }
    

    public function successPage(Request $request)
    {
        return view('users.success_page');
    }

    public function paymentConfirmationList()
    {
        $payments = Payment::with('student_classes','semesters')
                    ->where('status','=',0)
                    ->get();
        
        return view('payments.payment_confirmation_list', compact('payments'));
    }
}
