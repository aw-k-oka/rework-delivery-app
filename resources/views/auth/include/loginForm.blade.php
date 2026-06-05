<body>
    <div class="form-area">
        @error('login_error')
        <p class="error-msg">{{ $message }}</p>
        @enderror
        <form method="POST" action="{{ $action }}">
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
