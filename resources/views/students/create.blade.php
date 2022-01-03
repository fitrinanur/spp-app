<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
@include('topnav')
    <div class="container-fluid">
      <div class="row">
        <main role="main" class="col-sm-10 offset-1">
                <div class="col-md-10 offset-1" style="margin-top:30px;">
                @include('flash::message')  
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Data Siswa</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('student.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="inputEmail4">NISN<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputNisn" name="nisn" placeholder="NISN" required>

                                @if ($errors->has('nisn'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nisn') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputName">Nama<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="name" placeholder="Nama" required>

                                @if ($errors->has('nisn'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nisn') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Nama Wali Murid<span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="wali_name" id="inputAddress" placeholder="Nama Wali Murid" required>

                                @if ($errors->has('wali_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wali_name') }}</strong>
                                    </span>
                                @endif
                            </div> 
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="inputEmail4">No Telepon<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputNisn" name="wali_number" placeholder="Nomor Telepon" required>
                                @if ($errors->has('wali_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wali_number') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputName">Pekerjaan<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="wali_profession" placeholder="Pekerjaan" required>
                                @if ($errors->has('wali_profession'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wali_profession') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="inputState">Agama<span style="color:red">*</span></label>
                                <select id="inputState" class="form-control {{ $errors->has('religion') ? ' is-invalid' : '' }}" name="religion">
                                    @foreach($religions as $key => $religion)
                                    <option value= "{{$religion }}"> {{ $religion }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('religion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('religion') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- <div class="form-group">
                                <label for="exampleFormControlTextarea1">Alamat<span style="color:red">*</span></label>
                                <textarea class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="exampleFormControlTextarea1" rows="3" name="address" required></textarea>
                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div> -->

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                <label for="inputEmail4">Nama Dusun<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputNisn" name="dusun_name" placeholder="Nama Dusun" required>
                                @if ($errors->has('dusun_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dusun_name') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputName">Desa<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="desa_name" placeholder="Nama Desa" required>
                                @if ($errors->has('desa_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('desa_name') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-2">
                                <label for="inputName">RT<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="rt" placeholder="RT" required>
                                @if ($errors->has('rt'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rt') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-2">
                                <label for="inputName">RW<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="rw" placeholder="RW" required>
                                @if ($errors->has('rw'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rw') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputName">Kecamatan<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="kecamatan" placeholder="Kecamatan" required>
                                @if ($errors->has('kecamatan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kecamatan') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputName">Kota<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="city" placeholder="Kota" required>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div> 
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a type="submit" class="btn btn-dark" href="{{ route('student.index') }}" style="float:right"><i class="fa fa-arrow-left"></i> Back</a>
                            </form>
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