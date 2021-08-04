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
                                <h3 class="card-title">Data Nilai SPP</h3>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tingkatan Kelas</th>
                                            <th>Nilai SPP</th>
                                            <th colspan="3" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($grade_spps as $key => $grade_spp)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $grade_spp->level }}</td>
                                            <td>Rp. {{ number_format($grade_spp->total) }}</td>
                                            <td>
                                                <a href="{{ route('grade_spp.edit', $grade_spp->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
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