<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/shipment/registration/confirm.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
    </head>
    <body>
        @include('common.header')
        <h1>{{ $title }}</h1>
        <section>
            <label>ご依頼主</label>
            <div class="form-row">
                <span class="form-label">氏名</span>
                <span>{{ $clientName }}</span>
            </div>
            <div class="form-row">
                <span class="form-label">住所</span>
                <span>{{ $clientAddress }}</span>
            </div>
        </section>
        <section>
            <label>お届け先</label>
            <div class="form-row">
                <span class="form-label">氏名</span>
                <span>{{ $receiverName }}</span>
            </div>
            <div class="form-row">
                <span class="form-label">住所</span>
                <span>{{ $receiverAddress }}</span>
            </div>
        </section>
        <div class="button-area">
            <form method="GET" action="/registration">
                <input type="hidden" name="client_name" value="{{ $clientName }}">
                <input type="hidden" name="client_address" value="{{ $clientAddress }}">
                <input type="hidden" name="receiver_name" value="{{ $receiverName }}">
                <input type="hidden" name="receiver_address" value="{{ $receiverAddress }}">
                <button type="submit" class="short-word">戻る</button>
            </form>
            <form method="POST" action="/registration/complete">
                @csrf
                <input type="hidden" name="client_name" value="{{ $clientName }}">
                <input type="hidden" name="client_address" value="{{ $clientAddress }}">
                <input type="hidden" name="receiver_name" value="{{ $receiverName }}">
                <input type="hidden" name="receiver_address" value="{{ $receiverAddress }}">
                <button type="submit" class="short-word">登録</button>
            </form>
        </div>
    </body>
</html>
