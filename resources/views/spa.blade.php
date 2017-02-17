<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/app.css" rel="stylesheet">
        <title>Jism</title>
    </head>
    <body>
        <div id="jism-app" style="width:480px; margin:0 auto;"><router-view></router-view></div>
    </body>
    <script src="/js/app.js"></script>
</html>
