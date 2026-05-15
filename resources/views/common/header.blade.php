<header class="header">
    <div class="user-name">
        @auth
        ユーザー名：{{ Auth::user()->name }}
        @else
        ユーザー名：ゲスト
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
