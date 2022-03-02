<li class="border-y-2 border-gray-300 py-6 px-4 mb-2">
    <div class="top">
        <a href="{{ route('article.show', $article->id) }}">
            {{ $article->title }}
        </a>
        <span class="text-xs">{{ $article->created_at->diffForHumans() }}</span>
    </div>
    <x-articles.item-bottom :article="$article" />
</li>
