<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>配送アプリ：依頼検索結果</title>
        @viteReactRefresh
        @vite('resources/js/pages/shipment/search/result.jsx')

        <link rel="stylesheet" href="{{ asset('css/shipment/search/result.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
    </head>
    <body>
        @include('common.header')
        <section
            id="search-result"
            data-shipment='@json($shipment)'
            data-back-url="{{ route('shipment.search.index') }}"
            data-user='@json($user)'
            @auth('web')
            data-return-url="{{ route('shipment.status.backToOffice') }}"
            data-deliver-url="{{ route('shipment.status.deliver') }}"
            data-complete-url="{{ route('shipment.status.complete') }}"
            data-csrf-token="{{ csrf_token() }}"
            @endauth
        ></section>
    </body>
</html>
