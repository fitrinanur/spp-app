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
                                <h3 class="card-title">Data Kelas</h3>
                                <a href="{{ route('class.create') }}" class="btn btn-sm btn-info" style="float:right;margin-bottom:10px;"><i class="fas fa-plus"></i> Tambah Data</a>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Level</th>
                                            <th colspan="3" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($lists)
                                        @foreach($lists as $key => $list)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $list->level }}</td>
                                            <td>
                                            <div class="btn-group" style="float:right;" >
                                                <a href="{{ route('class.edit', $list->id) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-pencil-alt"></i> Edit Kelas</a>
                                                <form action="{{ route('class.destroy', $list->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Anda yakin untuk menghapus?')">
                                                        <i class="fas fa-trash"></i> Hapus Kelas
                                                    </button>
                                                </form>
                                                <a href="{{ route('class.student.index', $list->id) }}" class="btn btn-sm btn-outline-info" > <i class="fas fa-list"></i>  Daftar Siswa</a>
                                            </div>
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