<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

    </head>
    <body>
        <h1>{{ $title }}</h1>

        <p>配送番号：{{ $trackingNumber }}にて承りました</p>
    </body>
</html>
