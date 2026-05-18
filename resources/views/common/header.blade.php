<header class="header">
    <div class="user-name">
        ユーザー名：
        @auth
        {{ Auth::user()->name }}
        @else
        ゲスト
        @endauth
    </div>
    @auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
    @else
    <button onclick="location.href='{{ route('top') }}'">トップへ</button>
    @endauth
</header>
