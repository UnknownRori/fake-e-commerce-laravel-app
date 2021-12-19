<nav class="navbar navbar-expand-sm sticky-top bg-light navbar-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route("Home") }}" class="nav-link {{ $title == "Home" ? "active" : "" }} ">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("ProductList") }}" class="nav-link {{ $title == "Product List" ? "active" : "" }} ">Product</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("Blog") }}" class="nav-link {{ $title == "Blog" ? "active" : "" }} ">Blog</a>
                </li>
                {{ isset($navbar) ? $navbar : "" }}
            </ul>
        </div>

        <ul class="navbar-nav">
            @if (!Auth::check())
                <div class="row">
                    <li class="nav-item mr-2">
                        <a href="{{ route("Login") }}" class="nav-link {{ $title == "Login" ? "active" : "" }}">Login</a>
                    </li>
                    <li class="nav-item ml-2 mr-2">
                        <a href="{{ route("Register") }}" class="nav-link {{ $title == "Register" ? "active" : "" }}">Register</a>
                    </li>
                </div>
            @else
                <li class="nav-item dropdown mr-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        {{ Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu popout">
                        <a href="{{ route("Dashboard") }}" class="dropdown-item {{ $title == "Dashboard" ? "active" : "" }}">Dashboard</a>
                        <a href="" class="dropdown-item">User Setting</a>
                        <a href="{{ route("Logout") }}" class="dropdown-item">Log out</a>
                    </div>
                </li>
            @endif

        </ul>
    </div>
</nav>
