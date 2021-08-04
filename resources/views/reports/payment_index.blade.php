<!DOCTYPE html>
<html lang="en">
@include('head')

<body>
    @include('topnav')
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-lg-12">
                @include('flash::message')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="margin:30px;padding:20px;">
                            <div class="card-header">
                                <div class="title">
                                    <h5>Export Laporan Pembayaran</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('reports_payments.export') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputName">Kelas</label>
                                            <select id="class" class="form-control" name="class"
                                                required>
                                                <option value="all"> Semua Kelas </option>
                                                @foreach($classes as $class)
                                                <option value="{{ $class->id }}"> {{ $class->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputName">Bulan Pembayaran</label>
                                            <select id="month_payment" class="form-control" name="month_payment"
                                                required>
                                                @foreach($months as $key => $month)
                                                <option value="{{ $key }}"> {{ $month }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputName">Periode</label>
                                            <select id="year_payment" class="form-control" name="year_payment" required>
                                                @foreach($years as $key => $year)
                                                <option value="{{ $year }}"> {{$year}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputName">Status</label>
                                            <select id="status" class="form-control" name="status" required>
                                                @foreach($statuses as $key => $status)
                                                <option value="{{ $key }}"> {{$status}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-file-download"></i> Export</button>
                                </form>
                            </div>
                        </div>
                    </div>
            </main>
        </div>
    </div>
</body>
@include('script')

</html>
