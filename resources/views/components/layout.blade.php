<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <script defer src="{{ asset("js/jquery-3.5.1.js") }}"></script>
    <script defer src="{{ asset("js/app.js") }}"></script>
    <title>{{ $title }}</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm sticky-top bg-light navbar-light">
        <div class="container">
            <button class="navbar-toggler" data-toggle="collapse" data-target="#collapsibleNavbar">
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
                </ul>
            </div>

            <ul class="navbar-nav">
                @if (!Auth::check())
                <li class="nav-item">
                    <a href="" class="nav-link {{ $title == "Login" ? "active" : "" }}">Login</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link {{ $title == "Register" ? "active" : "" }}">Register</a>
                </li>
                @else
                @endif
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        {{ $content }}
    </div>

    <div class="footer bg-light fixed-bottom">
        <div class="container">
            <div class="text-center">
            <p class="text-muted">
                <script>
                var n = new Date();
                document.write(n.getFullYear());
                </script>
                &copy;<b>UnknownRori</b>
            </p>
            </div>
        </div>
    </div>

</body>
</html>
