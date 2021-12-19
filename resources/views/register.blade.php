<x-layout>
    <x-slot name="title">Register</x-slot>

    <x-slot name="content">

        <div id="register">
            <form action="{{ route("PostRegister") }}" method="POST">
                @csrf
                <h2 class="text-center">Register Form</h2>
                <x-input>
                    <x-slot name="label">Username</x-slot>
                    <x-slot name="class">text-danger</x-slot>
                    <x-slot name="type">name</x-slot>
                    <x-slot name="name">Username</x-slot>
                </x-input>
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
                    <input  class="btn btn-primary" type="submit" value="Register" name="login" required>
                </div>

            </form>
        </div>

    </x-slot>
</x-layout>
