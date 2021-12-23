<x-layout>
    <x-slot name="title">{{ $product->productname }}</x-slot>

    <x-slot name="content">
        <div class="container">
            <div class="row">
                <header class="col-6 text-center">
                    <img class="img-fluid" alt="{{ $product->productname }}"
                     src="{{ asset("image/product/" . $product->productname . ".png") }}">
                </header>
                <div class="col-6">
                    <article>
                        <h3 class="text-center">{{ $product->productname }}</h3>
                        <p>{{ $product->description }}</p>
                        <p> Stock : {{ $product->stock }}</p>
                        <p> Price :  $ {{ $product->price }}</p>
                    </article>

                    <form action="" method="POST" class="mt-4">
                        <input title="Do not change this if you don't want to get screwed" type="number" name="id" value="{{ $product->id }}" hidden>
                        <div class="form-group">
                            <input type="number" name="amount"
                            class="form-control {{ !Auth::check() || Auth::user()->id == $product->users_id ? "disabled" : ""}}"
                            placeholder="Amount" {{ !Auth::check() || Auth::user()->id == $product->users_id ? 'disabled' : ''}}>
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" value="Add to Cart"
                            class="btn btn-primary form-control {{ !Auth::check() || Auth::user()->id == $product->users_id ? "disabled" : ""}}"
                            {{ !Auth::check() || Auth::user()->id == $product->users_id ? 'disabled' : ''}}>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-5">
                {{-- @foreach ($product->reviews as $row) --}}
                @foreach ($reviews as $row)
                    <h4 class="mb-3">{{ $row->user->username }}</h4>
                        <div class="row" style="">
                        @for ($i = 0; $i < $row->star; $i++)
                            <img class="ml-4" src="{{ asset("image/star-gold-background.svg") }}" alt="star" style="width: 20px!important">
                        @endfor
                        @if ($row->star < 5)
                            @for ($i = $row->star; $i < 5; $i++)
                                <img class="ml-4" src="{{ asset("image/star.svg") }}" alt="star" style="width: 20px!important">
                            @endfor
                        @endif
                        <p class="pt-3 ml-3 ">
                            {{ $row->updated_at }}
                        </p>
                    </div>
                    <p class="mt-3">{{ $row->comment }}</p>
                    <hr>
                @endforeach
                {{-- <x-paginatebutton>
                    <x-slot name="prev">
                        {{ $product->reviews->previousPageUrl() }}
                    </x-slot>
                    <x-slot name="next">
                        {{ $product->reviews->nextPageUrl() }}
                    </x-slot>
                </x-paginatebutton> --}}
                @if ($reviews->nextPageUrl() || $reviews->previousPageUrl())
                    <x-paginatebutton>
                        <x-slot name="prev">
                            {{ $reviews->previousPageUrl() }}
                        </x-slot>
                        <x-slot name="next">
                            {{ $reviews->nextPageUrl() }}
                        </x-slot>
                    </x-paginatebutton>
                @endif
            </div>
        </div>
    </x-slot>
</x-layout>
