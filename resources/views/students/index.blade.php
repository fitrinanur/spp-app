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
                                <h3 class="card-title">Data Siswa</h3>
                                <form class="row gy-2 gx-3 align-items-center" style="float:left" method="get" action="{{ route('student.index') }}">
                                @csrf
                                    <div class="col-auto">
                                        <input type="test" class="form-control" id="autoSizingInput" placeholder="Nama Siswa" name="search">
                                    </div>
                                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                                </form>
                                <a class="btn btn-sm btn-success" href="{{ route('student.export') }}"
                                    style="float:right;margin:0px 0px 10px 5px;"> <i class="fa fa-file-download"></i>
                                    Export</a>
                                <a href="{{ route('student.create') }}" class="btn btn-sm btn-info"
                                    style="float:right;margin-bottom:10px;"> <i class="fas fa-plus"></i> Tambah Data</a>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Nama Wali</th>
                                            <th>No HP Wali</th>
                                            <th>Pekerjaan Wali</th>
                                            <th>Agama</th>
                                            <th colspan="3" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($lists)
                                        @foreach($lists as $key => $list)
                                        @php
                                        $add = str_replace('_#', ' ', $list->address);
                                        @endphp
                                        <tr>
                                            <td>{{ $list->nisn }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $add }}</td>
                                            <td>{{ $list->wali_name }}</td>
                                            <td>{{ $list->wali_number }}</td>
                                            <td>{{ $list->wali_profession }}</td>
                                            <td>{{ $list->religion }}</td>
                                            <td>
                                                <a href="{{ route('student.edit', $list->nisn)}}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('student.destroy', $list->nisn)}}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Anda yakin untuk menghapus?')"
                                                        type="submit">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="3" class="text-danger">Data tidak ditemukan.</td>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>
                                <div class="pagination" style="float:right">
                                    {{ $lists->links() }}
                                </div>
                                
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
