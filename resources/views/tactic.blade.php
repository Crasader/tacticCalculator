<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>

    asdasd
    {{ print_r($data) }}

    <div>
        Alap adatok:
        <div class="start-money">{{ $data['basicData']['startMoney'] }}</div>
        <div class="target-money">{{ $data['basicData']['targetMoney'] }}</div>
        <div class="odds">{{ $data['basicData']['odds'] }}</div>
        <div class="bet-step">{{ $data['basicData']['betSteps'] }}</div>
        <a href="{{ route('basic-data') }}" target="_blank">
            <button class="change-data">Change basic datas</button>
        </a>
    </div>

    </body>
</html>
