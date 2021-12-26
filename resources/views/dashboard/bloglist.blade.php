<x-dashboard>
    <x-slot name="title">List Owned Blog</x-slot>

    <x-slot name="content">
        <table class="table table-hover">
            <tr>
                <td>ID</td>
                <td>Owner</td>
                <td>Title</td>
                <td>Content</td>
                <td>Created at</td>
                <td>Updated at</td>
                <td>Action</td>
            </tr>
            @foreach ($blog as $row)
                <tr>
                    <td>
                        {{ $row->id }}
                    </td>
                    <td>
                        {{ $row->user->username }}
                    </td>
                    <td>
                        <a href="{{ route("Blog", $row->id) }}" class="link">{{ $row->title }}</a>
                    </td>
                    <td>
                        <a href="{{ route("Blog", $row->id) }}#content" class="link">{{ $row->content }}</a>
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
                                @if (Auth::user()->id == $row->users_id)
                                    <a href="{{ route("EditBlog", $row->id) }}" class="dropdown-item">Edit</a>
                                @endif

                                @if (Auth::user()->id == $row->users_id || Auth::user()->admin )
                                    <form action="{{ route('DeleteBlog', $row->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" class="dropdown-item">
                                    </form>
                                @endif

                                @if (Auth::user()->id != $row->users_id)
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
                {{ $blog->previousPageUrl() }}
            </x-slot>
            <x-slot name="next">
                {{ $blog->nextPageUrl() }}
            </x-slot>
        </x-paginatebutton>
    </x-slot>
</x-dashboard>
