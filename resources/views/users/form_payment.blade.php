<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
    <div class="container-fluid">
      <div class="row">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        @include('flash::message')  
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Data Pembayaran</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route ('user_payment.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label for="inputEmail4" class="col-sm-4 col-form-label">Masukkan NISN</label>
                                <div class="col-sm-12">
                                    <select id="nisn_id" name="nisn" class="form-control nisn_class" required></select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputName" class="col-sm-8 col-form-label"> Masukkan Nomor Handphone Wali Siswa Terdaftar </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="student_wali_number" name="wali_number" placeholder="Nomor Handphone" required>
                                </div>
                            </div>
                            <hr/>
                          
                            <div class="form-control">
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label"> Nama Siswa : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control-plaintext" id="student_name" name="name" readonly required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label"> NISN : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control-plaintext" id="student_nisn" name="student_nisn" readonly required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label"> Nama Wali : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext" id="student_wali_name" name="wali_name" id="inputAddress" readonly required>
                                    </div>
                                </div>
                                <hr/>
                                
                                <!-- hidden input -->
                                <input type="hidden" class="form-control-plaintext" id="student_religion" name="religion" readonly required>
                                <input type="hidden" class="form-control-plaintext" id="student_class_id" name="student_class_id" readonly required>
                                <input type="hidden" class="form-control-plaintext" id="status" name="payment_status" readonly required value="0">
                                <input type="hidden" class="form-control-plaintext" id="student_wali_profession" name="wali_profession" readonly required>
                                <input type="hidden" class="form-control-plaintext" id="student_class_id" name="" readonly required>
                               
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputName">Bulan Pembayaran</label>
                                        <select id="month_payment" class="form-control" name="month_payment" required>
                                            @foreach($months as $key => $month)
                                                <option value= "{{ $key }}" @if ($get_date_now->month == $key) selected @endif > {{ $month }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputName">Periode</label>
                                        <select id="year_payment" class="form-control" name="year_payment" required>
                                        @foreach($years as $year)
                                        <option value="{{ $year }}" @if ($get_date_now->year == $year) selected @endif > {{$year}} </option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Jumlah SPP</label>
                                        <select id="grade_spp" class="form-control" name="grade_spp" required>
                                            @foreach($grade_spp as $key => $spp)
                                                <option value= "{{ $spp->id }}"> {{ $spp->total }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputName">Bukti Bayar</label>
                                        <input type="file" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"" id="image" name="image" placeholder="Bukti Bayar" required>
                                        @if ($errors->has('file'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Keterangan</label>
                                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="submit" class="btn btn-dark" href="{{ url('/') }}" style="float:right">Back</a>
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
<script type="application/javascript">
    $(document).ready(function () {
        // $('.nisn_class').select2();
        $('#nisn_id').select2({
            ajax: { 
          url: "{{ route('get_user_student')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
                "_token": "{{ csrf_token() }}",
                search:  params.term, // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }
        });

        $('#nisn_id').on('select2:select', function (e) {
                var data = e.params.data;
                $('#student_name').val(data.text);
                $('#student_class_id').val(data.student_class_id);
                $('#student_nisn').val(data.nisn);
                $('#student_wali_name').val(data.wali_name);
                $('#student_wali_number').val(data.wali_number);
                $('#student_wali_profession').val(data.wali_profession);
                $('#student_religion').val(data.religion);
        });
    });
</script>
</body>


</html>