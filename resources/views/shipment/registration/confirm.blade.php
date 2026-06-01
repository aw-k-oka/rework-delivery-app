<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>配送アプリ：入力内容確認</title>

        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/shipment/registration/confirm.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
    </head>
    <body>
        @include('common.header')
        <section>
            <p>ご依頼主</p>
            <div class="form-row">
                <span class="form-label">氏名</span>
                <span>{{ $client_name }}</span>
            </div>
            <div class="form-row">
                <span class="form-label">住所</span>
                <span>{{ $client_address }}</span>
            </div>
        </section>
        <section>
            <p>お届け先</p>
            <div class="form-row">
                <span class="form-label">氏名</span>
                <span>{{ $receiver_name }}</span>
            </div>
            <div class="form-row">
                <span class="form-label">住所</span>
                <span>{{ $receiver_address }}</span>
            </div>
        </section>
        <div class="button-area">
            <form method="GET" action="{{ route('shipment.registration.index') }}">
                <input type="hidden" name="client_name" value="{{ $client_name }}">
                <input type="hidden" name="client_address" value="{{ $client_address }}">
                <input type="hidden" name="receiver_name" value="{{ $receiver_name }}">
                <input type="hidden" name="receiver_address" value="{{ $receiver_address }}">
                <button type="submit" class="short-word">戻る</button>
            </form>
            <form method="POST" action="{{ route('shipment.registration.store') }}">
                @csrf
                <button type="submit" class="short-word">登録</button>
            </form>
        </div>
    </body>
</html>
