<x-layout>
    <x-slot name="title">Product List</x-slot>

    <x-slot name="content">
        <main>
            <div class="container">
                <div class="row">
                    @foreach ($product as $row)
                        <div id="{{ $row->productname }}" class="col-4 text-center">
                            <table>
                                <tr>
                                    <td class="img-container">
                                        <a href="{{ route("Product", $row->id) }}">
                                            <img class="img-fluid" src="./image/product/{{ $row->productname }}.png"
                                                alt="{{ $row->productname }}">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4> {{ $row->productname }} </h4>

                                        <h5 class="text-danger"> $ {{ $row->price }} </h5>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                </div>
                <x-paginatebutton>
                    <x-slot name="prev">
                        {{ $product->previousPageUrl() }}
                    </x-slot>
                    <x-slot name="next">
                        {{ $product->nextPageUrl() }}
                    </x-slot>
                </x-paginatebutton>
            </div>
        </main>
    </x-slot>
</x-layout>
