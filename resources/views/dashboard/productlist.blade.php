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
                            src="{{ asset("image/product/" . $row->productname . ".png") }}">
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
                    <td>Action</td>
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
