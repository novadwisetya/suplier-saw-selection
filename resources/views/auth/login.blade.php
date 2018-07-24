@extends('la.layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<body style="overflow-y: hidden;">
    <div class="row">
        <div class="col-lg-7" style="height:900px;background-image: url('{{ url('/la-assets/img/bg-login-blue.jpg') }}');">

        </div> 
        <div class="col-lg-5" style="height:900px;background-color: white;">
                <div class="login-box" style="margin-top: 20px">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Gagal! </strong> Email atau password salah.<br><br>
                    </div>
                @endif
                <div class="login-box-body">
                    <div class="login-logo">
                        <a href="#"><img src="{{ url('/la-assets/img/logo_perusahaan.jpg') }}" style="height: 100px;"></a>
                    </div>

                    <p style="text-align: center;margin-bottom: 20px;margin-top: 20px;display: block;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 30px;color: #4b2354;line-height: 1.2;text-align: left;">
                        <b>Selamat Datang</b></br>
                    </p>
                    <p style="margin-bottom: 40px;text-align: center;display: block;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size: 18px;color: #4b2354;line-height: 1.2;text-align: left;">
                        Silakan masukan email dan password untuk masuk!
                    </p>
                    <form action="{{ url('/login') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" placeholder="Email" name="email" style="border-radius: 20px" />
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="Password" name="password" style="border-radius: 20px" />
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius: 20px;">Masuk</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    @include('la.layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
