<x-layout>
    <x-slot name="title">{{ $title }}</x-slot>

    <x-slot name="navbar">
        @if (Auth::user()->admin)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Manage Blog
                </a>
                <div class="dropdown-menu popout">
                    <a href="{{ route("OwnedBlog") }}" class="dropdown-item {{ $title == "List Owned Blog" ? "active" : "" }}">List owned Blog</a>
                    <a href="{{ route("CreateBlog") }}" class="dropdown-item {{ $title == "Create Blog" ? "active" : "" }}">Create Blog</a>
                    @if (Auth::user()->admin)
                        <a href="{{ route("AllBloglist") }}" class="dropdown-item {{ $title == "List all Blog" ? "active" : "" }}">List all Blog</a>
                    @endif
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Admin
                </a>
                <div class="dropdown-menu popout">
                    <a href="{{ route("UsersList") }}" class="dropdown-item {{ $title == "Users Management" ? "active" : "" }}">Users Management</a>
                    <a href="{{ route("SubscribeList") }}" class="dropdown-item {{ $title == "Subscribe Management" ? "active" : "" }}">Subscribe Management</a>
                    <a href="" class="dropdown-item {{ $title == "Upload Image" ? "active" : "" }}">Upload Image</a>
                    <a href="{{ route("ImageManagement") }}" class="dropdown-item {{ $title == "Image Management" ? "active" : "" }}">Image Management</a>
                    <a href="" class="dropdown-item {{ $title == "Create User" ? "active" : "" }}">Create User</a>
                </div>
            </li>
        @endif
        @if (Auth::user()->vendor)
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ !Auth::user()->vendor ? "disabled" : "" }}" href="#" id="navbardrop" data-toggle="dropdown">
                    Manage Product
                </a>
                <div class="dropdown-menu popout">
                    <a href="{{ route("OwnedProduct") }}" class="dropdown-item {{ $title == "List Owned Product" ? "active" : "" }}">List owned Product</a>
                    <a href="{{ route("CreateProduct") }}" class="dropdown-item {{ $title == "Create Product" ? "active" : "" }}">Create Product</a>
                    @if (Auth::user()->admin)
                        <a href="{{ route("AllProductList") }}" class="dropdown-item {{ $title == "List all Product" ? "active" : "" }}">List all Product</a>
                    @endif
                </div>
            </li>
        @endif
    </x-slot>

    <x-slot name="content">
        {{ $content }}
    </x-slot>
</x-layout>
