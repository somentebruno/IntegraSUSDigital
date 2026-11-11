@extends('layouts.app')

@section('title', $post->title . ' - IntegraSUS Digital MT')
@section('meta_description', Str::limit(strip_tags($post->excerpt ?? $post->content), 160))

@section('content')
    <!-- Banner de Topo com Breadcrumb -->
    <section class="bg-gradient-to-r from-sus-900 via-govmt-darkBlue to-sus-800 text-white py-14">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs text-slate-300 mb-6" aria-label="Breadcrumb">
                <a href="{{ route('portal.index') }}" class="hover:text-white transition">Início</a>
                <span>/</span>
                <a href="{{ route('portal.posts') }}" class="hover:text-white transition">Notícias</a>
                <span>/</span>
                <span class="text-white font-semibold truncate">{{ $post->title }}</span>
            </nav>

            <div class="space-y-4">
                @if($post->category)
                    <span class="inline-block bg-govmt-green/90 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        {{ $post->category->name }}
                    </span>
                @endif

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-6 text-xs text-slate-300 pt-2 border-t border-white/10">
                    <span class="flex items-center gap-1.5">
                        <x-heroicon-o-calendar class="w-4 h-4 text-sus-400" />
                        {{ $post->published_at?->translatedFormat('d \d\e F \d\e Y') ?? 'Publicado recentemente' }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <x-heroicon-o-clock class="w-4 h-4 text-sus-400" />
                        Tempo de leitura: ~3 min
                    </span>
                    <span class="flex items-center gap-1.5">
                        <x-heroicon-o-shield-check class="w-4 h-4 text-govmt-green" />
                        Assessoria SES-MT
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Artigo e Conteúdo -->
    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @if($post->featured_image)
            <div class="mb-10 rounded-3xl overflow-hidden shadow-lg border border-slate-200">
                <img
                    src="{{ asset('storage/' . $post->featured_image) }}"
                    alt="{{ $post->title }}"
                    class="w-full h-auto max-h-[500px] object-cover"
                />
            </div>
        @endif

        @if($post->excerpt)
            <div class="mb-10 p-6 rounded-2xl bg-sus-50/70 border-l-4 border-govmt-blue text-lg font-medium text-slate-800 leading-relaxed">
                {{ $post->excerpt }}
            </div>
        @endif

        <!-- Corpo da Notícia -->
        <div class="prose prose-lg prose-slate max-w-none text-slate-700 leading-relaxed space-y-6">
            {!! $post->content !!}
        </div>

        <!-- Barra de Compartilhamento -->
        <div class="mt-14 pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <span class="text-sm font-bold text-slate-700">Compartilhe esta informação:</span>
            <div class="flex items-center gap-3">
                <a
                    href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . url()->current()) }}"
                    target="_blank"
                    class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition"
                >
                    <x-heroicon-o-chat-bubble-oval-left-ellipsis class="w-4 h-4" />
                    WhatsApp
                </a>
                <button
                    type="button"
                    onclick="navigator.clipboard.writeText(window.location.href); alert('Link copiado para a área de transferência!');"
                    class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold px-4 py-2.5 rounded-xl border border-slate-200 transition"
                >
                    <x-heroicon-o-link class="w-4 h-4" />
                    Copiar Link
                </button>
            </div>
        </div>

        <!-- Matérias Relacionadas -->
        @if($relatedPosts->count() > 0)
            <div class="mt-16 pt-12 border-t border-slate-200">
                <h3 class="text-2xl font-bold text-slate-900 mb-8">Notícias Relacionadas</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($relatedPosts as $rel)
                        <div class="bg-white rounded-2xl p-5 border border-slate-200 hover:shadow-lg transition">
                            <span class="text-[11px] font-bold text-govmt-blue uppercase">
                                {{ $rel->category?->name ?? 'Notícia' }}
                            </span>
                            <h4 class="text-base font-bold text-slate-800 hover:text-govmt-blue transition mt-2 mb-2 line-clamp-2">
                                <a href="{{ route('posts.show', $rel->slug) }}">
                                    {{ $rel->title }}
                                </a>
                            </h4>
                            <p class="text-xs text-slate-500 line-clamp-2">
                                {{ $rel->excerpt ?? Str::limit(strip_tags($rel->content), 80) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </article>
@endsection
