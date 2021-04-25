<nav class="navbar navbar-expand navbar bg static-top border-bottom">
    <a class="navbar-brand mr-1 text-dark" href="{{ route('home.index') }}">Liquor Store</a>
    <button class="btn btn-link btn-sm text-dark order-1 order-sm-0" id="sidebarToggle" href="#">
    <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search -->
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto">
       <li class="nav-item no-arrow text-dark">
         <div class="">
            @guest
            @if (Route::has('register'))
                <a href="{{ route('login') }}" class="btn-login text-dark">Log In</a>
            @endif
            @endguest
            @auth
            @if (Auth::user()->hasVerifiedEmail())
                <a href="{{ route('admin.dashboard.index') }}" class="text-dark mr-2">
                    {{ Auth::user()->name }}
                </a>

            @else
                <a href="{{ route('verification.notice') }}" class="text-dark mr-2">Activate Account</a>
            @endif

            <a href="" class="text-dark"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endauth
        </div>
       </li>
    </ul>
 </nav>