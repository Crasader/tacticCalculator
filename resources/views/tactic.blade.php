<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Laravel</title>
    </head>
    <body>

    asdasd
    {{ print_r($data) }}

    <div>
        Alap adatok:
        <div class="start-money" name="">{{ $data['basicData']['startMoney'] ?? '' }}</div>
        <div class="target-money">{{ $data['basicData']['targetMoney'] ?? '' }}</div>
        <div class="odds">{{ $data['basicData']['odds'] ?? ''  }}</div>
        <div class="bet-step">{{ $data['basicData']['betSteps'] ?? '' }}</div>
        <a href="{{ route('api.basic-data.index') }}" target="_blank">
            <button class="change-data">Change basic datas</button>
        </a>
    </div>





    <!-- app -->
    <div id="app">

        <example-component :title="'Teszt Title'"></example-component>


        <modal-template :show="show" @close="show = false"></modal-template>

        <button id="show" @click="show = true">New Post</button>

    </div>
    bbb
abbb
    <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>
