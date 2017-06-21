<!DOCTYPE html>
<html>
    <head>
        <title>{!! $code !!} Error | FestCar</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                /*color: #B0BEC5; */
                color: #8e989d;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 200px;
                margin-bottom: 10px;
            }
            html { 
                  background: url({{ asset('/multimedia/web/background-error-2.jpg') }}) no-repeat center center fixed; 
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover;
                  background-size: cover;
                }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <!--<img src="{{ asset('/multimedia/web/logo-error.jpg') }}"> -->

                <div class="title">{!! $code !!}</div>
                <h1>{!! $msg !!}</h3>                
                @if($code >= 500)                   

                    <h2>{!! $date->format('d/F/Y  h:i:s A e') !!} - </h2>

                @endif


                <h3><a href="http://fury.transeba.com/home">Continuar</a></h3>  
            </div>
        </div>
    </body>
</html>
