@extends('layouts.main')

@section('content')
    Statistic:
    {{ print_r($data) }}

    <object id="er" data="http://www.eredmenyek.com" width="400" height="300" type="text/html"></object>

    <br>
    <button id="downloadButton" class="downloadButton" onclick="myFunction()">Letöltés!</button>

    <br>

    <script>


        function myFunction() {

                //var frameDocument = iframe1.contentDocument ? iframe1.contentDocument : iframe1.contentWindow.document;
                //var title = frameDocument.getElementsByTagName("h1")[0];
                console.log(iframe1);
                //console.log(iframe1.contentDocument);
                //console.log(document.getElementsByTagName("iframe")[0].contentWindow);

        }
    </script>
@endsection