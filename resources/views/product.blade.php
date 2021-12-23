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

                    <div>
                        @for ($i = 0; $i < 5; $i++)
                            @if ($star >= 1)
                                <img class="ml-1" src="{{ asset("image/star-gold-background.svg") }}" alt="star full" style="width: 30px!important">
                                @php ($star = $star - 1)
                            @elseif ($star > 0.6)
                                <img class="ml-1" src="{{ asset("image/star-quarter-last-gold-background.svg") }}" alt="star quarter last" style="width: 30px!important">
                                @php ($star = $star - 0.75)
                            @elseif ($star > 0.45)
                                <img class="ml-1" src="{{ asset("image/star-half-gold-background.svg") }}" alt="star half" style="width: 30px!important">
                                @php ($star = $star - 0.5)
                            @elseif ($star > 0.25)
                                <img class="ml-1" src="{{ asset("image/star-quarter-first-gold-background.svg") }}" alt="star quarter first" style="width: 30px!important">
                                @php ($star = $star - 0.25)
                            @else
                                <img class="ml-1" src="{{ asset("image/star.svg") }}" alt="star" style="width: 30px!important">
                            @endif
                        @endfor
                    </div>

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
                @foreach ($reviews as $row)
                    <h4 class="mb-3">{{ $row->user->username }}</h4>
                        <div class="row" style="">
                        @for ($i = 0; $i < $row->star; $i++)
                            <img class="ml-1" src="{{ asset("image/star-gold-background.svg") }}" alt="star" style="width: 20px!important">
                        @endfor
                        @if ($row->star < 5)
                            @for ($i = $row->star; $i < 5; $i++)
                                <img class="ml-1" src="{{ asset("image/star.svg") }}" alt="star" style="width: 20px!important">
                            @endfor
                        @endif
                        <p class="pt-3 ml-3 ">
                            {{ $row->updated_at }}
                        </p>
                    </div>
                    <p class="mt-3">{{ $row->comment }}</p>
                    <hr>
                @endforeach

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
