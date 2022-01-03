<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
@include('topnav')
    <div class="container-fluid">
      <div class="row">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Data Siswa</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('student.update', $student) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="inputEmail4">NISN</label>
                                <input type="text" class="form-control" id="inputNisn" name="nisn" placeholder="NISN" value="{{ $student->nisn }}" required>
                                @if ($errors->has('nisn'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nisn') }}</strong>
                                </span>
                                @endif
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputName">Nama</label>
                                <input type="text" class="form-control" id="inputName" name="name" placeholder="Nama" value="{{ $student->name }}" required>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Nama Wali Murid</label>
                                <input type="text" class="form-control" name="wali_name" id="inputAddress" placeholder="Nama Wali Murid" value="{{ $student->wali_name }}" required >
                                @if ($errors->has('wali_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('wali_name') }}</strong>
                                </span>
                                @endif
                            </div> 
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">No Telepon</label>
                                    <input type="text" class="form-control" id="inputNisn" name="wali_number" placeholder="Nomor Telepon" value="{{ $student->wali_number }}" required >
                                    @if ($errors->has('wali_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wali_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputName">Pekerjaan</label>
                                    <input type="text" class="form-control" id="inputName" name="wali_profession" placeholder="Pekerjaan" value="{{ $student->wali_profession }}" required>
                                    @if ($errors->has('wali_profession'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wali_profession') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="inputState">Agama</label>
                                <select id="inputState" class="form-control {{ $errors->has('attractionType') ? ' is-invalid' : '' }}" name="religion" >
                                    @foreach($religions as $key => $religion)
                                    <option value= "{{$religion }}" @if ($student->religion ==
                                    $religion) selected @endif> {{ $religion }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('religion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('religion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                <label for="inputEmail4">Nama Dusun<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputNisn" name="dusun_name" placeholder="Nama Dusun" value="{{ $address[0] }}" required>
                                @if ($errors->has('dusun_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dusun_name') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputName">Desa<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="desa_name" placeholder="Nama Desa" value="{{ $address[1] }}" required>
                                @if ($errors->has('desa_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('desa_name') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-2">
                                <label for="inputName">RT<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="rt" placeholder="RT" value="{{ $address[2] }}" required>
                                @if ($errors->has('rt'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rt') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-2">
                                <label for="inputName">RW<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="rw" placeholder="RW" value="{{ $address[3] }}" required>
                                @if ($errors->has('rw'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rw') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputName">Kecamatan<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="kecamatan" placeholder="Kecamatan" value="{{ $address[4] }}" required>
                                @if ($errors->has('kecamatan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kecamatan') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputName">Kota<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="inputName" name="city" placeholder="Kota" value="{{ $address[5] }}" required>
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-sync"></i> Update</button>
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