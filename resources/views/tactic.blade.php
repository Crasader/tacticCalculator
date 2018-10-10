@extends('layouts.main')

@section('content')

    {{ $data['winRound'] }}
    <br>{{ $data['lostRound'] }}
    <br>{{ $data['proportion'] }}
    <div id="app" class="tactic-app">
        <tactic-table></tactic-table>
        <basic-table basic-data="{{$data['basicData']}}"></basic-table>
    </div>

    <script type="text/javascript" src="js/app.js"></script>
@endsection