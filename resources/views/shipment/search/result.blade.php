<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/shipment/search/result.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
    </head>
    <body>
        @include('common.header')
        <section>
            <div class="info-row">
                <label>配送番号</label>
                <span>{{ $shipment->tracking_number }}</span>
            </div>
            @auth
            <div class="info-row">
                <label>担当者</label>
                <span>{{ $shipment->staff_name }}</span>
            </div>
            <div>
                <label>ご依頼主</label>
                <div class="info-row">
                    <label class="info-label">氏名</label>
                    <span>{{ $shipment->client_name }}</span>
                </div>
                <div class="info-row">
                    <label class="info-label">住所</label>
                    <span>{{ $shipment->client_address }}</span>
                </div>

                <label>お届け先</label>
                <div class="info-row">
                    <label class="info-label">氏名</label>
                    <span>{{ $shipment->receiver_name }}</span>
                </div>
                <div class="info-row">
                    <label class="info-label">住所</label>
                    <span>{{ $shipment->receiver_address }}</span>
                </div>
            </div>
            @endauth
            <div class="info-row">
                <label>配送状況</label>
                <span>{{ $shipment->status }}</span>
            </div>
        </section>
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
