@extends('layouts.app')

@section('title', 'Notícias e Comunicação - IntegraSUS Digital Mato Grosso')

@section('content')
    <!-- Banner de Topo -->
    <section class="bg-gradient-to-r from-sus-900 via-govmt-darkBlue to-sus-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 text-xs font-bold text-govmt-gold uppercase tracking-wider">
                    Sala de Imprensa & Artigos Técnicos
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                    Notícias e Ações
                </h1>
                <p class="text-slate-200 text-base sm:text-lg">
                    Acompanhe as capacitações, implantações de equipamentos nos polos regionais e avanços da saúde digital no estado de Mato Grosso.
                </p>
            </div>
        </div>
    </section>

    <!-- Componente Livewire de Busca e Lista -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @livewire('blog-list')
    </div>
@endsection
