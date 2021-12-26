<x-layout>
    <x-slot name="title">{{ $Blog->title }}</x-slot>

    <x-slot name="content">
        <main>
            <header class="text-center">
                <img class="img-fluid w-25" src="{{ Storage::url('/image/blog/' . $Blog->title . '.png') }}" alt="{{ $Blog->title }}">
                <h2>
                    {{ $Blog->title }}
                </h2>
            </header>
            <article>
                <p id="#content">
                    {{ $Blog->content }}
                </p>

                <div class="mt-5">
                    <p>
                        Last Update : <b>{{ $Blog->updated_at }}</b>
                    </p>

                    <p>
                        Author : <b>{{ $Blog->user->username }}</b>
                    </p>
                </div>
            </article>
        </main>
    </x-slot>
</x-layout>
