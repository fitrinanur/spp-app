<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    @include('topnav')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-sm-12">
                @include('flash::message')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="margin-top:30px;">
                            <div class="card-body">
                                <h3 class="card-title">Data Pembayaran</h3>
                                <form class="row gy-2 gx-3 align-items-center" style="float:left" method="get"
                                    action="{{ route('payment.index') }}">
                                    @csrf
                                    <div class="col-auto">
                                        <input type="test" class="form-control" id="autoSizingInput"
                                            placeholder="Nama Siswa" name="search">
                                    </div>
                                    <button class="btn btn-outline-success" type="submit"><i
                                            class="fas fa-search"></i></button>
                                </form>
                                <a href="{{ route('payment.create') }}" class="btn btn-sm btn-info"
                                    style="float:right;margin-bottom:10px;"><i class="fas fa-plus"></i> Tambah Data</a>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>No HP</th>
                                            <th>Bukti Bayar</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Semester</th>
                                            <th>Tahun</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Terakhir diubah</th>
                                            <th colspan="3" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($lists)
                                        @foreach($lists as $list)
                                        <tr>
                                            
                                            <td>{{ $list->nisn }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $list->wali_number }}</td>
                                            <td><a href="{{ route('get_image', $list->id) }}" target="_blank">Preview
                                                </a></td>
                                            @if($list->status == 1)
                                            <td>Sudah Membayar</td>
                                            @else
                                            <td>Belum Diverifikasi Admin</td>
                                            @endif
                                            <td>{{ $list->description }}</td>
                                            <td>
                                            @if($list->semester == 1)
                                                Ganjil
                                            @else
                                                Genap
                                            @endif                                        
                                            </td>
                                            <td>{{ $list->year_payment }}</td>
                                            <td>{{ $list->created_at }}</td>
                                            <td>{{ $list->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('payment.edit', $list->id)}}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{ route('payment.destroy', $list->id)}}" method="post">
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
