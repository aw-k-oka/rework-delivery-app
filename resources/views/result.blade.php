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
            <form action="/search" method="get">
                <button type="submit" class="short-word">戻る</button>
            </form>
            @auth
            @if ($shipment->status === '営業所')
            <!-- レイアウト調整のための空要素 -->
            <div></div>
            <form method="POST" action="/status/deliver">
                @csrf
                <input type="hidden" name="id" value="{{ $shipment->id }}">
                <button type="submit" class="status-button short-word">
                    配送
                </button>
            </form>
            @endif
            @if ($shipment->status === '配送中')
            <form method="POST" action="/status/return">
                @csrf
                <input type="hidden" name="id" value="{{ $shipment->id }}">
                <button type="submit" class="status-button" @if ($shipment->staff_name !== Auth::user()?->name) disabled @endif>
                    持ち帰り
                </button>
            </form>
            <form method="POST" action="/status/complete">
                @csrf
                <input type="hidden" name="id" value="{{ $shipment->id }}">
                <button type="submit" class="status-button" @if ($shipment->staff_name !== Auth::user()?->name) disabled @endif>
                    配達済み
                </button>
            </form>
            @endif
            @endauth
        </div>
    </body>
</html>
