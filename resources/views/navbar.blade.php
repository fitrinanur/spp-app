<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('student.index') }}">
                    <span data-feather="users"></span>
                    Data Siswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('class.index') }}">
                    <span data-feather="clipboard"></span>
                    Data Kelas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('payment.index') }}">
                    <span data-feather="clipboard"></span>
                    Data Pembayaran
                </a>
                <a class="nav-link" href="{{ route('grade_spp.index') }}">
                    <span data-feather="clipboard"></span>
                    Data Nilai SPP
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('payment_confirmation.index') }}">
                    <span data-feather="archive"></span>
                    Konfirmasi Pembayaran
                </a>
            </li>
        </ul>
    </div>
</nav>
