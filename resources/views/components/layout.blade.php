<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    <script defer src="{{ asset("js/jquery-3.5.1.js") }}"></script>
    <script defer src="{{ asset("js/bootstrap.bundle.js") }}"></script>
    <script defer src="{{ asset("js/app.js") }}"></script>
    {{ isset($extension) ? $extension : "" }}
    <title>{{ $title }}</title>
</head>
<body id="top">
    <x-navbar>
        <x-slot name="title">{{ $title }}</x-slot>
        @if (isset($navbar))
           <x-slot name="navbar">{{ $navbar }}</x-slot>
        @endif
    </x-navbar>
    <x-alert/>

    <div id="page-content" class="container-fluid">
        {{ $content }}
    </div>

    <footer class="footer bg-light fixed-bottom">
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
    </footer>
</body>
</html>
