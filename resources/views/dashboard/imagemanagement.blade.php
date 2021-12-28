<x-dashboard>
    <x-slot name="title">Image Management</x-slot>

    <x-slot name="content">
        <table class="table table-hover">
            <tr>
                <td>ID</td>
                <td>Photo</td>
                <td>URI</td>
                <td>Owner</td>
                <td>Action</td>
            </tr>
            @foreach ($files as $row)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td class="img-container-small m-0 p-0">
                        <a href="{{ $row }}" class="link">
                            <img class="img-fluid" alt=""
                            src="{{ Storage::url($row) }}">
                        </a>
                    </td>
                    <td>
                        {{ $row }}
                    </td>
                    <td>
                        Coming Soon
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu popout" aria-labelledby="dropdownMenuButton" style="margin-right: 2rem;">

                                @if (Auth::user()->admin )
                                    <form action="#" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" class="dropdown-item">
                                    </form>
                                @endif

                                @if (Auth::user()->admin)
                                    <a class="dropdown-item" href="#">Report</a>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        {{-- <x-paginatebutton>
            <x-slot name="prev">
                {{ $product->previousPageUrl() }}
            </x-slot>
            <x-slot name="next">
                {{ $product->nextPageUrl() }}
            </x-slot>
        </x-paginatebutton> --}}
    </x-slot>
</x-dashboard>
