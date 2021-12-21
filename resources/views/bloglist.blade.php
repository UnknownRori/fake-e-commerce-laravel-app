<x-layout>
    <x-slot name="title">Blog</x-slot>

    <x-slot name="content">
        <main>
            <header class="blog-welcome">
                <h2>Blog</h2>
            </header>

            <div class="container">
                <article>
                    <table>
                        @foreach ($blog as $row)
                        <tr>
                            <td rowspan="2" class="img-container">
                                <img class="img-fluid" src="{{ asset("image/blog/" . $row->title) . ".png" }}" alt="{{ $row->title }}">
                            </td>
                            <td>
                                <h3 class="ml-1">{{ $row->title }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="ml-1">
                                    {{ $row->content }}
                                </p>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </article>
                <x-paginatebutton>
                    <x-slot name="prev">
                        {{ $blog->previousPageUrl() }}
                    </x-slot>
                    <x-slot name="next">
                        {{ $blog->nextPageUrl() }}
                    </x-slot>
                </x-paginatebutton>
            </div>
        </main>
    </x-slot>
</x-layout>