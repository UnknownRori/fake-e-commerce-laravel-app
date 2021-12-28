<x-dashboard>
    <x-slot name="title">Subscribe Management</x-slot>

    <x-slot name="content">
        <table class="table table-hover">
            <tr>
                <td>ID</td>
                <td>Username</td>
                <td>Email</td>
                <td>Created at</td>
                <td>Updated at</td>
                <td>Action</td>
            </tr>
            @foreach ($subscribe as $row)
                <tr>
                    <td>
                        {{ $row->id }}
                    </td>
                    <td>
                        {{ isset($row->user->username) ? $row->user->username : "No username registered" }}
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
                                @if (Auth::user()->id == $row->id || Auth::user()->admin )
                                    <form action="{{ route("DeleteSubscribe", $row->id) }}" method="post">
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
                {{ $subscribe->previousPageUrl() }}
            </x-slot>
            <x-slot name="next">
                {{ $subscribe->nextPageUrl() }}
            </x-slot>
        </x-paginatebutton>
    </x-slot>
</x-dashboard>
