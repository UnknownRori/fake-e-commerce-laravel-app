<nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
    <div class="container">
        <div class="float-left">
            <a href="#top">
                <img class="brand" style="width: 75px;" src="{{ asset("image/Apple.png") }}" alt="">
            </a>
        </div>

        <button class="navbar-toggler float-left" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{ route("Home") }}" class="nav-link {{ $title == "Home" ? "active" : "" }} ">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("ProductList") }}" class="nav-link {{ $title == "Product List" ? "active" : "" }} ">Product</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("BlogList") }}" class="nav-link {{ $title == "Blog" ? "active" : "" }} ">Blog</a>
                </li>
                {{ isset($navbar) ? $navbar : "" }}
            </ul>

            <ul class="navbar-nav">
            @if (!Auth::check())
                <div class="row">
                    <li class="nav-item ml-3 mr-2">
                        <a href="{{ route("Login") }}" class="nav-link {{ $title == "Login" ? "active" : "" }}">Login</a>
                    </li>
                    <li class="nav-item ml-3 mr-2">
                        <a href="{{ route("Register") }}" class="nav-link {{ $title == "Register" ? "active" : "" }}">Register</a>
                    </li>
                </div>
            @else
                <li class="nav-item dropdown mr-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        {{ Auth::user()->username }}
                        <img class="profile m-0 p-0" style="width: 2rem;" src="{{ Storage::url('/image/profile/' . Auth::user()->username . '.png') }}">
                    </a>
                    <div class="dropdown-menu popout">
                        <a href="{{ route("Dashboard") }}" class="dropdown-item {{ $title == "Dashboard" ? "active" : "" }}">Dashboard</a>
                        <a href="{{ route("UserSetting", Auth::user()->id) }}" class="dropdown-item {{ $title == "User Setting - " . Auth::user()->username ? "active" : "" }}">User Setting</a>
                        <a href="{{ route("PurchaseIndex") }}" class="dropdown-item">Purchase History</a>
                        <a href="{{ route("Logout") }}" class="dropdown-item">Log out</a>
                    </div>
                </li>
            @endif

        </ul>
        </div>
    </div>
</nav>
