<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       @include('head')
        <style>
            html, body {
                background-image: url({{ url('images/smp2.png') }});
                background-size : cover;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
                color:white;
            }

            .content {
                text-align: center;
                background-color: white;
                padding: 15px;
            }

            .title {
                font-size: 35px;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 10px;
            }
           
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a class="btn btn-outline-info" href="{{ url('/home') }}">Home</a>
                    @else
                        <a class="btn btn-outline-info" href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a class="btn btn-outline-info" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Sistem Pembayaran Sumbangan Pengembangan Pendidikan <br/>
                    SMPN Baturetno 2 Wonogiri
                </div>
                <div class="">
                    <a class="btn btn-outline-info" href="{{ route('user_payment.create') }}">Upload Bukti Pembayaran</a>
                    <a class="btn btn-outline-info" href="{{ route('user.check_spp') }}">Check Status Pembayaran</a>
                    <a class="btn btn-outline-info" href="{{ route('user_payment.guide') }}">Panduan Pembayaran</a>
                </div>
            </div>
        </div>
        @include('script')
    </body>
</html>
