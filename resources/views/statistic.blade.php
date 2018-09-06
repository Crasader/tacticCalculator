<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script
                src="https://code.jquery.com/jquery-3.3.1.js"
                integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
                crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    Statistic:
    {{ print_r($data) }}

    <object id="er" data="http://www.eredmenyek.com" width="400" height="300" type="text/html"></object>

    <br>
    <button id="downloadButton" class="downloadButton" onclick="myFunction()">Letöltés!</button>

    <br>
    </body>

    <script>

        var iframe1 = document.getElementById('er').innerD;

        function myFunction() {

                //var frameDocument = iframe1.contentDocument ? iframe1.contentDocument : iframe1.contentWindow.document;
                //var title = frameDocument.getElementsByTagName("h1")[0];
                console.log(iframe1);
                //console.log(iframe1.contentDocument);
                //console.log(document.getElementsByTagName("iframe")[0].contentWindow);

        }
    </script>
</html>
