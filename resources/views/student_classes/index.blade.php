<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
@include('topnav')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-sm-10 offset-1">
            @include('flash::message')  
            <div class="row">
                <div class="col-md-10 offset-md-1" style="margin-top:20px;">
                    <div class="card" style="padding:10px;">
                    <h5 class="card-title">Tambahkan Data Siswa Kedalam Kelas</h5>
                    <hr/>
                    <form action="{{ route('class.student.store', $class->id ) }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-sm-2">
                                <label for="">NISN</label>
                            </div>
                            <div class="form-group col-sm-8">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="NISN" name="nisn" required>

                                @if ($errors->has('nisn'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nisn') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-sm-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="card" style="margin-top:30px;">
                    <div class="card-header"></div>
                        <div class="card-body">
                                <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Nama Wali Murid</th>
                                        <th colspan="3" style="text-align:center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student_classes as $key => $student_class)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $student_class->student->nisn}}</td>
                                        <td>{{ $student_class->student->name}}</td>
                                        <td>{{ $student_class->student->address}}</td>
                                        <td>{{ $student_class->student->wali_name}}</td>

                                        <td>
                                            <form action="{{ route('class.student.delete', [$class->id, $student_class->id] )}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin untuk menghapus?')"
                                                        type="submit">
                                                        <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    @endforeach
                                    </tr>
                                </tbody>
                        </table>
                        <a type="submit" class="btn btn-dark" href="{{ route('class.index') }}" style="float:right">  <i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
        </main>
      </div>
    </div>
@include('script')
</body>
</html>