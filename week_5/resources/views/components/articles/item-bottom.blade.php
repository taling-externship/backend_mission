<div class="bottom flex justify-between p-8">
    <form action="{{ route($article->myLoved ? 'love.destroy' : 'love.store', ['article' => $article, 'love' => $article->myLoved]) }}" method="POST">
        @csrf
        @method($article->myLoved ? 'DELETE' : 'POST')

        <button class="flex gap-4">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 stroke-red-500
                    {{ $article->myLoved ? 'fill-red-500' : 'fill-transparent' }}
                    {{ $article->myLoved ? 'include-me' : '' }}
                " viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <span class="" title="loves-count">{{ $article->love->count() }}</span>
        </button>
    </form>
    <p class="text-right mt-2">
        @foreach ($article->tags as $tag)
            <x-articles.tag>{{ $tag->name }}</x-articles.tag>
        @endforeach
    </p>
</div>
