<nav class="navbar">
    <div class="container">
        <div class="navbar-start navbar-menu">
            <a href="{{ route('home') }}" class="navbar-item is-brand">{{ config('app.name') }}</a>
        </div>
        <div class="navbar-end navbar-menu is-active">
            @if(auth()->check())
                <a href="#" class="navbar-item" onclick="event.preventDefault();document.getElementById('logout').submit();">
                    Sign out
                </a>
                <a href="{{ route('account') }}" class="navbar-item">
                    Your account
                </a>

                @role('admin')
                    <a href="{{ route('admin.index') }}" class="navbar-item">
                        Admin
                    </a>
                @endrole
            @else
                <a href="{{ route('login') }}" class="navbar-item">
                    Sign in
                </a>
                <div class="navbar-item">
                    <a href="{{ route('register') }}" class="navbar-item">
                        Start selling
                    </a>
                </div>
            @endif
        </div>
    </div>
</nav>

<form id="logout" action="{{ route('logout') }}" method="POST" class="is-hidden">
    @csrf
</form>