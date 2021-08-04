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
                                <h5 style="float:left;"class="card-title">Daftar Pembayaran belum di verifikasi</h5>
                                <form class="row gy-2 gx-3 align-items-center" style="float:right;margin-bottom:5px;" method="get"
                                    action="{{ route('payment_confirmation.index') }}">
                                    @csrf
                                    <div class="col-auto">
                                        <input type="test" class="form-control" id="autoSizingInput"
                                            placeholder="Nama Siswa" name="search">
                                    </div>
                                    <button class="btn btn-outline-success" type="submit"><i
                                            class="fas fa-search"></i></button>
                                </form>
                                <table class="table table-striped data-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>No HP</th>
                                            <th>Bukti Bayar</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Bayar</th>
                                            <th colspan="3" style="text-align:center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($lists)
                                        @foreach($lists as $key => $list)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{ $list->nisn }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>{{ $list->wali_number }}</td>
                                            <td><a href="{{ route('get_image', $list->id) }}" target="_blank">Preview </a></td>
                                            <td>{{$list->description}}</td>
                                            <td>{{$list->created_at}}</td>
                                            <td>
                                                <form action="{{ route('payment_confirmation.update', $list->id)}}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" class="form-control-plaintext" id="status" name="status" value="1">
                                                    <button class="btn btn-sm btn-success" type="submit" onclick="return confirm('Anda yakin untuk merubah status pembayaran?')">
                                                    <i class="fas fa-check-square"></i> Setujui
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
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  
</body>
@include('script')

</html>
