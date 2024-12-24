<nav class="navbar navbar-expand-lg navbar-sticky navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">KOSAN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item {{ request()->is('search') ? 'active' : '' }}">
                    <a class="nav-link" href="/search"><i class="fas fa-search"></i> Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#footer"><i class="fas fa-info-circle"></i> About</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @auth
                    @if (Auth::user()->role == 'Penghuni')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('profile') }}"><i class="fas fa-user"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('cart') }}"><i class="fas fa-shopping-cart"></i> Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endif

                    @if (Auth::user()->role == 'Admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-home"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endif
                    
                @else
                    <!-- Show login and register options if user is not logged in -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('register') }}"><i class="fas fa-user-plus"></i> Daftar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('login') }}" id="loginIcon"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
