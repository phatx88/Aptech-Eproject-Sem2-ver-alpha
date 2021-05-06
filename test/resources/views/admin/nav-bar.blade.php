<nav class="navbar navbar-expand navbar bg-dark static-top border-bottom" id="navbar">
    <a class="navbar-brand mr-1 text-white" href="{{ route('home.index') }}">Liquor Store</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
    <i class="fas fa-bars"></i>
    </button>
    <!-- Navbar Search -->
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto">
        
       <li class="nav-item no-arrow text-white">
         <div class="">
            @guest
            @if (Route::has('register'))
                <a href="{{ route('login') }}" class="btn-login text-white">Log In</a>
            @endif
            @endguest
            @auth
            @if (Auth::check())
            <form action="{{ route('account.upload') }}" method="POST" id="avatar_upload" enctype="multipart/form-data" class="form-inline d-inline mr-1">
                @csrf
                    <label for="profile_pic" style="cursor: pointer; color: #fff;" class="m-0 p-0 d-inline" title="Upload Profile Image"><i class="fas fa-camera-retro" aria-hidden="true">
                        </i> </label>
                    <input type="file" class="center-block file-upload d-none" id="profile_pic" name="image"
                        onchange="this.form.submit()">
            </form>
            <a href="{{ route('admin.dashboard.index') }}" class="text-white mr-2">
                {{ Auth::user()->name }}
            </a> 
            @else
                <a href="{{ route('verification.notice') }}" class="text-white mr-2">Activate Account</a>
            @endif

            <a href="" class="text-white"
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