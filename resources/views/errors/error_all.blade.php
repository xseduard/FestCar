<!DOCTYPE html>
<html>
    <head>
        <title>{!! $code !!} Error | FestCar</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        {!! Html::style('/css/http_errors.css') !!}

    </head>
    <body>
        <div class="container">
            <div class="content">
                {{-- <img src="{{ asset('/multimedia/web/logo-error.jpg') }}"> --}}

                <div class="title">{!! $code !!}</div>
                <h1>{!! $msg !!}</h3>                
                @if($code >= 500)                   

                    <h2>{!! $date->format('d/F/Y  h:i:s A e') !!} </h2>

                @endif
                
                <div class='btn-cont'>
                  <a class='btn' href="{{ url('/') }}">
                    Continuar
                    <span class='line-1'></span>
                    <span class='line-2'></span>
                    <span class='line-3'></span>
                    <span class='line-4'></span>
                  </a>
                </div> 
            </div>
        </div>
    </body>
</html>
