<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @viteReactRefresh
        @vite('resources/js/pages/shipment/search/result.jsx')

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
        @auth
        <div id="shipment-status-actions"
            data-shipment='@json($shipment)'
            data-user='@json(Auth::user())'
            data-csrf-token="{{ csrf_token() }}"
            data-back-url="{{ route('shipment.search.index') }}"
            data-return-url="{{ route('shipment.status.backToOffice') }}"
            data-deliver-url="{{ route('shipment.status.deliver') }}"
            data-complete-url="{{ route('shipment.status.complete') }}"
        ></div>
        @else
        <div id="shipment-status-actions"
            data-shipment='@json([
                "id" => $shipment->id,
                "status" => $shipment->status,
            ])'
            data-csrf-token="{{ csrf_token() }}"
            data-back-url="{{ route('shipment.search.index') }}"
        ></div>
        @endauth
    </body>
</html>
