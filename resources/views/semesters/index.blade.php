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
                    <div class="col-md-10 offset-md-1">
                        <div class="card" style="margin-top:30px;">
                            <div class="card-body">
                                <h3 class="card-title">Data Nilai Sumbangan</h3>
                                <a href="{{ route('semester.create') }}" class="btn btn-sm btn-info"
                                    style="float:right;margin-bottom:10px;"> <i class="fas fa-plus"></i> Tambah Data</a>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun</th>
                                            <th>Semester</th>
                                            <th>Kelas 7</th>
                                            <th>Kelas 8</th>
                                            <th>Kelas 9</th>
                                            <th>Status</th>
                                            <th colspan="3" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($semesters as $key => $semester)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $semester->year }}</td>
                                            <td>@if($semester->semester == 1) Ganjil @else Genap @endif</td>
                                            <td>Rp. {{ number_format($semester->cost_level_7) }}</td>
                                            <td>Rp. {{ number_format($semester->cost_level_8) }}</td>
                                            <td>Rp. {{ number_format($semester->cost_level_9) }}</td>
                                            <td><form action="{{ route('semester_status.update', $semester->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" class="form-control-plaintext" id="status" name="status" value="{{ $semester->status }}">
                                                    @if($semester->status == 1)
                                                    <button class=  'btn btn-sm btn-success' type="submit" onclick="return confirm('Anda yakin untuk menonaktifkan semester ini?')">
                                                    <i class="fa fa-check-square"></i> Aktif
                                                    </button>
                                                    @else
                                                    <button class=  'btn btn-sm btn-dark' type="submit" onclick="return confirm('Anda yakin untuk mengaktifkan semester ini?')">
                                                    <i class="fa fa-times"></i> Tidak aktif
                                                    </button>
                                                    @endif
                                                </form>
                                            <td>
                                                <a href="{{ route('semester.edit', $semester->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('semester.destroy', $semester->id)}}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Anda yakin untuk menghapus data ini?')"
                                                        type="submit">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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