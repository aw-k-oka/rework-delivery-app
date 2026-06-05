<header>
    <div class="user-name">
        ユーザ：
        @auth('staff')
        {{ Auth::guard('staff')->user()->name }}
        @elseauth('customer')
        {{ Auth::guard('customer')->user()->name }}
        @endauth
    </div>
    <div class="header-button-area">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">ログアウト</button>
        </form>
        @auth('staff')
        <button onclick="location.href='{{ route('shipment.search.index') }}'">
        @elseauth('customer')
        <button onclick="location.href='{{ route('customer.top') }}'">
        @endauth
        トップへ</button>
    </div>
</header>
