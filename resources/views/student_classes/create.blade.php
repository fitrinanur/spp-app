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
                            <h4>Form Input Data Siswa</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('class.student.store', $classes) }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                <label for="inputState">Tingkatan</label>
                                <input type="text" class="form-control" id="inputName" name="level" placeholder="nisn" value="{{ $classes->level }}"readonly>
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputState">Kelas</label>
                                <input type="text" class="form-control" id="inputName" name="class_name" placeholder="nisn" value="{{ $classes->name }}"readonly>
                                </div>
                                <div class="form-group col-md-4">
                                <label for="inputName">NISN</label>
                                <input type="text" class="form-control" id="inputName" name="nisn" placeholder="nisn">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
        </main>
      </div>
    </div>
@include('script')
</body>


</html>