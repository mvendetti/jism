<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="/css/app.css" rel="stylesheet">
        <title>Jism</title>
    </head>
    <body>
        <div id="jism-app"><router-view></router-view></div>
    </body>
    <script src="/js/app.js"></script>
</html>
