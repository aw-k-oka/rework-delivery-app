<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>配送アプリ：担当者ログイン</title>

        <link rel="stylesheet" href="{{ asset('css/common/common.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth/staffLogin.css') }}">
    </head>
    @include('auth.include.loginForm', ['action' => route('staff.login')])
</html>
