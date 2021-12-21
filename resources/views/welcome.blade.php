<x-layout>
    <x-slot name="title">Home</x-slot>

    <x-slot name="content">
        <section id="company-logo" class="blog-welcome text-center">
            <header style="padding-top: 100px;">
                <img class="" style="width: 150px;" src="{{ asset("image/Apple.png") }}" alt="">
                <h2 id="company_introduction">

                </h2>
            </header>
        </section>
        <div class="container">

            <main>
                <header id="header">
                    <h2 id="title" class="text-center">Current Featured Product</h2>
                </header>
                <section id="content">
                    <div class="row">
                        @foreach ($product as $row)
                            <div id="{{ $row->productname }}" class="col-4 text-center">
                                <table>
                                    <tr>
                                        <td class="img-container">
                                            <a href="" style="">
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
                </section>
            </main>
            <div id="footer">
                <div id="register">
                    <header class="text-center">
                        <h5>Subscribe to our newsletter to let us give relevant news just for you!</h5>
                    </header>
                    <form action="" method="post" class="row">
                        <div class="col-10">
                            <x-input>
                                <x-slot name="type">email</x-slot>
                                <x-slot name="name">email</x-slot>
                            </x-input>
                        </div>
                        <div class="col-2 p-0 m-0">
                            <x-input>
                                <x-slot name="type">submit</x-slot>
                                <x-slot name="inputcss">btn btn-primary ml-2</x-slot>
                                <x-slot name="name">Subscribe</x-slot>
                            </x-input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
</x-layout>
