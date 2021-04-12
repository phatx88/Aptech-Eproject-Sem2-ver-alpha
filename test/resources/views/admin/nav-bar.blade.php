<nav class="navbar navbar-expand navbar bg static-top border-bottom">
    <a class="navbar-brand mr-1 text-dark" href="index.html">Liquor Store</a>
    <button class="btn btn-link btn-sm text-dark order-1 order-sm-0" id="sidebarToggle" href="#">
    <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search -->
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto">
       <li class="nav-item no-arrow text-dark">
         <div class="">

            @guest
                @if (Route::has('login'))
                    <a href="#register" class="btn-register mr-2 text-dark" data-toggle="modal">Sign Up</a>
                @endif

                @if (Route::has('register'))
                    <a href="#login" class="btn-login text-dark" data-toggle="modal">Log In</a>
                @endif
            @else
                {{-- User drop down menu --}}
                <a href="{{ route('account.index') }}" class="text-dark mr-2">
                    {{ Auth::user()->name }}
                </a>

                {{-- User drop down menu --}}
                <a href="{{ route('logout') }} " class="text-dark"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            @endguest
        </div>
       </li>
    </ul>
 </nav>