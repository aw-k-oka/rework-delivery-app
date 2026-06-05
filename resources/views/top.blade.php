<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>配送アプリ：顧客TOP</title>

        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    </head>
    <body>
        @include('common.header')
        <div class="button-area">
            <button onclick="location.href='{{ route('shipment.search.index') }}'">配送状況確認</button>
            <button onclick="location.href='{{ route('shipment.registration.index') }}'">配送依頼</button>
        </div>
    </body>
</html>
