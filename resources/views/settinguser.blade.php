<x-layout>
    <x-slot name="title">User Setting - {{ $user->username }}</x-slot>

    <x-slot name="content">
        <form class="form-center bg-light" style="border: 0.1px solid gray; padding: 2rem; box-shadow: 2px 2px 2px 2px gray;"
         action="{{ route("UpdateSetting", Auth::user()->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" placeholder="Username"
                value="{{ isset($user) ? $user->username : "" }}">
                @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email"
                value="{{ isset($user) ? $user->email : "" }}">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo" placeholder="Profile Photo">
                @error('photo')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" title="Fill this to confirm changes">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-control @error('newpassword') is-invalid @enderror" type="password" name="newpassword" placeholder="New Password" title="if this is same as old password it will treated as not change password">
                @error('newpassword')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input class="form-control @error('credit_card') is-invalid @enderror" type="password" name="credit_card" placeholder="Credit Card"
                value="{{ isset($user) ? $user->credit_card : "" }}">
                @error('credit_card')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input class="btn btn-info" type="submit" value="Edit">
            </div>
        </form>
    </x-slot>
</x-layout>
