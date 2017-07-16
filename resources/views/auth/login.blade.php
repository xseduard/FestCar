<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Iniciar sesión</title>

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

     <!-- Animsitun -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/css/animsition.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css">

    {!! Html::style('/css/login.css') !!}
    {!! Html::style('/css/login_v2.css') !!}    

</head>
<body class="animsition page-login-v2 layout-full page-dark" >
<div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out"   >
   <div class="page-content">
     <div class="page-brand-info">
       <div class="brand">
         
        <a href="{{ url('/home') }}"><img src="{{ asset('/multimedia/web/logo-white.png') }}"></a>        
   
         <h2 class="brand-text font-size-40"></h2>
       </div>
       <p class="font-size-20"></p>
     </div>
     <div class="page-login-main">
       <div class="brand hidden-md-up">
        <!--<img class="brand-img" src="" alt="...">-->
        <div class="login-logo">
        <a href="{{ url('/home') }}" ><b style="color: #00B0A3 !important">Fest</b>Transeba</a>
    </div>
        <h3 class="brand-text font-size-40"></h3>
      </div>
      <h3 class="font-size-24">Acceder</h3>
      <p>Ingrese sus credenciales.</p>
      <form method="post" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Usuario">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Contraseña" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

            </div>
            
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat ">Iniciar</button>
                </div>
                <!-- /.col -->
            </div>
       <div class="row">
                <div class="col-xs-12">                
                   <div class="checkbox icheck">
                     <input type="checkbox" name="remember">
                     <label for="inputCheckbox">Recuerdame</label>
                    </div>
                    <a class="" href="{{ url('/password/reset') }}">¿Olvidó su contraseña? </a>
                </div>
                
            </div>
        </form>
        <p>No tienes cuenta? <a href="{{ url('/register') }}" class="text-center">Registrate</a> </p>
            

    <footer class="page-copyright">
        <p>FestCar <a href="#" class="text-color-5"   > Design By xsEduard </a> </p>
        <p>Copyright © 2017. Todos los derechos reservados.</p>
        
      </footer>

    </div>


     </div>
  </div>
</div>
<!-- /.login-box -->

<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.3/js/app.min.js"></script>

  <!-- Animsition -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js"></script>

<!--recopy -->
<script src="https://www.marcoguglie.it/Codepen/AnimatedHeaderBg/demo-1/js/EasePack.min.js"></script>
<script src="https://www.marcoguglie.it/Codepen/AnimatedHeaderBg/demo-1/js/rAF.js"></script>
<script src="https://www.marcoguglie.it/Codepen/AnimatedHeaderBg/demo-1/js/TweenLite.min.js"></script>

    <!-- Animsition ini -->
    <script type="text/javascript">
        $(document).ready(function() {
          $(".animsition").animsition({
            inClass: 'fade-in',
            outClass: 'fade-out',
            inDuration: 1500,
            outDuration: 800,
            linkElement: '.animsition-link',
            // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
            loading: true,
            loadingParentElement: 'body', //animsition wrapper element
            loadingClass: 'animsition-loading',
            loadingInner: '', // e.g '<img src="loading.svg" />'
            timeout: false,
            timeoutCountdown: 5000,
            onLoadEvent: true,
            browser: [ 'animation-duration', '-webkit-animation-duration'],
            // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
            // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
            overlay : false,
            overlayClass : 'animsition-overlay-slide',
            overlayParentElement : 'body',
            transition: function(url){ window.location.href = url; }
          });

          $('input').iCheck({
              checkboxClass: 'icheckbox_minimal-blue',
              radioClass: 'iradio_minimal-blue',
              increaseArea: '20%' // optional
            });

        });


    </script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

</body>
</html>
