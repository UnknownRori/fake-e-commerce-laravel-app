<x-dashboard>
    <x-slot name="title">Users Management</x-slot>

    <x-slot name="content">
        <table class="table table-hover">
            <tr>
                <td>ID</td>
                <td>Photo</td>
                <td>Username</td>
                <td>Email</td>
                <td>Created at</td>
                <td>Updated at</td>
                <td>Action</td>
            </tr>
            @foreach ($users as $row)
                <tr>
                    <td>
                        {{ $row->id }}
                    </td>
                    <td class="img-container-small m-0 p-0">
                        <a href="{{ route("Product", $row->id) }}" class="link">
                            <img class="img-fluid" alt="{{ $row->username }}"
                            src="{{ Storage::url("/image/profile/" . $row->username . ".png") }}">
                        </a>
                    </td>
                    <td>
                        {{ $row->username }}
                    </td>
                    <td>
                        {{ $row->email }}
                    </td>
                    <td>
                        {{ $row->created_at }}
                    </td>
                    <td>
                        {{ $row->updated_at }}
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu popout" aria-labelledby="dropdownMenuButton" style="margin-right: 2rem;">
                                @if (Auth::user()->id == $row->id)
                                    <a href="#" class="dropdown-item">Edit</a>
                                @endif

                                @if (Auth::user()->id == $row->id || Auth::user()->admin )
                                    <form action="#" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" class="dropdown-item">
                                    </form>
                                @endif

                                @if (Auth::user()->id != $row->id)
                                    <a class="dropdown-item" href="#">Report</a>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        <x-paginatebutton>
            <x-slot name="prev">
                {{ $users->previousPageUrl() }}
            </x-slot>
            <x-slot name="next">
                {{ $users->nextPageUrl() }}
            </x-slot>
        </x-paginatebutton>
    </x-slot>
</x-dashboard>
