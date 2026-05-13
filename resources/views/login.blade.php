<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>
    <body>
        <h1>{{ $title }}</h1>
        <div class="form-area">
            @error('login_error')
            <p class="error-msg">{{ $message }}</p>
            @enderror
            <form method="POST" action="/login">
                @csrf
                <div class="user-row">
                    <label>ID</label>
                    <input type="text" name="login_id">
                </div>
                <div class="user-row">
                    <label>PASS</label>
                    <input type="password" name="login_password">
                </div>
                <div class="button-area">
                    <button class="login-button" type="submit">ログイン</button>
                </div>
            </form>
        </div>
    </body>
</html>
