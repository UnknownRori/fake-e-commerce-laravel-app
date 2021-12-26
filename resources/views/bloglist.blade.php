<x-layout>
    <x-slot name="title">Blog</x-slot>

    <x-slot name="content">
        <main>
            <section class="blog-welcome text-center">
                <header class="" style="padding-top: 10rem;">
                    <img class="" style="width: 150px;" src="{{ asset("image/Apple.png") }}" alt="">
                    <h2 class="text-center" id="blog_introduction"></h2>
                </header>
            </section>

            <div class="container">
                <article>
                    @foreach ($blog as $row)
                        <div class="row hidden" data-hidden="{{ $row->id }}">
                            <div class="col-4">
                                <a href="{{ route("Blog", $row->id) }}">
                                    <img class="img-fluid" src="{{ Storage::url('/image/blog/' . $row->title . '.png') }}" alt="{{ $row->title }}">
                                </a>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-8">
                                        <a href="{{ route("Blog", $row->id) }}">
                                            <h3 class="ml-1 text-black">{{ $row->title }}</h3>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        @auth
                                            <div class="float-right dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu popout" aria-labelledby="dropdownMenuButton" style="margin-right: 2rem;">
                                                    @if (Auth::user()->id == $row->users_id)
                                                        <a href="{{ route("EditBlog", $row->id) }}" class="dropdown-item">Edit</a>
                                                    @endif

                                                    @if (Auth::user()->id == $row->users_id || Auth::user()->admin )
                                                        <form action="{{ route('DeleteBlog', $row->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="submit" value="Delete" class="dropdown-item">
                                                        </form>
                                                    @endif

                                                    @if (Auth::user()->id != $row->users_id)
                                                        <a class="dropdown-item" href="#">Report</a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                                <p class="ml-1">
                                    {{ $row->content }}
                                </p>
                            </div>
                        </div>
                    @endforeach
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
