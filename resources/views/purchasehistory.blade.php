<x-dashboard>
    <x-slot name="title">Purchase History</x-slot>

    <x-slot name="content">
        <table class="table table-hover">
            <tr>
                <td>ID</td>
                <td>Product</td>
                <td>Amount</td>
                <td>Purchase at</td>
                <td>Action</td>
            </tr>
            @foreach ($purchase as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>
                        <a href="{{ route("Product", $row->product->id) }}" class="link">
                            {{ $row->product->productname }}
                        </a>
                    </td>
                    <td>{{ $row->amount }}</td>
                    <td>
                        {{ $row->updated_at }}
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu popout" aria-labelledby="dropdownMenuButton" style="margin-right: 2rem;">
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
                {{ $purchase->previousPageUrl() }}
            </x-slot>
            <x-slot name="next">
                {{ $purchase->nextPageUrl() }}
            </x-slot>
        </x-paginatebutton>
    </x-slot>
</x-dashboard>
