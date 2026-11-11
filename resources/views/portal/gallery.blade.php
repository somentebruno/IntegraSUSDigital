@extends('layouts.app')

@section('title', 'Galeria de Ações e Fotos nos Municípios - IntegraSUS Digital MT')

@section('content')
    <!-- Banner de Topo -->
    <section class="bg-gradient-to-r from-sus-900 via-govmt-darkBlue to-sus-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 text-xs font-bold text-govmt-gold uppercase tracking-wider">
                    Registros em Campo
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                    Galeria de Ações nos Municípios
                </h1>
                <p class="text-slate-200 text-base sm:text-lg">
                    Confira as fotos das capacitações regionais, visitas técnicas, entrega de equipamentos e mutirões de telediagnóstico realizados pela SES-MT.
                </p>
            </div>
        </div>
    </section>

    <!-- Componente Livewire de Galeria e Modal Lightbox -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        @livewire('photo-gallery')
    </div>
@endsection
