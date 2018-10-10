@extends('layouts.main')

@section('content')

    <div id="app" class="tactic-app">
        <tactic-table tactic-data="{{ $data['tacticData'] }}"></tactic-table>
        <basic-table basic-data="{{ $data['basicData'] }}"></basic-table>
    </div>

    <script type="text/javascript" src="js/app.js"></script>
@endsection