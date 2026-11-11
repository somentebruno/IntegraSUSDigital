@extends('layouts.app')

@section('title', $service->title . ' - IntegraSUS Digital MT')

@section('content')
    <!-- Banner de Topo com Breadcrumb -->
    <section class="bg-gradient-to-r from-sus-900 via-govmt-darkBlue to-sus-800 text-white py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-xs text-slate-300 mb-4" aria-label="Breadcrumb">
                <a href="{{ route('portal.index') }}" class="hover:text-white transition">Início</a>
                <span>/</span>
                <a href="{{ route('portal.services') }}" class="hover:text-white transition">Serviços</a>
                <span>/</span>
                <span class="text-white font-semibold">{{ $service->title }}</span>
            </nav>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-govmt-gold flex-shrink-0">
                    <x-dynamic-component :component="$service->icon" class="w-8 h-8" />
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <span class="text-xs font-bold text-govmt-green uppercase tracking-wider">
                            {{ $service->category_type }}
                        </span>
                        @if($service->partner)
                            <span class="text-xs text-slate-300 font-semibold">• {{ $service->partner }}</span>
                        @endif
                    </div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                        {{ $service->title }}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Conteúdo do Serviço -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Coluna Principal -->
            <div class="lg:col-span-8 space-y-10">
                <!-- Resumo em Destaque -->
                <div class="p-6 sm:p-8 rounded-3xl bg-sus-50 border border-sus-100 text-slate-800 font-medium text-base sm:text-lg leading-relaxed">
                    {{ $service->short_description }}
                </div>

                <!-- Detalhes Técnicos Rápidos -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Eixo Oficial</span>
                        <span class="text-sm font-bold text-govmt-blue">{{ $service->category_type }}</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Parceiro Ofertante</span>
                        <span class="text-sm font-bold text-slate-800">{{ $service->partner ?? 'SDMT / SES-MT' }}</span>
                    </div>
                    <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Tempo de Resposta</span>
                        <span class="text-sm font-bold text-emerald-700">{{ $service->response_time ?? 'Em tempo oportuno' }}</span>
                    </div>
                </div>

                <!-- Conteúdo Completo / Detalhamento -->
                <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-200/80 space-y-6">
                    <h2 class="text-2xl font-bold text-slate-900 border-b border-slate-100 pb-4">
                        Apresentação e Escopo Clínico
                    </h2>

                    <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed">
                        {!! $service->content !!}
                    </div>

                    @if($service->target_audience)
                        <div class="mt-8 p-5 rounded-2xl bg-slate-50 border border-slate-200">
                            <h3 class="text-sm font-bold text-slate-800 uppercase tracking-wider mb-2 flex items-center gap-2">
                                <x-heroicon-o-users class="w-5 h-5 text-govmt-blue" />
                                Público-Alvo e Critérios de Acesso
                            </h3>
                            <p class="text-sm text-slate-600">
                                {{ $service->target_audience }}
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Fluxo de Atendimento em Passos -->
                @if($service->flow_description)
                    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-200/80 space-y-6">
                        <h2 class="text-2xl font-bold text-slate-900 border-b border-slate-100 pb-4 flex items-center gap-2.5">
                            <x-heroicon-o-arrow-path-rounded-square class="w-6 h-6 text-govmt-green" />
                            Fluxo Operacional de Atendimento
                        </h2>

                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200 text-sm text-slate-700 whitespace-pre-line leading-relaxed font-sans">
                            {{ $service->flow_description }}
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar Lateral -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Card de Ação Rápida -->
                <div class="bg-gradient-to-tr from-govmt-blue to-sus-800 text-white rounded-3xl p-6 sm:p-8 shadow-xl space-y-4">
                    <h3 class="text-lg font-bold">Acesso à Plataforma</h3>
                    <p class="text-xs text-slate-200 leading-relaxed">
                        Médicos, cirurgiões-dentistas e equipes de saúde devem submeter casos através do sistema oficial de Telessaúde de Mato Grosso.
                    </p>
                    <a
                        href="https://servicos.saude.mt.gov.br/telessaude/"
                        target="_blank"
                        class="w-full inline-flex items-center justify-center gap-2 bg-govmt-green hover:bg-govmt-darkGreen text-white font-bold py-3.5 px-4 rounded-xl text-sm shadow-md transition"
                    >
                        <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4" />
                        Acessar Sistema de Telessaúde
                    </a>
                    <div class="pt-2 text-center">
                        <a href="https://wa.me/556536223660" target="_blank" class="text-xs text-sus-200 hover:text-white inline-flex items-center gap-1.5 transition">
                            <x-heroicon-o-phone class="w-4 h-4 text-emerald-300" />
                            Suporte Plataforma: (65) 3622-3660
                        </a>
                    </div>
                </div>

                <!-- Outros Serviços da SES-MT -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-4">
                    <h3 class="text-base font-bold text-slate-800 uppercase tracking-wider text-xs border-b border-slate-100 pb-3">
                        Outros Serviços do Catálogo
                    </h3>
                    <div class="space-y-3">
                        @foreach ($otherServices as $other)
                            <a
                                href="{{ route('services.show', $other->slug) }}"
                                class="flex items-center gap-3 p-3 rounded-xl hover:bg-slate-50 transition border border-transparent hover:border-slate-100 group"
                            >
                                <div class="w-10 h-10 rounded-xl bg-sus-50 text-govmt-blue flex items-center justify-center group-hover:bg-govmt-blue group-hover:text-white transition">
                                    <x-dynamic-component :component="$other->icon" class="w-5 h-5" />
                                </div>
                                <div class="flex-grow">
                                    <h4 class="text-sm font-semibold text-slate-800 group-hover:text-govmt-blue transition">
                                        {{ $other->title }}
                                    </h4>
                                    <span class="text-[11px] text-slate-400 block">{{ $other->category_type }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
