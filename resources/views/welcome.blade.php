<x-layout>
    <x-slot name="title">Home</x-slot>

    <x-slot name="content">

        <div class="container">

            <main>

                <header id="header">
                    <h2 id="title" class="text-center">Featured Product</h2>
                </header>

                <section id="content">

                    <div class="row">

                        @foreach ($product as $row)

                            <div id="{{ $row->productname }}" class="col-4 text-center">

                                <div class="img">
                                    <a href="">
                                        <img class="img-fluid" src="./image/product/{{ $row->productname }}.png"
                                            alt="{{ $row->productname }}">
                                    </a>
                                </div>

                                <h4> {{ $row->productname }} </h4>

                                <h5 class="text-danger"> $ {{ $row->price }} </h5>

                            </div>

                        @endforeach

                    </div>

                </section>

            </main>

            <div id="footer">
                <div class="m-auto">
                    <form action="" method="post">

                        <x-input>
                            <x-slot name="type">email</x-slot>
                            <x-slot name="name">email</x-slot>
                        </x-input>

                    </form>
                </div>
            </div>

        </div>

    </x-slot>
</x-layout>
