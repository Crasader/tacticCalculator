@extends('layouts.main')

@section('content')
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

        <modal-template :show="show" @close="show=false"></modal-template>
        <button id="show" @click="show=true" class="button blue">Alap adatok módosítása</button>

    </div>

    <script type="text/javascript" src="js/app.js"></script>
@endsection