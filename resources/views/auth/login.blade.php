<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>配送アプリ：担当者ログイン</title>

        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    </head>
    <body>
        <div class="form-area">
            @error('login_error')
            <p class="error-msg">{{ $message }}</p>
            @enderror
            <form method="POST" action="{{ route('staff.login') }}">
                @csrf
                <div class="user-row">
                    <label for="login_id">ID</label>
                    <input id="login_id" type="text" name="login_id" value="{{ old('login_id') }}">
                </div>
                <div class="user-row">
                    <label for="login_password">PASS</label>
                    <input id="login_password" type="password" name="login_password">
                </div>
                <div class="button-area">
                    <button class="login-button" type="submit">ログイン</button>
                </div>
            </form>
        </div>
    </body>
</html>
