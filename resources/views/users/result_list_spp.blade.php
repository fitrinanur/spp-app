<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-6 offset-md-3 mt-5" >
                <div class="card">
                    <div class="card-body">
                        <div class="profile" style="float:left">
                            <p>Nama: {{ $name }}</p>
                            <p>NISN: {{ $nisn }}</p>
                        </div>
                        <div class="profile-2" style="float:right">
                            <p></p>
                            <p>Tahun Periode Pembayaran: {{ $periode }}</p>
                            
                        </div>
                        <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($valid_months as $m)
                            @foreach($query as $q)
                            <tr>
                                
                                <td>{{ $m }}</td>
                                @if($q->status == 1)
                                <td>Lunas</td>
                                @else
                                <td>Belum Lunas</td>
                                @endif
                            </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                        </table>

                    </div>
                </div> 
            </main>
        </div>
    </div>
@include('script')
</body>
</html>