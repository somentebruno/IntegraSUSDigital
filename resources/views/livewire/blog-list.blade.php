<div>
    <!-- Filtros e Busca -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 mb-10">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <!-- Barra de Busca -->
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                </div>
                <input
                    type="text"
                    wire:model.live.debounce.350ms="search"
                    placeholder="Pesquisar notícias, ações ou artigos..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 focus:border-sus-600 focus:ring-4 focus:ring-sus-100 transition text-sm text-slate-800 placeholder-slate-400"
                />
                @if($search)
                    <button
                        wire:click="$set('search', '')"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600"
                    >
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                    </button>
                @endif
            </div>

            <!-- Categorias -->
            <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                <button
                    wire:click="selectCategory('')"
                    class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition {{ empty($selectedCategory) ? 'bg-govmt-blue text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
                >
                    Todas as Notícias
                </button>
                @foreach ($categories as $cat)
                    <button
                        wire:click="selectCategory('{{ $cat->slug }}')"
                        class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition {{ $selectedCategory === $cat->slug ? 'bg-govmt-blue text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
                    >
                        {{ $cat->name }} ({{ $cat->posts_count }})
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Indicador de Carregamento -->
    <div wire:loading class="w-full py-8 text-center text-sus-600">
        <div class="inline-flex items-center gap-2">
            <x-heroicon-o-arrow-path class="w-6 h-6 animate-spin" />
            <span class="font-medium text-sm">Carregando notícias...</span>
        </div>
    </div>

    <!-- Grid de Notícias -->
    <div wire:loading.remove>
        @if ($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 flex flex-col group">
                        <!-- Imagem de Capa ou Placeholder Institucional -->
                        <div class="relative h-48 bg-gradient-to-tr from-sus-900 to-sus-700 overflow-hidden">
                            @if($post->featured_image)
                                <img
                                    src="{{ asset('storage/' . $post->featured_image) }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                />
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-sus-800 to-govmt-darkBlue p-6">
                                    <x-heroicon-o-newspaper class="w-16 h-16 text-white/30" />
                                </div>
                            @endif

                            @if($post->category)
                                <span class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm text-sus-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                    {{ $post->category->name }}
                                </span>
                            @endif
                        </div>

                        <!-- Conteúdo do Card -->
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-2 text-xs text-slate-500 mb-3">
                                <x-heroicon-o-calendar class="w-4 h-4 text-sus-600" />
                                <time datetime="{{ $post->published_at?->toDateString() }}">
                                    {{ $post->published_at?->translatedFormat('d \d\e F \d\e Y') ?? 'Recente' }}
                                </time>
                            </div>

                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-sus-600 transition mb-3 line-clamp-2">
                                <a href="{{ route('posts.show', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <p class="text-slate-600 text-sm mb-6 line-clamp-3 flex-grow">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                            </p>

                            <div class="pt-4 border-t border-slate-100 mt-auto">
                                <a
                                    href="{{ route('posts.show', $post->slug) }}"
                                    class="inline-flex items-center gap-2 text-sus-700 hover:text-sus-900 font-semibold text-sm group-hover:translate-x-1 transition-transform"
                                >
                                    Ler matéria completa
                                    <x-heroicon-o-arrow-right class="w-4 h-4" />
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center border border-slate-200">
                <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <x-heroicon-o-magnifying-glass class="w-8 h-8" />
                </div>
                <h4 class="text-lg font-bold text-slate-800 mb-1">Nenhuma publicação encontrada</h4>
                <p class="text-slate-600 text-sm max-w-md mx-auto">
                    Não encontramos nenhuma matéria com o termo ou categoria selecionados. Tente buscar com outras palavras.
                </p>
                @if($search || $selectedCategory)
                    <button
                        wire:click="$set('search', ''); $set('selectedCategory', '')"
                        class="mt-4 inline-flex items-center gap-2 text-sus-600 font-semibold text-sm hover:underline"
                    >
                        Limpar todos os filtros
                    </button>
                @endif
            </div>
        @endif
    </div>
</div>
