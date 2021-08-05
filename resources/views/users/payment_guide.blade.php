<!DOCTYPE html>
<html lang="en">
@include('head')
<style type="text/css">
    html,
    body {
        height: 100%;
    }

    .header {
        margin-top: 0px !important;
        background-image: url({{ url('images/smp2.png') }});
        background-size: cover;
        background-position: center;
        height: 100%;
    }

    .header-text {
        padding: 80px 50px 220px 40px;
        margin: 0px 0px 0px 0px !important;
        color: #5d5d5d;
    }

    .header-text h4  {
        background-color: #fff;
        padding: 5px;
        margin: 0px !important;
    }
    .header-text p  {
        background-color: #fff;
        padding: 5px;
        margin: 0px !important;
    }

    .bank-acccount{
        text-align : center;
    }

    .footer{
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #343A40;
        color: white;
        padding: 3px;
    }

</style>

<body>
    <div class="container-row">
        <div class="header clearfix">
            <nav>
                <ul class="navbar navbar-dark bg-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{ url('/') }}">SMP BATURETNO 2</a>
                    </div>
            </nav>
        </div>
        <div class="header">
            <div></div>
            <div class="header-text">
                <h4 class="display-3">SMP Negeri Baturetno 2</h4>
                <p class="lead">Selamat datang di Sistem SPP SMP Baturetno 2. Sistem memudahkan untuk konfirmasi pembayaran SPP.</p>
            </div>
        </div>
        <p><img src=""/></p>
        <div class="container-row bank-acccount">
            <div class="row" style="padding:10px;margin:10px">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <p style="text-align:center;color:gray;font-size:16px;"><i class="fa fa-credit-card"></i> BSI</p>
                            <p style="text-align:center">
                                Info Rekening :<br/> <span style="color:blue" > 45212122323 </span><br/>
                                <span style="color:blue" >SMPN Baturetno 2</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <p style="text-align:center;color:gray;font-size:16px;"><i class="fa fa-credit-card"></i> BCA </p>
                            <p style="text-align:center">
                                Info Rekening :<br/> <span style="color:blue" > 45212122323 </span><br/>
                                <span style="color:blue" >SMPN Baturetno 2</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <p style="text-align:center;color:gray;font-size:16px;"><i class="fa fa-credit-card"></i> BNI</p>
                            <p style="text-align:center">
                                Info Rekening :<br/> <span style="color:blue" > 45212122323 </span><br/>
                                <span style="color:blue" >SMPN Baturetno 2</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <p style="text-align:center;color:gray;font-size:16px;"><i class="fa fa-credit-card"></i> BRI</p>
                            <p style="text-align:center">
                                Info Rekening :<br/> <span style="color:blue" > 45212122323 </span><br/>
                                <span style="color:blue" >SMPN Baturetno 2</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tutorial-payment">
            <div class="card">
                <div class="card-body" style="margin:10px">
                    <h5>Tata Cara Pembayaran Melalui Transfer Bank</h5>
                    <ol>
                        <li>Pilih Salah Satu Rekening Diatas</li>
                        <li>Transfer Ke Salah Satu Rekening Bank yang Anda Pilih</li>
                        <li>Foto Bukti Pembayaran</li>
                        <li>Pilih "Menu Upload Bukti Pembayaran" di Halaman Utama</li>
                        <li>Admin Akan Konfirmasi Bukti Pembayaran</li>
                        <li>Status Pembayaran akan terupdate jika Admin Telah Melakukan Verifikasi Pembayaran</li>
                    </ol>
                    <p>*Pastikan foto bukti pembayaran terlihat dengan jelas</p>
                </div>
            </div>
        </div>

        <footer class="footer">
            <p>© SSPPESPEROBRO 2021</p>
        </footer>

    </div> <!-- /container -->

    @include('script')
</body>

</html>
