<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    </head>
    <body>
        <p>{{ $greeting }}</p>
        <div class="button-area">
            <button onclick="location.href='/search'">配送状況確認</button>
            <button onclick="location.href='/registration'" class="middle-word">配送依頼</button>
        </div>
    </body>
</html>
