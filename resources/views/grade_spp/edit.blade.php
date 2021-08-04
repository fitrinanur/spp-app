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
                            <h4>Data Nilai SPP</h4>
                        </div>
                        <div class="card-body">
                        <form action="{{ route('grade_spp.update', $grade_spp) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="inputState">Tingkatan</label>
                                <select id="inputState" class="form-control" name="level" readonly>
                                @foreach($levels as $key => $level)
                                    <option value= "{{$level }}" @if ($grade_spp->level ==
                                    $level) selected @endif readonly> {{ $level }} </option>
                                @endforeach
                                </select>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="inputName">Nilai SPP</label>
                                <input type="text" class="form-control" id="inputName" name="total" placeholder="Nilai SPP" value="{{ $grade_spp->total }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-sync"></i> Update</button>
                            <a type="submit" class="btn btn-dark" href="{{ route('grade_spp.index') }}" style="float:right"><i class="fa fa-arrow-left"></i> Back</a>
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<!-- <script src="../../assets/js/vendor/popper.min.js"></script> -->
<script src="../../dist/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace({ class: 'icon', 'width': 20  })
</script>
</body>


</html>