<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        <h1>{{ $title }}</h1>
        <button>配送状況確認</button>
        <br><br>
        <button onclick="location.href='/registration'">配送依頼</button>
    </body>
</html>
