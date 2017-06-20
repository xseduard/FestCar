<html>
    <head>
        <title>Sesión ha Expirado | FestCar.</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <style>
            html, body {
                height: 100%;
            }
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
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
                font-size: 72px;
                margin-bottom: 40px;
            }
            img {
                box-shadow: 1px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">

                <img src="{{ asset('/multimedia/web/logo-error.jpg') }}">
                <div class="title">Tu Sesión ha expirado.</div>
                <h3>Para continuar click <a href="http://fury.transeba.com/home">Aquí</a></h3>
            </div>
        </div>
    </body>
</html>