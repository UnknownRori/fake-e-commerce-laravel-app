<x-layout>
    <x-slot name="title">Register</x-slot>

    <x-slot name="content">
        <div id="register">
            <form action="{{ route("PostRegister") }}" method="POST">
                @csrf
                <h2 class="text-center">Register Form</h2>
                <div class="form-group">
                    <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" placeholder="Username" required>
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group float-right">
                    <input  class="btn btn-primary" type="submit" value="Register" name="login" required>
                </div>
            </form>
        </div>
    </x-slot>
</x-layout>
