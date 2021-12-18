<x-layout>
    <x-slot name="title">Register</x-slot>

    <x-slot name="content">

        <div class="container text-center" style="margin-top: 8rem;">
            <form action="" method="POST">
                @csrf
                <h2 class="text-center">Login Form</h2>
                <div class="form-group">
                    <input class="form-control" type="text" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email" required>
                </div>

                <div class="form-group float-right">
                    <input  class="btn btn-primary" type="submit" value="Log in" name="login" required>
                </div>

            </form>
        </div>

    </x-slot>
</x-layout>
