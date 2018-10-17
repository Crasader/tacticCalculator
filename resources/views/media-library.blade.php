<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500,700,400italic|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/vue-material@beta/dist/vue-material.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-material@beta/dist/theme/default.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Media Library</title>
</head>
<body>
    Media Library:
    <div id="app" class="media-app">
        <media-component-upload></media-component-upload>
        <media-component-list></media-component-list>
    </div>

    <style>
        .media-app {
            display: block;
            width: 100%;
            margin: auto;
            text-align: center;
        }
    </style>
    <script type="text/javascript" src="js/app.js"></script>
</body>
</html>
