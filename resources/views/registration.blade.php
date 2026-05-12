<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
    </head>
    <body>
        @include('common.header')
        <h1>{{ $title }}</h1>

        <form method="POST" action="/registration/confirm">
            @csrf
            <p>ご依頼主</p>
            <div class="form-row">
                <label>氏名(30文字)</label><span class="must">※必須</span>　　
                <input type="text" name="client_name" value="{{ old('client_name', request('client_name')) }}">
                @error('client_name')
                <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-row">
                <label>住所(50文字)</label><span class="must">※必須</span>　　
                <input type="text" name="client_address" value="{{ old('client_address', request('client_address')) }}">
                @error('client_address')
                <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            <p>お届け先</p>
            <div class="form-row">
                <label>氏名(30文字)</label><span class="must">※必須</span>　　
                <input type="text" name="receiver_name" value="{{ old('receiver_name', request('receiver_name')) }}">
                @error('receiver_name')
                <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-row">
                <label>住所(50文字)</label><span class="must">※必須</span>　　
                <input type="text" name="receiver_address" value="{{ old('receiver_address', request('receiver_address')) }}">
                @error('receiver_address')
                <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
            <br><br>
            <button type="button" onclick="location.href='/'">戻る</button>　<button type="submit">確認</button>
        </form>
    </body>
</html>
