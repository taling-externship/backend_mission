<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@meilisearch/instant-meilisearch/templates/basic_search.css" />
</head>

<body>

<hr class="bg-blue-400 hover:bg-blue-700 hidden" />
<hr class="bg-red-400 hover:bg-red-700 hidden" />

<main class="container mx-auto px-4 my-4 max-w-xl">

    @yield('content')

    <x-flash />

</main>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@meilisearch/instant-meilisearch@0.3.2/dist/instant-meilisearch.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4"></script>
<script>
    (function(){
        const search = instantsearch({
            indexName: "articles",
            searchClient: instantMeiliSearch(
                "http://127.0.0.1:7700"
            )
        });

        search.addWidgets([
            instantsearch.widgets.searchBox({
                container: "#searchbox",
                cssClasses: {
                    input: ['search-input']
                }
            }),
            instantsearch.widgets.configure({ hitsPerPage: 8 }),
            instantsearch.widgets.hits({
                container: "#hits",
                templates: {
                item: `
                    <div>
                    <div class="hit-name">
                        <a href="/article/@{{ id }}">
                            @{{#helpers.highlight}}{ "attribute": "title" }@{{/helpers.highlight}}
                            <small class="text-xs">@{{ created_at }}</small>
                        </a>
                    </div>
                    </div>
                `
                },
                transformItems(items) {
                    return items.map(item => ({
                        ...item,
                        created_at: (new Date(item.created_at)).toLocaleString(),
                    }));
                },
            })
        ]);

        search.start();

        document.querySelector('.search-input').addEventListener('focus', (e) => {
            document.querySelector('#hits').style.display = "block";
        });

        document.querySelector('.search-input').addEventListener('blur', (e) => {
            if(e.relatedTarget?.tagName.toLowerCase() !== 'a'){
                document.querySelector('#hits').style.display = "";
            }
        });
    })();
</script>
</body>

</html>
