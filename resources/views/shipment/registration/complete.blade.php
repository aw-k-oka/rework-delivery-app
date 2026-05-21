<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @viteReactRefresh
        @vite('resources/js/pages/shipment/registration/complete.jsx')
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
    </head>
    <body>
        @include('common.header')
        <div id="complete-message" data-tracking-number="{{ $trackingNumber }}"></div>
    </body>
</html>
