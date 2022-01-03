<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
@include('topnav')
    <div class="container-fluid">
      <div class="row">
        <main role="main" class="col-sm-10 offset-1">
                <div class="col-sm-10 offset-1" style="margin-top:30px">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Nilai Sumbangan</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('semester.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputName">Tahun</label>
                                    <input type="text" class="form-control" id="inputName" name="year" placeholder="Tahun">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputName">Semester</label>
                                    <select id="inputState" class="form-control {{ $errors->has('semester') ? ' is-invalid' : '' }}" name="semester" >
                                        @foreach($semestersalias as $key => $smt)
                                            <option value= "{{ $key }}"> {{ $smt }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('semester'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('semester') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputName">Status</label>
                                    <select id="inputState" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" >
                                        @foreach($statuses as $key => $status)
                                            <option value= "{{ $key }}"> {{ $status }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Kelas 7<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="inputName" name="cost_level_7" placeholder="Kelas 7" required>
                                    @if ($errors->has('cost_level_7'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cost_level_7') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputName">Kelas 8<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="inputName" name="cost_level_8" placeholder="Kelas 8" required>
                                    @if ($errors->has('cost_level_8'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cost_level_8') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputName">Kelas 9<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" id="inputName" name="cost_level_9" placeholder="Kelas 9" required>
                                    @if ($errors->has('cost_level_9'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cost_level_9') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-sync"></i> Update</button>
                            <a type="submit" class="btn btn-dark" href="{{ route('semester.index') }}" style="float:right"><i class="fa fa-arrow-left"></i> Back</a>
                            </form>
                        </div>
                    </div>
                </div>
        </main>
      </div>
    </div>
</body>


</html>