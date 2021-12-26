<x-dashboard>
    <x-slot name="title">List Owned Product</x-slot>

    <x-slot name="content">
        <table class="table table-hover">
            <tr>
                <td>ID</td>
                <td>Photo</td>
                <td>Owner</td>
                <td>Name</td>
                <td>Price</td>
                <td>Stock</td>
                <td>Created at</td>
                <td>Updated at</td>
                <td>Action</td>
            </tr>
            @foreach ($product as $row)
                <tr>
                    <td>
                        {{ $row->id }}
                    </td>
                    <td class="img-container-small m-0 p-0">
                        <a href="{{ route("Product", $row->id) }}" class="link">
                            <img class="img-fluid" alt="{{ $row->productname }}"
                            src="{{ Storage::url("/image/product/" . $row->productname . ".png") }}">
                        </a>
                    </td>
                    <td>
                        {{ $row->user->username }}
                    </td>
                    <td>
                        <a href="{{ route("Product", $row->id) }}" class="link">
                            {{ $row->productname }}
                        </a>
                    </td>
                    <td>
                        {{ $row->price }}
                    </td>
                    <td>
                        {{ $row->stock }}
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
                                    <a href="{{ route("EditProduct", $row->id) }}" class="dropdown-item">Edit</a>
                                @endif

                                @if (Auth::user()->id == $row->users_id || Auth::user()->admin )
                                    <form action="#" method="post">
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
                {{ $product->previousPageUrl() }}
            </x-slot>
            <x-slot name="next">
                {{ $product->nextPageUrl() }}
            </x-slot>
        </x-paginatebutton>
    </x-slot>
</x-dashboard>
