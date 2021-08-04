<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    @include('topnav')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-sm-10 offset-1">
                <div class="container">
                    <div class="card"style="margin:50px" >
                    <div class="card-header">
                      <h5>Selamat datang dihalaman admin, {{ auth()->user()->name }} !</h5>
                    </div>
                        <div class="row" style="padding:10px;margin:10px">
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <p style="text-align:center;color:gray;font-size:12px;">Jumlah Data Siswa</p>
                                        <h3 style="text-align:center"><a><i
                                                    class="fa fa-home"></i>{{ $students->count() }}</a></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <p style="text-align:center;color:gray;font-size:12px;">Jumlah Data Kelas </p>
                                        <h3 style="text-align:center"><a><i class="fa fa-book"></i>
                                                {{ $classes->count() }}</a></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <p style="text-align:center;color:gray;font-size:11px;">Jumlah Data Pembayaran</p>
                                        <h3 style="text-align:center"><a><i
                                                    class="fa fa-file"></i> {{ $payments->count() }} </a></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <p style="text-align:center;color:gray;font-size:11px;">Verifikasi Pembayaran</p>
                                        <h3 style="text-align:center"><a><i
                                                    class="fa fa-file"></i> {{ $confirmation_payments->count() }} </a></h3>
                                    </div>
                                </div>
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
