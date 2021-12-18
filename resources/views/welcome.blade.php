<x-layout>
    <x-slot name="title">Home</x-slot>

    <x-slot name="content">

        <div class="container">

            <main>
                <header>
                    <h2 id="title" class="text-center">Featured Product</h2>
                </header>

                <section id="content">

                    <div class="row">

                        @foreach ($product as $row)

                            <div class="col-4 text-center">

                                <a href="">
                                    <img class="img-fluid" src="./image/product/{{ $row->productname }}.png"
                                        alt="{{ $row->productname }}">
                                </a>

                                <h4> {{ $row->productname }} </h4>

                                <h5> {{ $row->price }} </h5>
                            </div>

                        @endforeach

                    </div>

                </section>

            </main>

        </div>

    </x-slot>
</x-layout>
