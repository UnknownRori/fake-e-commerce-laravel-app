<x-layout>
    <x-slot name="title">Dashboard</x-slot>

    <x-slot name="navbar">
        @if (Auth::user()->admin)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Manage Blog
                </a>
                <div class="dropdown-menu popout">
                    <a href="" class="dropdown-item">List owned Blog</a>
                    <a href="" class="dropdown-item">Create Blog</a>
                    @if (Auth::user()->admin)
                        <a href="" class="dropdown-item">List all Blog</a>
                    @endif
                </div>
            </li>
        @endif
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Manage Product
                </a>
                <div class="dropdown-menu popout">
                    <a href="" class="dropdown-item">List owned Product</a>
                    <a href="" class="dropdown-item">Create Product</a>
                    @if (Auth::user()->admin)
                        <a href="" class="dropdown-item">List all Product</a>
                    @endif
                </div>
            </li>
    </x-slot>

    <x-slot name="content">

    </x-slot>
</x-layout>
