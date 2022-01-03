<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
@include('topnav')
    <div class="container-fluid">
      <div class="row">
        <main role="main" class="col-sm-10 offset-1">
        @include('flash::message') 
                <div class="col-md-10 offset-1" style="margin-top:30px">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Kelas</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('class.update', $class) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="inputState">Tingkatan</label>
                                <select id="inputState" class="form-control" name="level" readonly required>
                                    @foreach($levels as $key => $level)
                                    <option value="{{$level}}" @if ($class->level ==
                                    $level) selected @endif> {{$level}} </option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputName">Nama</label>
                                <input type="text" class="form-control" id="inputName" name="name" placeholder="Nama" value="{{ $class->name }}" required>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                                <input type="hidden" class="form-control" id="inputName" name="id" value="{{ $class->id }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-sync"></i> Update</button>
                            <a type="submit" class="btn btn-dark" href="{{ route('class.index') }}" style="float:right"><i class="fa fa-arrow-left"></i> Back</a>
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