<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-4 offset-md-4 mt-5">
                <div class="card text-white bg-info mb-3">
                    <div class="card-header">
                        <h5>Cek Status Pembayaran SPP Siswa</h5>
                    </div>
                    <div class="card-body">
                    
                    @include('flash::message')
                        <form action="{{ route('user.do_check_spp') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Masukkan NISN</label>
                                <input type="text" class="form-control" id="nisn"  name="nisn"placeholder="NISN">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Masukkan Nomor Handphone Terdaftar</label>
                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Nomor HP">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <p>Kembali ke <a href="{{ url('/') }}" type="button" class="btn btn-link"><i>Halaman Utama</i></a></p>
                        </form>
                    </div>
                </div> 
            </main>
        </div>
    </div>
@include('script')
</body>
</html>