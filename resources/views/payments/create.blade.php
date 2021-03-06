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
                            <h4>Form Data Pembayaran</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('payment.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group col-md-8">
                                <label for="inputEmail4">NISN</label>
                                <select id="nisn_id" name="nisn" class="form-control nisn_class" required></select>
                            </div>
                            <hr/>
                            <input type="hidden" class="form-control-plaintext" id="student_class_id" name="student_class_id" readonly required>
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
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label"> Nomor Wali : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext" id="student_wali_number" name="wali_number" readonly required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label"> Pekerjaan Wali : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext" id="student_wali_profession" name="wali_profession" readonly required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Agama : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control-plaintext" id="student_religion" name="religion" readonly required>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-row">
                                <div class="form-group col-md-4">
                                        <label for="inputName">Kelas</label>
                                        <input type="text" class="form-control" id="student_class_level" name="class_level" id="inputAddress" readonly required>
                                        
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputName">Semester</label>
                                        <input type="text" class="form-control" id="student_semester" name="class_level" id="inputAddress" readonly required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputName">Tahun Pembayaran</label>
                                        <input type="text" class="form-control" id="student_year" name="class_level" id="inputAddress" readonly required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Jumlah Pembayaran</label>
                                        <input type="text" class="form-control" id="student_cost" name="class_level" id="inputAddress" readonly required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputName">Bukti Bayar</label>
                                        <input type="file" class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}"" id="image" name="image" placeholder="Bukti Bayar" required>
                                        @if ($errors->has('file'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Status</label>
                                        <select id="payment_status" class="form-control" name="payment_status" required>
                                            @foreach($statuses as $key => $status)
                                                <option value= "{{ $key }}"> {{ $status }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Keterangan</label>
                                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a type="submit" class="btn btn-dark" href="{{ route('student.index') }}" style="float:right">Back</a>
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
          url: "{{ route('get_student')}}",
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
                $('#student_class_level').val(data.class);
                $('#student_semester').val(data.semester);
                $('#student_year').val(data.year);
                $('#student_cost').val(data.cost);
        });
    });
</script>
</body>


</html>