@extends('layouts.app')

@section('title', 'Serviços de Telessaúde e Telediagnósticos - IntegraSUS Digital MT')

@section('content')
    <!-- Banner de Topo -->
    <section class="bg-gradient-to-r from-sus-900 via-govmt-darkBlue to-sus-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 text-xs font-bold text-govmt-gold uppercase tracking-wider">
                    Catálogo Oficial de Telessaúde SES-MT
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                    Serviços Ofertados
                </h1>
                <p class="text-slate-200 text-base sm:text-lg">
                    Conheça as modalidades assistenciais e telediagnósticos disponibilizados para as equipes de saúde pública dos 142 municípios de Mato Grosso.
                </p>
            </div>
        </div>
    </section>

    <!-- Navegação em Abas / Eixos Estruturados -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" x-data="{ currentTab: 'todos' }">
        <!-- Filtros por Eixo -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-16">
            <button
                type="button"
                @click="currentTab = 'todos'"
                :class="currentTab === 'todos' ? 'bg-govmt-blue text-white shadow-md shadow-blue-900/20' : 'bg-white text-slate-700 border border-slate-200 hover:border-govmt-blue hover:text-govmt-blue'"
                class="px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition cursor-pointer"
            >
                Todos os Serviços ({{ $services->count() }})
            </button>
            <button
                type="button"
                @click="currentTab = 'ambulatorio'"
                :class="currentTab === 'ambulatorio' ? 'bg-govmt-blue text-white shadow-md shadow-blue-900/20' : 'bg-white text-slate-700 border border-slate-200 hover:border-govmt-blue hover:text-govmt-blue'"
                class="px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition cursor-pointer flex items-center gap-2"
            >
                <x-heroicon-o-chat-bubble-left-right class="w-4 h-4 text-govmt-green" />
                Ambulatório de Telessaúde
            </button>
            <button
                type="button"
                @click="currentTab = 'estadual'"
                :class="currentTab === 'estadual' ? 'bg-govmt-blue text-white shadow-md shadow-blue-900/20' : 'bg-white text-slate-700 border border-slate-200 hover:border-govmt-blue hover:text-govmt-blue'"
                class="px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition cursor-pointer flex items-center gap-2"
            >
                <x-heroicon-o-shield-check class="w-4 h-4 text-govmt-gold" />
                Telediagnóstico Estadual (SDMT/SES)
            </button>
            <button
                type="button"
                @click="currentTab = 'nacional'"
                :class="currentTab === 'nacional' ? 'bg-govmt-blue text-white shadow-md shadow-blue-900/20' : 'bg-white text-slate-700 border border-slate-200 hover:border-govmt-blue hover:text-govmt-blue'"
                class="px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition cursor-pointer flex items-center gap-2"
            >
                <x-heroicon-o-globe-alt class="w-4 h-4 text-sus-400" />
                Telediagnóstico Nacional (UFG / UFMG / Redes Nacionais)
            </button>
            <button
                type="button"
                @click="currentTab = 'educacao'"
                :class="currentTab === 'educacao' ? 'bg-govmt-blue text-white shadow-md shadow-blue-900/20' : 'bg-white text-slate-700 border border-slate-200 hover:border-govmt-blue hover:text-govmt-blue'"
                class="px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition cursor-pointer flex items-center gap-2"
            >
                <x-heroicon-o-academic-cap class="w-4 h-4 text-emerald-500" />
                Tele-Educação (Tele-Educa MT)
            </button>
        </div>

        <!-- Lista de Cards de Serviços -->
        <div class="space-y-10">
            @foreach ($services as $srv)
                @php
                    $tabCategory = match ($srv->category_type) {
                        'Ambulatório de Telessaúde' => 'ambulatorio',
                        'Telediagnóstico - Oferta Estadual' => 'estadual',
                        'Telediagnóstico - Oferta Nacional' => 'nacional',
                        'Tele-Educação' => 'educacao',
                        default => 'outros',
                    };
                @endphp

                <div
                    x-show="currentTab === 'todos' || currentTab === '{{ $tabCategory }}'"
                    x-transition
                    class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-200/80 hover:shadow-xl transition-all duration-300"
                >
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                        <!-- Coluna do Ícone, Badges e Descrição -->
                        <div class="lg:col-span-8 space-y-4">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider bg-sus-100 text-govmt-blue">
                                    {{ $srv->category_type }}
                                </span>
                                @if($srv->partner)
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-100 text-slate-700">
                                        {{ $srv->partner }}
                                    </span>
                                @endif
                                @if($srv->response_time)
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 flex items-center gap-1">
                                        <x-heroicon-o-clock class="w-3.5 h-3.5" />
                                        {{ $srv->response_time }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center gap-4 pt-1">
                                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-sus-50 text-govmt-blue flex items-center justify-center flex-shrink-0">
                                    <x-dynamic-component :component="$srv->icon" class="w-8 h-8" />
                                </div>
                                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                                    <a href="{{ route('services.show', $srv->slug) }}" class="hover:text-govmt-blue transition">
                                        {{ $srv->title }}
                                    </a>
                                </h2>
                            </div>

                            <p class="text-slate-700 text-base leading-relaxed">
                                {{ $srv->short_description }}
                            </p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 text-xs text-slate-600">
                                @if($srv->target_audience)
                                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                        <span class="font-bold text-slate-800 block mb-0.5">Público-Alvo:</span>
                                        {{ $srv->target_audience }}
                                    </div>
                                @endif
                                @if($srv->technical_responsible)
                                    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                        <span class="font-bold text-slate-800 block mb-0.5">Responsabilidade Técnica:</span>
                                        {{ $srv->technical_responsible }}
                                    </div>
                                @endif
                            </div>

                            @if($srv->flow_description)
                                <div class="space-y-1.5 pt-2">
                                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Fluxo do Atendimento:</h4>
                                    <div class="text-xs text-slate-700 whitespace-pre-line leading-relaxed bg-blue-50/40 p-4 rounded-xl border border-blue-100/60 font-mono">
                                        {{ $srv->flow_description }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Coluna Lateral de Ações e Acesso -->
                        <div class="lg:col-span-4 bg-slate-50 rounded-2xl p-6 border border-slate-200/80 space-y-4 self-stretch flex flex-col justify-between">
                            <div class="space-y-2">
                                <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Acesso ao Serviço</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Os profissionais habilitados devem estar cadastrados na plataforma estadual ou nos polos regionais correspondentes.
                                </p>
                            </div>

                            <div class="space-y-3 pt-4">
                                <a
                                    href="{{ route('services.show', $srv->slug) }}"
                                    class="w-full inline-flex items-center justify-center gap-2 bg-govmt-blue hover:bg-govmt-darkBlue text-white font-bold py-3.5 px-4 rounded-xl text-sm transition shadow-sm"
                                >
                                    Ver Detalhes e Especialidades
                                    <x-heroicon-o-arrow-right class="w-4 h-4" />
                                </a>

                                <a
                                    href="https://servicos.saude.mt.gov.br/telessaude/"
                                    target="_blank"
                                    class="w-full inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-100 text-slate-700 font-semibold py-3 px-4 rounded-xl border border-slate-200 text-sm transition"
                                >
                                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4 text-sus-600" />
                                    Acessar Sistema
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
