<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>配送アプリ：依頼登録</title>
        @viteReactRefresh
        @vite('resources/js/pages/shipment/registration/index.jsx')

        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/shipment/registration/index.css') }}">
    </head>
    <body>
        @include('common.header')
        <div
            id="registration-form"
            data-confirm-url="{{ route('shipment.registration.confirm') }}"
            data-csrf-token="{{ csrf_token() }}"
            data-max-name-length="{{ $maxNameLength }}"
            data-max-address-length="{{ $maxAddressLength }}"
            data-old='@json($oldData)'
            data-errors='@json($errors->toArray())'
        ></div>
    </body>
</html>
