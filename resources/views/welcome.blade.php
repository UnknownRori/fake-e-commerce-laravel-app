<x-layout>
    <x-slot name="title">Home</x-slot>

    <x-slot name="navbar">
        <li class="nav-item">
            <a href="#featured" class="nav-link">Featured</a>
        </li>
        <li class="nav-item">
            <a href="#about" class="nav-link">About</a>
        </li>
    </x-slot>

    <x-slot name="content">
        <section id="company-logo" class="blog-welcome text-center">
            <header style="padding-top: 100px;">
                <img class="" style="width: 150px;" src="{{ asset("image/Apple.png") }}" alt="">
                <h2 id="company_introduction"></h2>
            </header>
        </section>
        <div class="container">

            <main id="featured">
                <header>
                    <h2 id="title" class="text-center">Current Featured Product</h2>
                </header>
                <section>
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

            <div id="subscribe">
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

        <footer id="about" class="bg-dark row text-center text-white">
            <div class="col-6">
                <header>
                    <h3>
                        Lorem ipsum dolor
                    </h3>
                </header>
                <article>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quibusdam corrupti eos quasi voluptate ea provident quae corporis laudantium,
                    eaque quas nesciunt ratione possimus nulla magnam dignissimos! Natus, saepe doloremque?
                </article>
            </div>
            <div class="col-6">
                <header>
                    <h3>
                        Lorem ipsum dolor
                    </h3>
                </header>
                <article>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quibusdam corrupti eos quasi voluptate ea provident quae corporis laudantium,
                    eaque quas nesciunt ratione possimus nulla magnam dignissimos! Natus, saepe doloremque?
                </article>
            </div>
            <div class="m-auto pt-3">
                <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit</h2>
            </div>
        </footer>
    </x-slot>
</x-layout>
