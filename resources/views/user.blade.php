<x-layout>
    <x-slot name="title">User Profile - {{ $user->username }}</x-slot>

    <x-slot name="content">
        <div class="container">
            <header class="img-container pt-2 m-auto">
                <img class="img-fluid profile border-primary border-bottom border-top border-left border-right" src="{{ Storage::url('/image/profile/' . $user->username . '.png') }}" alt="{{ $user->username }}">
            </header>
            <div class="text-center pt-5 mt-4">
                <h2 class="">{{ $user->username }}</h2>
                @if ($user->admin)
                    <h5>Admin</h5>
                @elseif ($user->vendor)
                    <h5>Vendor</h5>
                @else
                    <h5>User</h5>
                @endif
            </div>
            @if ($user->vendor)
                <div class="container-fluid mt-3">
                    <h4 class="text-center">Featured Product</h4>
                    <div class="row">
                        @foreach ($product as $row)
                            <div data-hidden="{{ $loop->iteration }}" id="{{ $row->id }}" class="col-4 text-center hidden">
                                <table>
                                    <tr>
                                        <td class="img-container">
                                            <a href="{{ route("Product", $row->id) }}">
                                                <img class="img-fluid" src="{{ Storage::url('/image/product/' . $row->productname . '.png') }}"
                                                    alt="{{ $row->productname }}">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4> {{ ucwords($row->productname) }} </h4>

                                            <h5 class="text-danger"> $ {{ $row->price }} </h5>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
                <x-paginatebutton>
                    <x-slot name="prev">
                        {{ $product->previousPageUrl() }}
                    </x-slot>
                    <x-slot name="next">
                        {{ $product->nextPageUrl() }}
                    </x-slot>
                </x-paginatebutton>
            @endif
        </div>
    </x-slot>
</x-layout>
