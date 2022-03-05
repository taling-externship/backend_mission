<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@meilisearch/instant-meilisearch/templates/basic_search.css" />

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <input type="hidden" aria-value="meaning less" class="bg-red-400">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <header class="mb-6">
                    <div class="search-wrapper wrapper">
                        <div id="searchbox"></div>
                        <div id="hits"></div>
                    </div>
                </header>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}

            <x-flash />
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@meilisearch/instant-meilisearch@0.3.2/dist/instant-meilisearch.umd.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4"></script>
    <script>
        (function() {
            const search = instantsearch({
                indexName: "articles",
                searchClient: instantMeiliSearch(
                    "{{ config('scout.meilisearch.host') }}"
                )
            });

            search.addWidgets([
                instantsearch.widgets.searchBox({
                    container: "#searchbox",
                    cssClasses: {
                        input: ['search-input']
                    }
                }),
                instantsearch.widgets.configure({
                    hitsPerPage: 8
                }),
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
                if (e.relatedTarget?.tagName.toLowerCase() !== 'a') {
                    document.querySelector('#hits').style.display = "";
                }
            });
        })();
    </script>
</body>

</html>
