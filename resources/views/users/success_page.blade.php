<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="card">
                    <div class="card-body">
                    @include('flash::message')
                    <p>Pembayaran akan diverifikasi oleh Admin, status pembayaran akan berubah setelah verifikasi berhasil. Terimakasih<br/>
                    Kembali ke <a href="{{ url('/') }}" type="button" class="btn btn-link"><italic>Halaman Utama</italic></a></p>
                    </div>
                </div> 
            </main>
        </div>
    </div>
@include('script')
</body>
</html>