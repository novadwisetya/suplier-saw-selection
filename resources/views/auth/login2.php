<body class="hold-transition login-page">
    <div class="login-box">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="login-box-body">
        <div class="login-logo">
            <a href="#"><img src="{{ url('/la-assets/img/logo_perusahaan.jpg') }}" style="height: 100px;"></a>
        </div>

        <p style="text-align: center;margin-bottom: 40px;margin-top: 20px;display: block;font-family:SourceSansPro-Bold;font-size: 30px;color: #4b2354;line-height: 1.2;text-align: center;">
            <b>Selamat Datang!</b></br>
        </p>
        <form action="{{ url('/login') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                </div>
            </div>
        </form>
</div>
</div>