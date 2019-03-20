<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<?php
header("Access-Control-Allow-Origin: *");
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/imagens/icon.png">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">

    <title>We love SDN</title>

</head>
    <body>


                <div id="app">

                  <navbar></navbar>

                </div>
                <script src="{{ asset('js/app.js') }}"></script>
            </div>
        </div>
    </body>
</html>
