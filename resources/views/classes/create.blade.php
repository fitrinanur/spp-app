<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
@include('topnav')
    <div class="container-fluid">
      <div class="row">
        <main role="main" class="class="col-sm-10 offset-1">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Kelas</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('class.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="inputState">Tingkatan</label>
                                <select id="inputState" class="form-control {{ $errors->has('level') ? ' is-invalid' : '' }}" name="level">
                                    @foreach($levels as $key => $level)
                                    <option value= "{{$level }}"> {{ $level }} </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('level'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('level') }}</strong>
                                </span>
                                @endif
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputName">Nama Kelas</label>
                                <input type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" id="inputName" name="name" placeholder="Nama Kelas">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a type="submit" class="btn btn-dark" href="{{ route('class.index') }}" style="float:right">Back</a>
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