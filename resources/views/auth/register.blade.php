<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registrar cuenta</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/css/AdminLTE.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition register-page" style=" 
background: #0095d8;
background: -moz-linear-gradient(45deg,  #0095d8 0%, #00b0a3 100%);
background: -webkit-linear-gradient(45deg,  #0095d8 0%,#00b0a3 100%);
background: linear-gradient(45deg,  #0095d8 0%,#00b0a3 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0095d8', endColorstr='#00b0a3',GradientType=1 );

 ">
 <section class="wow fadeIn" data-wow-duration="2s">
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/home') }}" style="color: white;"><b>Fest</b>Transeba</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Registrar nueva cuenta</p>

        <form method="post" action="{{ url('/register') }}">

            {!! csrf_field() !!}

            <div class="form-group has-feedback{{ $errors->has('cedula') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="cedula" value="{{ old('cedula') }}" placeholder="Documento de identificación">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('cedula'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cedula') }}</strong>
                    </span>
                @endif
            </div>
             <div class="form-group has-feedback{{ $errors->has('nombres') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="nombres" value="{{ old('nombres') }}" placeholder="Nombres">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('nombres'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombres') }}</strong>
                    </span>
                @endif
            </div>
             <div class="form-group has-feedback{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" placeholder="Apellidos">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('apellidos'))
                    <span class="help-block">
                        <strong>{{ $errors->first('apellidos') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password" placeholder="Contraseña">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirme Contraseña">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Acepto los  <a href="#">terminos y condiciones</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Registrarte</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        ¿Tienes una cuenta? <a href="{{ url('/login') }}" class="text-center">Entrar</a>
    </div>
    <!-- /.form-box -->
</div>
</section>
<!-- /.register-box -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/js/app.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
    console.log( "Transeba ready!" );
    new WOW().init();
});
   
</script>
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
</html>
