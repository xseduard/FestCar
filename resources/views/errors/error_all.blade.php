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
                color: black;
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

            /* BTN */

            .btn-cont {
              text-align: center;
              margin-top: 30px;
            }
            .btn-cont .btn {
              position: relative;
              padding: 20px 70px;
              border: 1px solid black;
              color: black;
              text-decoration: none;
              font-size: 1.125em;
              font-family: 'Open Sans', sans-serif;
              text-transform: uppercase;
              letter-spacing: 2px;
              -webkit-font-smoothing: antialiased;
            }
            .btn-cont .btn:hover {
              border: none;
            }
            .btn-cont .btn:hover .line-1 {
              -webkit-animation: move1 1500ms infinite ease;
                      animation: move1 1500ms infinite ease;
            }
            .btn-cont .btn:hover .line-2 {
              -webkit-animation: move2 1500ms infinite ease;
                      animation: move2 1500ms infinite ease;
            }
            .btn-cont .btn:hover .line-3 {
              -webkit-animation: move3 1500ms infinite ease;
                      animation: move3 1500ms infinite ease;
            }
            .btn-cont .btn:hover .line-4 {
              -webkit-animation: move4 1500ms infinite ease;
                      animation: move4 1500ms infinite ease;
            }
            .btn-cont .line-1 {
              content: "";
              display: block;
              position: absolute;
              width: 1px;
              background-color: black;
              left: 0;
              bottom: 0;
            }
            .btn-cont .line-2 {
              content: "";
              display: block;
              position: absolute;
              height: 1px;
              background-color: black;
              left: 0;
              top: 0;
            }
            .btn-cont .line-3 {
              content: "";
              display: block;
              position: absolute;
              width: 1px;
              background-color: black;
              right: 0;
              top: 0;
            }
            .btn-cont .line-4 {
              content: "";
              display: block;
              position: absolute;
              height: 1px;
              background-color: black;
              right: 0;
              bottom: 0;
            }

            @-webkit-keyframes move1 {
              0% {
                height: 100%;
                bottom: 0;
              }
              54% {
                height: 0;
                bottom: 100%;
              }
              55% {
                height: 0;
                bottom: 0;
              }
              100% {
                height: 100%;
                bottom: 0;
              }
            }

            @keyframes move1 {
              0% {
                height: 100%;
                bottom: 0;
              }
              54% {
                height: 0;
                bottom: 100%;
              }
              55% {
                height: 0;
                bottom: 0;
              }
              100% {
                height: 100%;
                bottom: 0;
              }
            }
            @-webkit-keyframes move2 {
              0% {
                width: 0;
                left: 0;
              }
              50% {
                width: 100%;
                left: 0;
              }
              100% {
                width: 0;
                left: 100%;
              }
            }
            @keyframes move2 {
              0% {
                width: 0;
                left: 0;
              }
              50% {
                width: 100%;
                left: 0;
              }
              100% {
                width: 0;
                left: 100%;
              }
            }
            @-webkit-keyframes move3 {
              0% {
                height: 100%;
                top: 0;
              }
              54% {
                height: 0;
                top: 100%;
              }
              55% {
                height: 0;
                top: 0;
              }
              100% {
                height: 100%;
                top: 0;
              }
            }
            @keyframes move3 {
              0% {
                height: 100%;
                top: 0;
              }
              54% {
                height: 0;
                top: 100%;
              }
              55% {
                height: 0;
                top: 0;
              }
              100% {
                height: 100%;
                top: 0;
              }
            }
            @-webkit-keyframes move4 {
              0% {
                width: 0;
                right: 0;
              }
              55% {
                width: 100%;
                right: 0;
              }
              100% {
                width: 0;
                right: 100%;
              }
            }
            @keyframes move4 {
              0% {
                width: 0;
                right: 0;
              }
              55% {
                width: 100%;
                right: 0;
              }
              100% {
                width: 0;
                right: 100%;
              }
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

                    <h2>{!! $date->format('d/F/Y  h:i:s A e') !!} </h2>

                @endif
                
                <div class='btn-cont'>
                  <a class='btn' href='http://fury.transeba.com/home'>
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
