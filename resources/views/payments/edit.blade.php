<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
@include('topnav')
    <div class="container-fluid">
      <div class="row">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        @include('flash::message')  
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Edit Status Pembayaran</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('payment.update', $payment) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" class="form-control-plaintext" id="id" name="id" value="{{ $payment->id}}" readonly required>
                            <div class="form-control">
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label"> Nama Siswa : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control-plaintext" id="student_name" name="name" value="{{ $payment->student_classes->student->name }}" readonly required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label"> NISN : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control-plaintext" id="student_nisn" name="student_nisn" value="{{ $payment->student_classes->student->nisn }}" readonly required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label"> Nama Wali : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext" id="student_wali_name" name="wali_name" id="inputAddress" value="{{ $payment->student_classes->student->wali_name }}" readonly required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label"> Nomor Wali : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext" id="student_wali_number" name="wali_number" value="{{ $payment->student_classes->student->wali_number }}" readonly required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label"> Pekerjaan Wali : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext" id="student_wali_profession" name="wali_profession" value="{{ $payment->student_classes->student->wali_profession }}" readonly required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Agama : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext" id="student_religion" name="religion" value="{{ $payment->student_classes->student->religion }}"readonly required>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputName">Semester</label>
                                        <select id="month_payment" class="form-control" name="semester" required>
                                            @foreach($semesters as $key => $semester)
                                                <option value= "{{ $key }}" @if ($payment->semester ==
                                    $key) selected @endif > {{ $semester }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputName">Tahun Pembayaran</label>
                                        <select id="year_payment" class="form-control" name="year_payment" required>
                                        @foreach($years as $year)
                                        <option value="{{ $year }}" @if ($payment->year_payment ==
                                    $year) selected @endif> {{$year}} </option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Status</label>
                                        <select id="payment_status" class="form-control" name="payment_status" required>
                                            @foreach($statuses as $key => $status)
                                                <option value= "{{ $key }}" @if ($payment->status ==
                                    $key) selected @endif> {{ $status }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Keterangan</label>
                                    <textarea class="form-control" id="description" rows="3" name="description" required>{{ $payment->description }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-sync"></i> Update</button>
                                <a type="submit" class="btn btn-dark" href="{{ route('payment.index') }}" style="float:right"><i class="fa fa-arrow-left"></i> Back</a>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
        </main>
      </div>
    </div>
    

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
@include('script')
</body>


</html>