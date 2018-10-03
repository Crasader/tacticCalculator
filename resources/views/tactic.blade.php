@extends('layouts.main')

@section('content')
    <div id="app" class="tactic-app">
            <basic-table basic-data="{{$data['basicData']}}"></basic-table>
    </div>

    <script type="text/javascript" src="js/app.js"></script>
@endsection