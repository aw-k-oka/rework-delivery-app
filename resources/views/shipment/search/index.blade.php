<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/common/header.css') }}">
        <link rel="stylesheet" href="{{ asset('css/shipment/search/index.css') }}">
    </head>
    <body>
        @include('common.header')
        <div class="form-area">
            @error('not_found_error')
            <p class="error-msg">{{ $message }}</p>
            @enderror
            <form method="GET" action="{{ route('shipment.search.result') }}">
                <label>配送番号</label>
                <input type="text" name="tracking_number">
                <div class="button-area">
                    <button class="search-button short-word" type="submit">検索</button>
                </div>
            </form>
        </div>
    </body>
</html>
