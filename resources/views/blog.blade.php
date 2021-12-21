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
                                <h3 style="margin-left: 5px;">{{ $row->title }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td style="margin-left: 5px;">
                                <p style="margin-left: 5px;">
                                    {{ $row->content }}
                                </p>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </article>
            </div>
        </main>
    </x-slot>
</x-layout>
