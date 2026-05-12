<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/result.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
    </head>
    <body>
        @include('common.header')
        <h1>{{$title}}</h1>

        <p>配送番号　　　　{{ $shipment->tracking_number }}</p>

        @auth
        <p>担当者　　　　　{{ $shipment->staff_name }}</p>

        <p>ご依頼主</p>
        <p>　　氏名　　　　{{ $shipment->client_name }}</p>
        <p>　　住所　　　　{{ $shipment->client_address }}</p>
        <p>お届け先</p>
        <p>　　氏名　　　　{{ $shipment->receiver_name }}</p>
        <p>　　住所　　　　{{ $shipment->receiver_address }}</p>
        @endauth

        <p>配送状況　　　　{{ $shipment->status }}</p>

        <div class="button-area">
            <button type="button" onclick="location.href='/search'">戻る</button>
            @auth
            <button type="button" class="status-button">
                配送
            </button>
            @endauth
        </div>
    </body>
</html>
