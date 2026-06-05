<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>配送アプリ：依頼検索</title>
        @viteReactRefresh
        @vite('resources/js/pages/shipment/search/index.jsx')

        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/shipment/search/index.css') }}">
    </head>
    <body>
        @include('common.header')
        <div id="shipment-search" data-search-url="{{ route('shipment.search.list') }}"></div>
    </body>
</html>
