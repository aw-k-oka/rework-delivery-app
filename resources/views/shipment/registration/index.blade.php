<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>配送アプリ：依頼登録</title>

        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/shipment/registration/index.css') }}">
    </head>
    <body>
        @include('common.header')
        <form method="POST" action="{{ route('shipment.registration.confirm') }}">
            @csrf
            <section>
                <label>ご依頼主</label>
                <div class="form-row">
                    <label>氏名({{ $maxNameLength }}文字)</label><span class="must">※必須</span>
                    <input type="text" name="client_name" value="{{ old('client_name', request('client_name')) }}">
                    @error('client_name')
                    <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-row">
                    <label>住所({{ $maxAddressLength }}文字)</label><span class="must">※必須</span>
                    <input type="text" name="client_address" value="{{ old('client_address', request('client_address')) }}">
                    @error('client_address')
                    <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            <section>
                <label>お届け先</label>
                <div class="form-row">
                    <label>氏名({{ $maxNameLength }}文字)</label><span class="must">※必須</span>
                    <input type="text" name="receiver_name" value="{{ old('receiver_name', request('receiver_name')) }}">
                    @error('receiver_name')
                    <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-row">
                    <label>住所({{ $maxAddressLength }}文字)</label><span class="must">※必須</span>
                    <input type="text" name="receiver_address" value="{{ old('receiver_address', request('receiver_address')) }}">
                    @error('receiver_address')
                    <p class="error-msg">{{ $message }}</p>
                    @enderror
                </div>
            </section>
            <div class="button-area">
                <button class="short-word" type="button" onclick="location.href='{{ route('top') }}'">戻る</button>
                <button class="short-word" type="submit">確認</button>
            </div>
        </form>
    </body>
</html>
