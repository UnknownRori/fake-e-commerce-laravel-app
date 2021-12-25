<x-dashboard>
    <x-slot name="title">List Owned Blog</x-slot>

    <x-slot name="content">
        <table class="table table-hover">
            <tr>
                <td>ID</td>
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
                        {{ $row->title }}
                    </td>
                    <td>
                        {{ $row->content }}
                    </td>
                    <td>
                        {{ $row->created_at }}
                    </td>
                    <td>
                        {{ $row->updated_at }}
                    </td>
                    <td>Action</td>
                </tr>
            @endforeach
        </table>
    </x-slot>
</x-dashboard>
