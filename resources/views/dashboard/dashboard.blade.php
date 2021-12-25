<x-dashboard>
    <x-slot name="title">Dashboard</x-slot>

    <x-slot name="content">
        @if (!Auth::user()->vendor)
            <div id="register" class="text-center mt-5 pt-5">
                <h2>Join the Fake E-Commerce's Vendor to access the vendor feature</h2>
                <form action="{{ route("JoinVendor") }}" method="post">
                    @csrf
                    <input type="submit" value="Join" name="vendor" class="btn btn-primary">
                </form>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. <a href="#">Privacy & Term</a> Quibusdam molestiae totam.
                </p>
            </div>
        @endif
    </x-slot>
</x-dashboard>
