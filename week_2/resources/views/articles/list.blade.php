<x-app-layout>
    <section class="my-4">
        <ul>
        @forelse ($articles as $article)
            <x-articles.item>
                <a href="{{ route('article.show', $article->id) }}">
                    {{ $article->title }}
                </a>
                <span class="text-xs">{{ $article->created_at->diffForHumans() }}</span>
                <p class="text-right mt-2">
                    @foreach ($article->tags as $tag)
                        <x-articles.tag>{{ $tag->name }}</x-articles.tag>
                    @endforeach
                </p>
            </x-articles.item>
        @empty
            <p>No articles yet...</p>
        @endforelse
        </ul>
    </section>

    @if( $articles )
    <section class="pagination">
        {{ $articles->links() }}
    </section>
    @endif

    <section class="control my-4">
        @can('create', 'App\\Models\\Article')
        <x-forms.anchor
        href="{{ route('article.create') }}"
        color="blue"
        name="make new" />
        @endcan
    </section>

</x-app-layout>
