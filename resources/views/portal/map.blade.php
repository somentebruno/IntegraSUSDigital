@extends('layouts.app')

@section('title', 'Mapa Estadual de Cobertura - IntegraSUS Digital MT')

@section('content')
<div class="bg-slate-50 min-h-screen py-6 sm:py-8" x-data="mapaMatoGrosso()">
    <div class="max-w-[1720px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Cabeçalho Institucional Superior -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-xs font-bold text-govmt-blue uppercase tracking-wider mb-1.5">
                    <span class="w-2 h-2 rounded-full bg-govmt-green animate-pulse"></span>
                    Regionalização Oficial do SUS / SES-MT
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                    Cobertura Estadual de Saúde Digital em Mato Grosso
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Visualização vetorial interativa com 100% dos municípios integrados à rede estadual, segmentados por <strong>6 Macrorregiões</strong> e <strong>16 Microrregiões de Saúde (CIR)</strong>.
                </p>
            </div>

            <!-- Resumo Rápido e Botão Redefinir -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2.5 bg-white px-4 py-2.5 rounded-2xl border border-slate-200/90 shadow-xs">
                    <span class="w-3 h-3 rounded-full bg-[#004B8D] ring-2 ring-blue-300/40"></span>
                    <span class="text-xs font-bold text-slate-700">142 Municípios • 6 Macrorregiões • 16 Micros • 3,65 Mi Hab.</span>
                </div>
                <button
                    type="button"
                    @click="resetMap()"
                    class="px-4 py-2.5 rounded-2xl bg-white border border-slate-200/90 hover:bg-slate-50 text-xs font-bold text-slate-700 transition shadow-xs inline-flex items-center gap-2 cursor-pointer"
                    title="Centralizar e redefinir visão"
                >
                    <x-heroicon-o-arrow-path class="w-4 h-4 text-govmt-blue" />
                    <span>Redefinir Visão</span>
                </button>
            </div>
        </div>

        <!-- Layout Panorâmico: O MAPA DOMINA A TELA (Canvas Gigante e Espaçoso) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- Coluna Principal do Mapa: 9 a 10 Colunas para Máxima Amplitude -->
            <div class="lg:col-span-9 xl:col-span-10 bg-white rounded-3xl border border-slate-200/90 shadow-sm relative overflow-hidden flex flex-col justify-between p-4 sm:p-6 min-h-[720px] lg:min-h-[820px] space-y-4">
                
                <!-- PAINEL SUPERIOR DO MAPA: Filtros de Macrorregiões e Microrregiões + Busca -->
                <div class="space-y-3 pb-3 border-b border-slate-100 z-10">
                    
                    <!-- Linha 1: Seletor de Nível (Macrorregiões vs Microrregiões vs Neutro) + Busca -->
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3">
                        
                        <!-- Tabs de Nível de Regionalização -->
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 text-xs font-black uppercase tracking-wider text-slate-500 mr-1">
                                <x-heroicon-o-funnel class="w-4 h-4 text-govmt-blue" />
                                <span>Regionalização:</span>
                            </span>

                            <!-- Aba: 6 Macrorregiões -->
                            <button
                                type="button"
                                @click="setFilterLevel('macro')"
                                class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-2 cursor-pointer border"
                                :class="filterLevel === 'macro'
                                    ? 'bg-govmt-blue text-white border-govmt-blue shadow-xs ring-2 ring-blue-300/40'
                                    : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'"
                            >
                                <span class="flex -space-x-1 items-center">
                                    <span class="w-2 h-2 rounded-full bg-blue-400 ring-1 ring-white"></span>
                                    <span class="w-2 h-2 rounded-full bg-emerald-400 ring-1 ring-white"></span>
                                    <span class="w-2 h-2 rounded-full bg-amber-400 ring-1 ring-white"></span>
                                </span>
                                <span>6 Macrorregiões</span>
                            </button>

                            <!-- Aba: 16 Microrregiões / CIR -->
                            <button
                                type="button"
                                @click="setFilterLevel('micro')"
                                class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-2 cursor-pointer border"
                                :class="filterLevel === 'micro'
                                    ? 'bg-emerald-700 text-white border-emerald-700 shadow-xs ring-2 ring-emerald-300/40'
                                    : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'"
                            >
                                <span class="flex -space-x-1 items-center">
                                    <span class="w-2 h-2 rounded-full bg-purple-400 ring-1 ring-white"></span>
                                    <span class="w-2 h-2 rounded-full bg-teal-400 ring-1 ring-white"></span>
                                    <span class="w-2 h-2 rounded-full bg-pink-400 ring-1 ring-white"></span>
                                </span>
                                <span>16 Microrregiões (CIR)</span>
                            </button>

                            <!-- Aba: Visão Neutra -->
                            <button
                                type="button"
                                @click="setFilterLevel('padrao')"
                                class="px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 cursor-pointer border"
                                :class="filterLevel === 'padrao' && !distanceMode
                                    ? 'bg-slate-800 text-white border-slate-800 shadow-xs'
                                    : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100'"
                            >
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                <span>Visão Neutra</span>
                            </button>

                            <span class="w-px h-5 bg-slate-200 hidden sm:inline"></span>

                            <!-- Botão de Destaque: Régua de Distâncias & Conexões -->
                            <button
                                type="button"
                                @click="toggleDistanceMode()"
                                class="px-3.5 py-1.5 rounded-xl text-xs font-black transition flex items-center gap-2 cursor-pointer border"
                                :class="distanceMode
                                    ? 'bg-amber-500 text-slate-950 border-amber-500 shadow-md ring-2 ring-amber-300'
                                    : 'bg-white text-slate-700 border-slate-200 hover:border-amber-400 hover:bg-amber-50/60'"
                                title="Medir distâncias entre municípios, Escritório Regional (ERS) e Capital no mapa"
                            >
                                <span class="flex items-center justify-center w-4 h-4 rounded-full bg-amber-400 text-slate-950 text-[10px] font-black">📏</span>
                                <span>Régua de Distâncias</span>
                                <span
                                    class="text-[9px] font-extrabold px-1.5 py-0.2 rounded-md uppercase tracking-wider"
                                    :class="distanceMode ? 'bg-slate-950 text-amber-300' : 'bg-amber-100 text-amber-800'"
                                >
                                    Novo
                                </span>
                            </button>
                        </div>

                        <!-- Busca rápida de municípios -->
                        <div class="relative w-full sm:w-72">
                            <x-heroicon-o-magnifying-glass class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
                            <input
                                type="text"
                                x-model="searchQuery"
                                @input="filterMunicipios()"
                                placeholder="Buscar município no mapa..."
                                class="w-full pl-9 pr-8 py-2 rounded-xl bg-slate-50/80 border border-slate-200 focus:bg-white focus:border-govmt-blue focus:ring-2 focus:ring-govmt-blue/20 text-xs font-medium transition"
                            >
                            <button
                                type="button"
                                x-show="searchQuery.length > 0"
                                @click="searchQuery = ''; filteredList = []"
                                class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 cursor-pointer"
                            >
                                <x-heroicon-o-x-mark class="w-3.5 h-3.5" />
                            </button>

                            <!-- Autocomplete Dropdown suspenso -->
                            <div
                                x-show="searchQuery.length >= 2"
                                class="absolute top-full left-0 right-0 mt-1 max-h-60 overflow-y-auto bg-white rounded-2xl shadow-xl border border-slate-200/90 divide-y divide-slate-100 z-30"
                                style="display: none;"
                            >
                                <template x-for="mun in filteredList" :key="mun.codarea">
                                    <button
                                        type="button"
                                        @click="selectMunicipioByCod(mun.codarea)"
                                        class="w-full text-left px-3.5 py-2.5 text-xs font-semibold hover:bg-blue-50 hover:text-govmt-blue transition flex items-center justify-between cursor-pointer"
                                    >
                                        <div>
                                            <span x-text="mun.nome" class="block font-bold text-slate-800"></span>
                                            <span class="text-[10px] text-slate-400 font-normal" x-text="(mun.populacao_formatada || '') + (mun.regiao_saude ? ' • Micro ' + mun.regiao_saude : '')"></span>
                                        </div>
                                        <div class="text-right">
                                            <span
                                                class="text-[9px] font-bold px-2 py-0.5 rounded-full block mb-0.5"
                                                :class="macroConfig[mun.macrorregiao] ? macroConfig[mun.macrorregiao].badgeBg + ' ' + macroConfig[mun.macrorregiao].badgeText : 'bg-slate-100 text-slate-600'"
                                                x-text="mun.macrorregiao"
                                            ></span>
                                            <span class="text-[9px] text-slate-400 font-mono" x-text="mun.polo_micro ? 'ERS ' + mun.polo_micro : ''"></span>
                                        </div>
                                    </button>
                                </template>
                                <div x-show="filteredList.length === 0" class="p-3 text-xs text-slate-400 text-center">
                                    Nenhum município encontrado
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- PAINEL INTERATIVO DA RÉGUA DE DISTÂNCIAS (Ativo quando distanceMode === true) -->
                    <div
                        x-show="distanceMode"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="p-4 rounded-3xl bg-gradient-to-r from-amber-500/10 via-amber-50/80 to-orange-50/70 border-2 border-amber-400/90 shadow-sm space-y-3"
                    >
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-2xl bg-amber-500 text-slate-950 flex items-center justify-center font-black text-base shadow-xs shrink-0">
                                    📏
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="text-sm font-black text-slate-900 tracking-tight">
                                            Régua de Conectividade Territorial & Distâncias em MT
                                        </h3>
                                        <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded-full bg-amber-200 text-amber-950">
                                            Geodésico & Rodoviário
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-600">
                                        Selecione os municípios pelo mapa ou pela busca para calcular a distância entre eles, até o Escritório Regional de Saúde (ERS) e até a Capital.
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 self-end lg:self-auto shrink-0">
                                <button
                                    type="button"
                                    @click="invertPoints()"
                                    class="px-3 py-1.5 rounded-xl bg-white hover:bg-slate-50 text-slate-700 font-bold border border-slate-200 text-xs transition shadow-xs inline-flex items-center gap-1.5 cursor-pointer"
                                    title="Inverter Município Origem e Destino"
                                >
                                    <x-heroicon-o-arrows-right-left class="w-3.5 h-3.5 text-amber-600" />
                                    <span>Inverter Pontos (⇄)</span>
                                </button>
                                <button
                                    type="button"
                                    @click="disableDistanceMode()"
                                    class="px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition shadow-xs inline-flex items-center gap-1.5 cursor-pointer"
                                >
                                    <x-heroicon-o-x-mark class="w-3.5 h-3.5 text-slate-400" />
                                    <span>Fechar Régua</span>
                                </button>
                            </div>
                        </div>

                        <!-- Seleção Interativa: Origem vs Destino -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-11 gap-3 items-start pt-1">
                            
                            <!-- Box 1: Município Origem -->
                            <div class="lg:col-span-5 relative space-y-1.5">
                                <div
                                    class="p-3 rounded-2xl bg-white border-2 transition cursor-pointer flex items-center justify-between gap-2 shadow-xs"
                                    :class="pickingTarget === 'origem' ? 'border-amber-500 ring-2 ring-amber-300/40 bg-amber-50/30' : 'border-slate-200 hover:border-slate-300'"
                                    @click="pickingTarget = 'origem'"
                                >
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <span class="w-8 h-8 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-sm font-black shrink-0">
                                            🚩
                                        </span>
                                        <div class="min-w-0">
                                            <span class="text-[9px] uppercase font-black text-amber-700 tracking-wider block">1. MUNICÍPIO ORIGEM</span>
                                            <h4 class="text-sm font-black text-slate-900 truncate" x-text="origemMunicipio ? origemMunicipio.nome : 'Selecione Origem'"></h4>
                                            <span class="text-[10px] text-slate-400 truncate block" x-text="origemMunicipio ? ('Micro ' + (origemMunicipio.regiao_saude || '')) : ''"></span>
                                        </div>
                                    </div>

                                    <div class="text-right shrink-0">
                                        <span
                                            class="text-[10px] font-bold px-2 py-1 rounded-lg block"
                                            :class="pickingTarget === 'origem' ? 'bg-amber-500 text-slate-950 font-black animate-pulse' : 'bg-slate-100 text-slate-500'"
                                            x-text="pickingTarget === 'origem' ? '● Selecionando' : 'Alterar'"
                                        ></span>
                                    </div>
                                </div>

                                <!-- Input de busca rápida para Origem -->
                                <div class="relative">
                                    <input
                                        type="text"
                                        x-model="searchOrigem"
                                        @input="filterOrigemMunicipios()"
                                        placeholder="🔍 Digite para trocar município origem..."
                                        class="w-full px-3 py-1.5 rounded-xl bg-white/90 border border-slate-200 text-xs font-medium text-slate-700 placeholder-slate-400 focus:bg-white focus:border-amber-500 focus:ring-1 focus:ring-amber-500"
                                    >
                                    <div
                                        x-show="filteredOrigemList.length > 0"
                                        class="absolute top-full left-0 right-0 mt-1 max-h-48 overflow-y-auto bg-white rounded-xl shadow-xl border border-slate-200 divide-y divide-slate-100 z-40"
                                        style="display: none;"
                                    >
                                        <template x-for="m in filteredOrigemList" :key="'origem-' + m.codarea">
                                            <button
                                                type="button"
                                                @click="selectOrigemByCod(m.codarea)"
                                                class="w-full text-left px-3 py-2 text-xs hover:bg-amber-50 hover:text-amber-900 flex items-center justify-between cursor-pointer"
                                            >
                                                <span class="font-bold text-slate-800" x-text="m.nome"></span>
                                                <span class="text-[10px] text-slate-400" x-text="'Micro ' + (m.regiao_saude || '')"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <!-- Botão central de troca no Desktop -->
                            <div class="lg:col-span-1 flex justify-center py-2 lg:py-4">
                                <button
                                    type="button"
                                    @click="invertPoints()"
                                    class="w-9 h-9 rounded-full bg-white hover:bg-amber-100 text-amber-700 border border-amber-300 flex items-center justify-center shadow-xs transition cursor-pointer"
                                    title="Inverter Origem e Destino"
                                >
                                    <x-heroicon-o-arrows-right-left class="w-4 h-4" />
                                </button>
                            </div>

                            <!-- Box 2: Município Destino -->
                            <div class="lg:col-span-5 relative space-y-1.5">
                                <div
                                    class="p-3 rounded-2xl bg-white border-2 transition cursor-pointer flex items-center justify-between gap-2 shadow-xs"
                                    :class="pickingTarget === 'destino' ? 'border-blue-600 ring-2 ring-blue-300/40 bg-blue-50/30' : 'border-slate-200 hover:border-slate-300'"
                                    @click="pickingTarget = 'destino'"
                                >
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <span class="w-8 h-8 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center text-sm font-black shrink-0">
                                            🎯
                                        </span>
                                        <div class="min-w-0">
                                            <span class="text-[9px] uppercase font-black text-blue-700 tracking-wider block">2. MUNICÍPIO DESTINO</span>
                                            <h4 class="text-sm font-black text-slate-900 truncate" x-text="destinoMunicipio ? destinoMunicipio.nome : 'Selecione Destino'"></h4>
                                            <span class="text-[10px] text-slate-400 truncate block" x-text="destinoMunicipio ? ('Micro ' + (destinoMunicipio.regiao_saude || '')) : ''"></span>
                                        </div>
                                    </div>

                                    <div class="text-right shrink-0">
                                        <span
                                            class="text-[10px] font-bold px-2 py-1 rounded-lg block"
                                            :class="pickingTarget === 'destino' ? 'bg-blue-600 text-white font-black animate-pulse' : 'bg-slate-100 text-slate-500'"
                                            x-text="pickingTarget === 'destino' ? '● Selecionando' : 'Alterar'"
                                        ></span>
                                    </div>
                                </div>

                                <!-- Input de busca rápida para Destino -->
                                <div class="relative">
                                    <input
                                        type="text"
                                        x-model="searchDestino"
                                        @input="filterDestinoMunicipios()"
                                        placeholder="🔍 Digite para trocar município destino..."
                                        class="w-full px-3 py-1.5 rounded-xl bg-white/90 border border-slate-200 text-xs font-medium text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                    >
                                    <div
                                        x-show="filteredDestinoList.length > 0"
                                        class="absolute top-full left-0 right-0 mt-1 max-h-48 overflow-y-auto bg-white rounded-xl shadow-xl border border-slate-200 divide-y divide-slate-100 z-40"
                                        style="display: none;"
                                    >
                                        <template x-for="m in filteredDestinoList" :key="'destino-' + m.codarea">
                                            <button
                                                type="button"
                                                @click="selectDestinoByCod(m.codarea)"
                                                class="w-full text-left px-3 py-2 text-xs hover:bg-blue-50 hover:text-blue-900 flex items-center justify-between cursor-pointer"
                                            >
                                                <span class="font-bold text-slate-800" x-text="m.nome"></span>
                                                <span class="text-[10px] text-slate-400" x-text="'Micro ' + (m.regiao_saude || '')"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Toggles Rápidos de Linhas e Dica de Uso -->
                        <div class="flex flex-wrap items-center justify-between gap-3 pt-2 border-t border-amber-200/70 text-xs">
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="text-[11px] font-black text-slate-700 uppercase tracking-wider">Conexões no Mapa:</span>

                                <!-- Toggle Rota Origem - Destino -->
                                <label class="inline-flex items-center gap-1.5 cursor-pointer select-none bg-white/80 px-2.5 py-1 rounded-lg border border-amber-200">
                                    <input type="checkbox" x-model="showRouteLine" @change="renderDistanceLines()" class="rounded text-amber-500 focus:ring-amber-400">
                                    <span class="inline-flex items-center gap-1 font-bold text-slate-800 text-[11px]">
                                        <span class="w-2.5 h-1 rounded-full bg-amber-500"></span>
                                        <span>Origem ↔ Destino (<strong class="text-amber-700" x-text="distRouteKm + ' km'"></strong>)</span>
                                    </span>
                                </label>

                                <!-- Toggle Origem - ERS -->
                                <label class="inline-flex items-center gap-1.5 cursor-pointer select-none bg-white/80 px-2.5 py-1 rounded-lg border border-emerald-200">
                                    <input type="checkbox" x-model="showErsLine" @change="renderDistanceLines()" class="rounded text-emerald-600 focus:ring-emerald-400">
                                    <span class="inline-flex items-center gap-1 font-bold text-slate-800 text-[11px]">
                                        <span class="w-2.5 h-1 rounded-full bg-emerald-500"></span>
                                        <span>Origem ↔ Sede ERS (<strong class="text-emerald-700" x-text="distErsKm + ' km'"></strong>)</span>
                                    </span>
                                </label>

                                <!-- Toggle Origem - Capital -->
                                <label class="inline-flex items-center gap-1.5 cursor-pointer select-none bg-white/80 px-2.5 py-1 rounded-lg border border-blue-200">
                                    <input type="checkbox" x-model="showCapitalLine" @change="renderDistanceLines()" class="rounded text-blue-600 focus:ring-blue-400">
                                    <span class="inline-flex items-center gap-1 font-bold text-slate-800 text-[11px]">
                                        <span class="w-2.5 h-1 rounded-full bg-blue-600"></span>
                                        <span>Origem ↔ Capital Cuiabá (<strong class="text-govmt-blue" x-text="distCapitalKm + ' km'"></strong>)</span>
                                    </span>
                                </label>
                            </div>

                            <span class="text-[11px] font-semibold text-slate-600 flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                <span x-text="'💡 Clique no mapa para definir ' + (pickingTarget === 'origem' ? 'a Origem 🚩' : 'o Destino 🎯')"></span>
                            </span>
                        </div>
                    </div>

                    <!-- Linha 2A: Pills das 6 MACRORREGIÕES (Exibido quando filterLevel === 'macro' e distanceMode === false) -->
                    <div x-show="!distanceMode && filterLevel === 'macro'" class="space-y-2">
                        <div class="flex flex-wrap items-center gap-2 pt-0.5">
                            <!-- Botão: Todas as 6 Macrorregiões -->
                            <button
                                type="button"
                                @click="setMacroFilter('todas')"
                                class="px-3 py-1.5 rounded-xl text-xs font-bold border transition flex items-center gap-1.5 cursor-pointer"
                                :class="macroFilter === 'todas'
                                    ? 'bg-govmt-blue text-white border-govmt-blue shadow-xs'
                                    : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-100'"
                            >
                                <span class="w-2.5 h-2.5 rounded-full bg-govmt-green"></span>
                                <span>Todas as 6 Pintadas</span>
                            </button>

                            <template x-for="(info, key) in macroConfig" :key="key">
                                <button
                                    type="button"
                                    @click="setMacroFilter(key)"
                                    class="px-3 py-1.5 rounded-xl text-xs font-bold border transition flex items-center gap-2 cursor-pointer"
                                    :class="macroFilter === key ? info.activeBtnClass : info.inactiveBtnClass"
                                    :title="'Filtrar e destacar Macrorregião ' + info.nome + ' (' + info.totalMunicipios + ' municípios)'"
                                >
                                    <span class="w-2.5 h-2.5 rounded-full shrink-0" :class="info.dotColor"></span>
                                    <span x-text="info.nome"></span>
                                    <span
                                        class="text-[10px] px-1.5 py-0.2 rounded-md font-extrabold"
                                        :class="macroFilter === key ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600'"
                                        x-text="info.totalMunicipios"
                                    ></span>
                                </button>
                            </template>
                        </div>

                        <!-- Sub-atalho: Microrregiões da Macrorregião Ativa -->
                        <div
                            x-show="activeMacroDetails && macroFilter !== 'todas'"
                            class="flex flex-wrap items-center gap-1.5 pt-1 text-xs"
                        >
                            <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mr-1">Microrregiões de <span x-text="activeMacroDetails ? activeMacroDetails.nome : ''"></span>:</span>
                            <template x-for="microNome in getMicrosOfMacro(macroFilter)" :key="microNome">
                                <button
                                    type="button"
                                    @click="setMicroFilter(microNome); filterLevel = 'micro'"
                                    class="px-2.5 py-1 rounded-lg text-[11px] font-semibold border transition cursor-pointer flex items-center gap-1"
                                    :class="microConfig[microNome] ? microConfig[microNome].badgeBg + ' ' + microConfig[microNome].badgeText + ' ' + microConfig[microNome].badgeBorder : 'bg-slate-100 text-slate-700'"
                                >
                                    <span class="w-1.5 h-1.5 rounded-full" :class="microConfig[microNome] ? microConfig[microNome].dotColor : 'bg-slate-400'"></span>
                                    <span x-text="microNome"></span>
                                    <span class="text-[9px] opacity-75 font-mono" x-text="'(' + (microConfig[microNome] ? microConfig[microNome].totalMunicipios : '') + ')'"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Linha 2B: Pills das 16 MICRORREGIÕES (Exibido quando filterLevel === 'micro' e distanceMode === false) -->
                    <div x-show="!distanceMode && filterLevel === 'micro'" class="space-y-2">
                        <div class="flex flex-wrap items-center gap-1.5 pt-0.5">
                            <!-- Botão: Todas as 16 Microrregiões -->
                            <button
                                type="button"
                                @click="setMicroFilter('todas')"
                                class="px-3 py-1.5 rounded-xl text-xs font-bold border transition flex items-center gap-1.5 cursor-pointer"
                                :class="microFilter === 'todas'
                                    ? 'bg-emerald-700 text-white border-emerald-700 shadow-xs ring-2 ring-emerald-300/40'
                                    : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-100'"
                            >
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                                <span>Todas as 16 (Pintadas no Mapa)</span>
                            </button>

                            <template x-for="(info, key) in microConfig" :key="key">
                                <button
                                    type="button"
                                    @click="setMicroFilter(key)"
                                    class="px-2.5 py-1.2 rounded-xl text-[11px] font-bold border transition flex items-center gap-1.5 cursor-pointer"
                                    :class="microFilter === key ? info.activeBtnClass : info.inactiveBtnClass"
                                    :title="'Filtrar Microrregião ' + info.nome + ' (Polo: ' + info.polo + ' • ' + info.totalMunicipios + ' municípios)'"
                                >
                                    <span class="w-2 h-2 rounded-full shrink-0" :class="info.dotColor"></span>
                                    <span x-text="info.nome"></span>
                                    <span
                                        class="text-[9px] px-1 py-0.1 rounded font-extrabold"
                                        :class="microFilter === key ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500'"
                                        x-text="info.totalMunicipios"
                                    ></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Linha 3A: Banner Informativo da MACRORREGIÃO Filtrada -->
                    <div
                        x-show="!distanceMode && filterLevel === 'macro' && activeMacroDetails && macroFilter !== 'todas'"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="p-3 sm:p-3.5 rounded-2xl border flex flex-col md:flex-row md:items-center justify-between gap-3 text-xs"
                        :class="activeMacroDetails ? activeMacroDetails.badgeBg + ' ' + activeMacroDetails.badgeBorder : ''"
                    >
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full shrink-0" :class="activeMacroDetails ? activeMacroDetails.dotColor : ''"></span>
                                <span class="font-extrabold text-slate-900 text-sm">
                                    Macrorregião <span x-text="activeMacroDetails ? activeMacroDetails.nome : ''"></span>
                                </span>
                            </div>
                            <span class="text-slate-500">•</span>
                            <span class="text-slate-700">
                                <strong class="text-slate-900">Polo Regional:</strong> <span x-text="activeMacroDetails ? activeMacroDetails.polo : ''"></span>
                            </span>
                            <span class="text-slate-500">•</span>
                            <span class="text-slate-700">
                                <strong class="text-slate-900" x-text="activeMacroDetails ? activeMacroDetails.totalMunicipios : ''"></strong> municípios
                                (<span x-text="activeMacroDetails ? activeMacroDetails.populacao : ''"></span> hab. • <span x-text="activeMacroDetails ? activeMacroDetails.percentualPop : ''"></span>)
                            </span>
                            <span class="text-slate-500 hidden lg:inline">•</span>
                            <span class="text-slate-600 hidden lg:inline text-[11px]" x-text="'CIRs: ' + (activeMacroDetails ? activeMacroDetails.regioesSaude : '')"></span>
                        </div>

                        <button
                            type="button"
                            @click="setMacroFilter('todas')"
                            class="px-2.5 py-1 rounded-lg bg-white/90 hover:bg-white text-slate-700 font-bold border border-slate-200 text-[11px] transition shrink-0 cursor-pointer inline-flex items-center gap-1 self-start md:self-auto"
                        >
                            <x-heroicon-o-eye class="w-3.5 h-3.5 text-slate-500" />
                            <span>Ver Todas as Macrorregiões</span>
                        </button>
                    </div>

                    <!-- Linha 3B: Banner Informativo da MICRORREGIÃO Filtrada -->
                    <div
                        x-show="!distanceMode && filterLevel === 'micro' && activeMicroDetails && microFilter !== 'todas'"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="p-3 sm:p-3.5 rounded-2xl border flex flex-col md:flex-row md:items-center justify-between gap-3 text-xs"
                        :class="activeMicroDetails ? activeMicroDetails.badgeBg + ' ' + activeMicroDetails.badgeBorder : ''"
                    >
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full shrink-0" :class="activeMicroDetails ? activeMicroDetails.dotColor : ''"></span>
                                <span class="font-extrabold text-slate-900 text-sm">
                                    Microrregião / CIR <span x-text="activeMicroDetails ? activeMicroDetails.nome : ''"></span>
                                </span>
                            </div>
                            <span class="text-slate-500">•</span>
                            <span class="text-slate-700">
                                <strong class="text-slate-900">Sede ERS / Polo:</strong> <span x-text="activeMicroDetails ? activeMicroDetails.polo : ''"></span>
                            </span>
                            <span class="text-slate-500">•</span>
                            <span class="text-slate-700">
                                <strong class="text-slate-900">Macrorregião:</strong> <span x-text="activeMicroDetails ? activeMicroDetails.macro : ''"></span>
                            </span>
                            <span class="text-slate-500">•</span>
                            <span class="text-slate-700">
                                <strong class="text-slate-900" x-text="activeMicroDetails ? activeMicroDetails.totalMunicipios : ''"></strong> municípios
                                (<span x-text="activeMicroDetails ? activeMicroDetails.populacao : ''"></span> hab.)
                            </span>
                        </div>

                        <button
                            type="button"
                            @click="setMicroFilter('todas')"
                            class="px-2.5 py-1 rounded-lg bg-white/90 hover:bg-white text-slate-700 font-bold border border-slate-200 text-[11px] transition shrink-0 cursor-pointer inline-flex items-center gap-1 self-start md:self-auto"
                        >
                            <x-heroicon-o-eye class="w-3.5 h-3.5 text-slate-500" />
                            <span>Ver Todas as 16 Micros</span>
                        </button>
                    </div>

                    <!-- Linha 3C: Status quando "Todas" está ativo -->
                    <div
                        x-show="!distanceMode && ((filterLevel === 'macro' && macroFilter === 'todas') || (filterLevel === 'micro' && microFilter === 'todas'))"
                        x-transition
                        class="px-3.5 py-2 rounded-2xl bg-slate-50 border border-slate-200/80 flex flex-wrap items-center justify-between gap-2 text-xs text-slate-600"
                    >
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center gap-1 font-bold text-slate-800">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span x-text="filterLevel === 'macro' ? 'Mapa Temático: 6 Macrorregiões de Saúde' : 'Mapa Temático: 16 Microrregiões de Saúde (CIR/ERS)'"></span>
                            </span>
                            <span>— Todas as divisões territoriais estão pintadas no mapa estadual.</span>
                        </div>
                        <span class="text-[11px] text-slate-400 font-medium">
                            Clique em uma região ou município para detalhar e isolar o território.
                        </span>
                    </div>

                </div>

                <!-- Canvas Vetorial SVG do Mapa (100% da área) -->
                <div class="relative w-full flex-1 flex items-center justify-center my-1 overflow-hidden" id="canvas-container" style="min-height: 640px;">
                    
                    <!-- Loading Spinner -->
                    <div x-show="loading" class="absolute inset-0 bg-white/95 backdrop-blur-xs flex flex-col items-center justify-center z-30 gap-3">
                        <div class="w-10 h-10 border-4 border-govmt-blue border-t-transparent rounded-full animate-spin"></div>
                        <span class="text-xs font-bold text-slate-600">Renderizando malha geográfica oficial de Mato Grosso...</span>
                    </div>

                    <!-- SVG do Estado de Mato Grosso em Proporção 1000x850 com todos os 142 polígonos -->
                    <svg
                        id="mt-svg-map"
                        viewBox="0 0 1000 850"
                        class="w-full h-full max-h-[780px] select-none"
                        style="filter: drop-shadow(0 10px 24px rgba(0, 75, 141, 0.04));"
                    >
                        <defs>
                            <filter id="badge-shadow" x="-30%" y="-30%" width="160%" height="160%">
                                <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#000000" flood-opacity="0.28"/>
                            </filter>
                        </defs>
                        <g id="municipios-group"></g>
                        <!-- Camadas Vetoriais da Régua de Distâncias (Rotas, Marcadores e Badges) -->
                        <g id="routes-group" style="pointer-events: none;"></g>
                        <g id="markers-group" style="pointer-events: none;"></g>
                        <g id="badges-group" style="pointer-events: auto;"></g>
                    </svg>

                    <!-- Card Flutuante de Município no Canto Inferior Direito (Enriquecido com Macrorregião e Microrregião CIR) -->
                    <div
                        x-show="hoveredMunicipio || selectedMunicipio"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        class="absolute bottom-4 right-4 bg-white/95 backdrop-blur-md p-4 rounded-3xl shadow-2xl border border-slate-200/90 z-20 w-76 sm:w-88 space-y-3 pointer-events-auto"
                    >
                        <div class="flex items-start gap-3">
                            <div
                                class="w-11 h-11 rounded-2xl flex items-center justify-center shrink-0 border mt-0.5"
                                :class="getDisplayBadgeClass()"
                            >
                                <x-heroicon-o-building-office-2 class="w-5 h-5 text-current" />
                            </div>
                            <div class="overflow-hidden flex-1">
                                <div class="flex items-center justify-between gap-1 mb-0.5">
                                    <span class="text-[9px] font-extrabold uppercase tracking-widest text-slate-400">MUNICÍPIO</span>
                                    <span
                                        class="text-[9px] font-bold px-2 py-0.5 rounded-full"
                                        :class="macroConfig[activeDisplay.macrorregiao] ? macroConfig[activeDisplay.macrorregiao].badgeBg + ' ' + macroConfig[activeDisplay.macrorregiao].badgeText + ' border ' + macroConfig[activeDisplay.macrorregiao].badgeBorder : 'bg-slate-100 text-slate-600'"
                                        x-text="'Macro ' + (activeDisplay.macrorregiao || 'Centro-Norte')"
                                    ></span>
                                </div>
                                <h3 class="text-base sm:text-lg font-black text-slate-900 leading-tight truncate" x-text="activeDisplay.nome"></h3>
                                
                                <div class="space-y-0.5 mt-1.5">
                                    <div class="flex items-center gap-1.5 text-xs font-semibold text-slate-700">
                                        <span class="w-2 h-2 rounded-full shrink-0" :class="microConfig[activeDisplay.regiao_saude] ? microConfig[activeDisplay.regiao_saude].dotColor : 'bg-blue-600'"></span>
                                        <span class="truncate" x-text="'Micro/CIR: ' + (activeDisplay.regiao_saude || activeDisplay.regiao || 'Baixada Cuiabana')"></span>
                                    </div>
                                    <div class="flex items-center gap-2 text-[11px] text-slate-500">
                                        <span x-text="'Sede ERS: ' + (activeDisplay.polo_micro || activeDisplay.polo_macro || 'Cuiabá')"></span>
                                        <span>•</span>
                                        <span x-text="activeDisplay.populacao_formatada"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2.5 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="inline-flex items-center gap-1.5 font-bold text-emerald-700 tracking-tight uppercase text-[11px]">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 ring-2 ring-emerald-300/40"></span>
                                INTEGRADO AO SUS DIGITAL
                            </span>
                            <span class="font-mono text-[11px] font-semibold text-slate-400" x-text="'IBGE: ' + (activeDisplay.codarea || activeDisplay.id)"></span>
                        </div>
                    </div>

                    <!-- Botão Circular de Redefinir no Canto Superior Direito -->
                    <button
                        type="button"
                        @click="resetMap()"
                        class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/90 backdrop-blur-xs border border-slate-200 hover:bg-slate-100 text-slate-500 hover:text-slate-800 flex items-center justify-center shadow-sm transition z-20 cursor-pointer"
                        title="Redefinir visualização"
                    >
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                    </button>

                </div>

                <!-- Rodapé da visualização: Legenda Dinâmica e Base Cartográfica -->
                <div class="pt-3 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between text-xs text-slate-400 gap-2">
                    
                    <!-- Legenda Especial da Régua de Distâncias -->
                    <div x-show="distanceMode" class="flex flex-wrap items-center gap-3">
                        <span class="font-bold text-slate-700">Legenda de Conexões:</span>
                        <span class="inline-flex items-center gap-1.5 font-semibold text-slate-700">
                            <span class="w-3.5 h-1.5 rounded-full bg-amber-500 shadow-xs"></span>
                            <span>Rota Origem ↔ Destino</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 font-semibold text-slate-700">
                            <span class="w-3.5 h-1.5 rounded-full bg-emerald-500 border-b border-dashed border-emerald-700"></span>
                            <span>Conexão ERS Regional</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 font-semibold text-slate-700">
                            <span class="w-3.5 h-1.5 rounded-full bg-blue-600 border-b border-dotted border-blue-800"></span>
                            <span>Conexão Capital Cuiabá</span>
                        </span>
                    </div>

                    <!-- Legenda Dinâmica Padrão: Macrorregiões ou Microrregiões (quando fora da régua) -->
                    <div x-show="!distanceMode" class="flex flex-wrap items-center gap-3">
                        <span class="font-semibold text-slate-600" x-text="filterLevel === 'micro' ? 'Microrregiões:' : 'Macrorregiões:'"></span>
                        
                        <!-- Legenda de Macrorregiões -->
                        <template x-if="filterLevel !== 'micro'">
                            <div class="flex flex-wrap items-center gap-2.5">
                                <template x-for="(info, key) in macroConfig" :key="key">
                                    <button
                                        type="button"
                                        @click="setMacroFilter(key)"
                                        class="inline-flex items-center gap-1 hover:text-slate-900 transition cursor-pointer"
                                    >
                                        <span class="w-2.5 h-2.5 rounded-sm" :style="'background-color:' + info.fill"></span>
                                        <span class="text-[11px] font-medium" x-text="info.nome"></span>
                                    </button>
                                </template>
                            </div>
                        </template>

                        <!-- Legenda de Microrregiões Resumida -->
                        <template x-if="filterLevel === 'micro'">
                            <span class="text-[11px] text-slate-500">
                                16 Microrregiões de Saúde (CIR) com cores próprias pactuadas no PRI estadual da SES-MT.
                            </span>
                        </template>
                    </div>

                    <span class="font-semibold text-govmt-blue">Secretaria de Estado de Saúde • Governo de Mato Grosso</span>
                </div>

            </div>

            <!-- Coluna Lateral de Detalhes: 3 Colunas no LG / 2 Colunas no XL -->
            <div class="lg:col-span-3 xl:col-span-2 space-y-4">
                
                <!-- 1. PAINEL DE DISTÂNCIAS (QUANDO distanceMode === true) -->
                <div x-show="distanceMode" x-transition class="space-y-4" style="display: none;">
                    <div class="bg-white p-5 rounded-3xl border-2 border-amber-400/90 shadow-sm space-y-4">
                        
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="w-8 h-8 rounded-xl bg-amber-500 text-slate-950 flex items-center justify-center font-black text-sm">
                                    📏
                                </span>
                                <div>
                                    <span class="text-[9px] font-extrabold uppercase tracking-widest text-amber-700 block">PAINEL DE LOGÍSTICA</span>
                                    <h2 class="text-base font-black text-slate-900 leading-tight">Medição de Distâncias MT</h2>
                                </div>
                            </div>
                            <button
                                type="button"
                                @click="disableDistanceMode()"
                                class="text-slate-400 hover:text-slate-700 text-xs font-bold cursor-pointer"
                                title="Fechar Régua"
                            >
                                ✕ Fechar
                            </button>
                        </div>

                        <!-- Bloco 1: Origem ➔ Destino -->
                        <div class="p-3.5 rounded-2xl bg-gradient-to-br from-amber-50/80 to-orange-50/50 border border-amber-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-black uppercase text-amber-800 tracking-wider flex items-center gap-1">
                                    <span>🚩 Origem ➔ 🎯 Destino</span>
                                </span>
                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-md bg-amber-200/70 text-amber-900" x-text="distRouteKm === 0 ? 'Mesmo município' : (distRouteTime + ' de viagem')"></span>
                            </div>
                            <div class="flex items-baseline justify-between gap-2">
                                <div class="min-w-0">
                                    <h3 class="text-sm font-black text-slate-900 leading-tight truncate" x-text="(origemMunicipio ? origemMunicipio.nome : '') + ' ➔ ' + (destinoMunicipio ? destinoMunicipio.nome : '')"></h3>
                                    <span class="text-[11px] text-slate-500 font-medium block truncate" x-text="distRouteKm === 0 ? 'Pontos coincidentes' : ('Estimativa rodoviária: ~' + distRouteRoadKm + ' km')"></span>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="text-2xl font-black text-amber-600 font-mono tracking-tight" x-text="distRouteKm"></span>
                                    <span class="text-xs font-bold text-slate-500 ml-0.5">km</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bloco 2: Origem ➔ Escritório Regional de Saúde (ERS) -->
                        <div class="p-3.5 rounded-2xl bg-gradient-to-br from-emerald-50/80 to-teal-50/50 border border-emerald-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-black uppercase text-emerald-800 tracking-wider flex items-center gap-1">
                                    <span>🏥 Origem ➔ Sede Regional ERS</span>
                                </span>
                                <span class="text-[10px] font-mono font-bold text-emerald-700" x-text="'Micro ' + (origemMunicipio ? (origemMunicipio.regiao_saude || '') : '')"></span>
                            </div>
                            <div class="flex items-baseline justify-between gap-2">
                                <div class="min-w-0">
                                    <h3 class="text-sm font-black text-slate-900 leading-tight truncate" x-text="ersMunicipio ? ('Sede: ' + ersMunicipio.nome) : 'Sede Regional'"></h3>
                                    <span class="text-[11px] text-slate-500 font-medium block truncate" x-text="distErsKm === 0 ? 'Origem já é a Sede do ERS' : ('Estimativa rodoviária: ~' + distErsRoadKm + ' km')"></span>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="text-2xl font-black text-emerald-600 font-mono tracking-tight" x-text="distErsKm"></span>
                                    <span class="text-xs font-bold text-slate-500 ml-0.5">km</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bloco 3: Origem ➔ Capital Cuiabá -->
                        <div class="p-3.5 rounded-2xl bg-gradient-to-br from-blue-50/80 to-indigo-50/50 border border-blue-200 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-black uppercase text-govmt-blue tracking-wider flex items-center gap-1">
                                    <span>🏛️ Origem ➔ Capital Estadual</span>
                                </span>
                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-md bg-blue-100 text-blue-800" x-text="distCapitalKm === 0 ? 'Capital MT' : (distCapitalTime + ' de estrada')"></span>
                            </div>
                            <div class="flex items-baseline justify-between gap-2">
                                <div class="min-w-0">
                                    <h3 class="text-sm font-black text-slate-900 leading-tight">Cuiabá (Capital)</h3>
                                    <span class="text-[11px] text-slate-500 font-medium block truncate" x-text="distCapitalKm === 0 ? 'Município Sede do Governo Estadual' : ('Estimativa rodoviária: ~' + distCapitalRoadKm + ' km')"></span>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="text-2xl font-black text-govmt-blue font-mono tracking-tight" x-text="distCapitalKm"></span>
                                    <span class="text-xs font-bold text-slate-500 ml-0.5">km</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bloco 4: Impacto Real da Saúde Digital -->
                        <div class="p-4 rounded-2xl bg-gradient-to-br from-[#06152B] to-[#0B2545] text-white space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span class="text-[10px] font-black uppercase tracking-wider text-emerald-300">IntegraSUS Digital MT</span>
                            </div>
                            <h4 class="text-xs font-black text-white leading-snug">
                                Zero km de deslocamento para o cidadão
                            </h4>
                            <p class="text-[11px] text-slate-300 leading-relaxed">
                                Com a telessaúde, o paciente de <strong class="text-white" x-text="origemMunicipio ? origemMunicipio.nome : ''"></strong> recebe teleinterconsulta com especialistas da SES-MT sem ter que percorrer até <strong class="text-emerald-300" x-text="(distCapitalRoadKm || 0) + ' km'"></strong> de estrada até Cuiabá.
                            </p>
                        </div>

                        <!-- Botão Inverter e Fechar -->
                        <div class="flex items-center gap-2 pt-1">
                            <button
                                type="button"
                                @click="invertPoints()"
                                class="flex-1 py-2 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition cursor-pointer text-center"
                            >
                                Inverter (⇄)
                            </button>
                            <button
                                type="button"
                                @click="disableDistanceMode()"
                                class="flex-1 py-2 px-3 rounded-xl bg-govmt-blue hover:bg-govmt-darkBlue text-white font-bold text-xs transition cursor-pointer text-center"
                            >
                                Voltar ao Mapa
                            </button>
                        </div>

                    </div>
                </div>

                <!-- 2. CARDS CONVENCIONAIS (QUANDO distanceMode === false) -->
                <div x-show="!distanceMode" class="space-y-4">
                    
                    <!-- Card de Destaque do Município Selecionado -->
                    <div class="bg-white p-5 rounded-3xl border border-slate-200/90 shadow-sm space-y-4">
                        <div class="flex items-start justify-between">
                            <div
                                class="w-10 h-10 rounded-xl flex items-center justify-center"
                                :class="getSelectedBadgeClass()"
                            >
                                <x-heroicon-o-map-pin class="w-5 h-5 text-current" />
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                100% ATIVO
                            </span>
                        </div>

                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-0.5">MUNICÍPIO SELECIONADO</span>
                            <h2 class="text-xl font-black text-slate-900 tracking-tight leading-tight" x-text="selectedMunicipio ? selectedMunicipio.nome : 'Cuiabá'"></h2>
                            
                            <!-- Badges Territoriais (Macro e Micro) -->
                            <div class="flex flex-wrap gap-1.5 mt-2.5">
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg text-[10px] font-bold border"
                                    :class="selectedMunicipio && macroConfig[selectedMunicipio.macrorregiao] ? macroConfig[selectedMunicipio.macrorregiao].badgeBg + ' ' + macroConfig[selectedMunicipio.macrorregiao].badgeText + ' ' + macroConfig[selectedMunicipio.macrorregiao].badgeBorder : 'bg-blue-50 text-blue-700 border-blue-200'"
                                >
                                    <span class="w-1.5 h-1.5 rounded-full" :class="selectedMunicipio && macroConfig[selectedMunicipio.macrorregiao] ? macroConfig[selectedMunicipio.macrorregiao].dotColor : 'bg-blue-600'"></span>
                                    <span x-text="'Macro ' + (selectedMunicipio ? selectedMunicipio.macrorregiao : 'Centro-Norte')"></span>
                                </span>
                                <span
                                    class="inline-flex items-center gap-1 px-2 py-0.5 rounded-lg text-[10px] font-bold border"
                                    :class="selectedMunicipio && microConfig[selectedMunicipio.regiao_saude] ? microConfig[selectedMunicipio.regiao_saude].badgeBg + ' ' + microConfig[selectedMunicipio.regiao_saude].badgeText + ' ' + microConfig[selectedMunicipio.regiao_saude].badgeBorder : 'bg-purple-50 text-purple-700 border-purple-200'"
                                >
                                    <span class="w-1.5 h-1.5 rounded-full" :class="selectedMunicipio && microConfig[selectedMunicipio.regiao_saude] ? microConfig[selectedMunicipio.regiao_saude].dotColor : 'bg-purple-600'"></span>
                                    <span x-text="'Micro ' + (selectedMunicipio ? selectedMunicipio.regiao_saude : 'Baixada Cuiabana')"></span>
                                </span>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-100 space-y-2 text-xs">
                            <div class="flex items-center justify-between p-2 bg-slate-50 rounded-xl">
                                <span class="text-slate-400 font-medium">Microrregião / CIR</span>
                                <span class="font-bold text-slate-800 text-right text-[11px]" x-text="selectedMunicipio ? (selectedMunicipio.regiao_saude || selectedMunicipio.regiao) : 'Baixada Cuiabana'"></span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-slate-50 rounded-xl">
                                <span class="text-slate-400 font-medium">Sede ERS / Polo Micro</span>
                                <span class="font-bold text-slate-800 text-right" x-text="selectedMunicipio ? (selectedMunicipio.polo_micro || 'Cuiabá') : 'Cuiabá'"></span>
                            </div>
                            
                            <!-- Distâncias de Referência SES-MT -->
                            <div class="flex items-center justify-between p-2 bg-amber-50/60 border border-amber-100 rounded-xl">
                                <span class="text-slate-500 font-semibold flex items-center gap-1">
                                    <span>🏥</span>
                                    <span>Distância ao ERS</span>
                                </span>
                                <span class="font-mono font-bold text-amber-800" x-text="selectedErsDist + ' km (' + selectedErsName + ')'"></span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-blue-50/60 border border-blue-100 rounded-xl">
                                <span class="text-slate-500 font-semibold flex items-center gap-1">
                                    <span>🏛️</span>
                                    <span>Distância à Capital</span>
                                </span>
                                <span class="font-mono font-bold text-govmt-blue" x-text="selectedCapitalDist + ' km'"></span>
                            </div>

                            <div class="flex items-center justify-between p-2 bg-slate-50 rounded-xl">
                                <span class="text-slate-400 font-medium">Código IBGE</span>
                                <span class="font-mono font-bold text-slate-800" x-text="selectedMunicipio ? selectedMunicipio.codarea : '5103403'"></span>
                            </div>
                            <div class="flex items-center justify-between p-2 bg-slate-50 rounded-xl">
                                <span class="text-slate-400 font-medium">População IBGE</span>
                                <span class="font-bold text-slate-800" x-text="selectedMunicipio && selectedMunicipio.populacao_formatada ? selectedMunicipio.populacao_formatada : '650.877 hab.'"></span>
                            </div>
                        </div>

                        <!-- Botão de Ação: Medir Distâncias a partir deste município -->
                        <button
                            type="button"
                            @click="enableDistanceMode(selectedMunicipio)"
                            class="w-full inline-flex items-center justify-center gap-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-black py-2.5 px-3 rounded-xl text-xs transition shadow-xs cursor-pointer"
                        >
                            <x-heroicon-o-calculator class="w-4 h-4 text-slate-950" />
                            <span>Medir Distâncias Deste Município</span>
                        </button>

                        <a
                            href="{{ route('portal.services') }}"
                            class="w-full inline-flex items-center justify-center gap-2 bg-govmt-blue hover:bg-govmt-darkBlue text-white font-bold py-2.5 px-3 rounded-xl text-xs transition shadow-xs cursor-pointer"
                        >
                            <span>Ver Serviços da Rede</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </a>
                    </div>

                <!-- Card de Seleção e Navegação Territorial Lateral -->
                <div class="bg-white p-5 rounded-3xl border border-slate-200/90 shadow-sm space-y-3" x-data="{ sideTab: 'macro' }">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-2">
                        <span class="text-[10px] uppercase font-extrabold text-slate-400 tracking-wider">
                            Guia Territorial MT
                        </span>
                        <div class="flex items-center gap-1 text-[10px] font-bold">
                            <button
                                type="button"
                                @click="sideTab = 'macro'; filterLevel = 'macro'"
                                class="px-2 py-0.5 rounded-md transition"
                                :class="sideTab === 'macro' ? 'bg-blue-100 text-govmt-blue' : 'text-slate-400 hover:text-slate-700'"
                            >
                                6 Macros
                            </button>
                            <button
                                type="button"
                                @click="sideTab = 'micro'; filterLevel = 'micro'"
                                class="px-2 py-0.5 rounded-md transition"
                                :class="sideTab === 'micro' ? 'bg-emerald-100 text-emerald-800' : 'text-slate-400 hover:text-slate-700'"
                            >
                                16 Micros
                            </button>
                        </div>
                    </div>

                    <!-- Lista das 6 Macrorregiões -->
                    <div class="space-y-1.5" x-show="sideTab === 'macro'">
                        <template x-for="(info, key) in macroConfig" :key="key">
                            <button
                                type="button"
                                @click="setMacroFilter(key); filterLevel = 'macro'"
                                class="w-full text-left p-2 rounded-xl text-xs transition flex items-center justify-between cursor-pointer border"
                                :class="filterLevel === 'macro' && macroFilter === key
                                    ? info.badgeBg + ' ' + info.badgeBorder + ' font-bold text-slate-900 ring-1 ring-slate-300'
                                    : 'bg-slate-50/60 border-transparent hover:bg-slate-100 text-slate-700'"
                            >
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full shrink-0" :class="info.dotColor"></span>
                                    <span x-text="info.nome"></span>
                                </div>
                                <span class="text-[10px] text-slate-400 font-mono" x-text="info.totalMunicipios + ' mun.'"></span>
                            </button>
                        </template>
                    </div>

                    <!-- Lista das 16 Microrregiões -->
                    <div class="space-y-1.5 max-h-72 overflow-y-auto pr-1 scrollbar-thin" x-show="sideTab === 'micro'">
                        <template x-for="(info, key) in microConfig" :key="key">
                            <button
                                type="button"
                                @click="setMicroFilter(key); filterLevel = 'micro'"
                                class="w-full text-left p-2 rounded-xl text-[11px] transition flex items-center justify-between cursor-pointer border"
                                :class="filterLevel === 'micro' && microFilter === key
                                    ? info.badgeBg + ' ' + info.badgeBorder + ' font-bold text-slate-900 ring-1 ring-slate-300'
                                    : 'bg-slate-50/60 border-transparent hover:bg-slate-100 text-slate-700'"
                            >
                                <div class="flex items-center gap-2 truncate">
                                    <span class="w-2 h-2 rounded-full shrink-0" :class="info.dotColor"></span>
                                    <span class="truncate" x-text="info.nome"></span>
                                </div>
                                <span class="text-[10px] text-slate-400 font-mono shrink-0 ml-1" x-text="info.totalMunicipios + 'm'"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Card de Apoio Institucional IntegraSUS MT -->
                <div class="bg-gradient-to-br from-[#06152B] to-[#0B2545] p-5 rounded-3xl text-white shadow-sm space-y-2">
                    <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">Rede IntegraSUS MT</span>
                    <h3 class="text-sm font-bold text-white">Teleinterconsulta & Laudos</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Conectando a Atenção Primária em todas as 16 microrregiões de saúde aos médicos especialistas da SES-MT.
                    </p>
                </div>

                <!-- Botão de Acesso Direto à Plataforma -->
                <a
                    href="https://servicos.saude.mt.gov.br/telessaude/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="block text-center p-3.5 rounded-2xl bg-white border border-slate-200/90 hover:border-govmt-blue text-xs font-bold text-slate-700 hover:text-govmt-blue transition shadow-xs"
                >
                    Acessar Plataforma Telessaúde ↗
                </a>

                </div><!-- fim de x-show="!distanceMode" -->

            </div>

        </div>

    </div>
</div>

<style>
@keyframes dashTravel {
    from {
        stroke-dashoffset: 40;
    }
    to {
        stroke-dashoffset: 0;
    }
}
.route-line-anim {
    stroke-dasharray: 9 6;
    animation: dashTravel 1.4s linear infinite;
}
.ers-line-anim {
    stroke-dasharray: 6 5;
    animation: dashTravel 2s linear infinite;
}
.capital-line-anim {
    stroke-dasharray: 5 5;
    animation: dashTravel 2.4s linear infinite;
}
.animate-ping-slow {
    animation: ping 2.4s cubic-bezier(0, 0, 0.2, 1) infinite;
}
.distance-badge text {
    user-select: none;
    pointer-events: none;
}
.distance-badge:hover rect {
    filter: brightness(1.2);
}
</style>

<script>
function mapaMatoGrosso() {
    return {
        loading: true,
        municipiosList: [],
        filteredList: [],
        searchQuery: '',
        selectedMunicipio: null,
        hoveredMunicipio: null,
        filterLevel: 'macro', // 'macro' | 'micro' | 'padrao'
        macroFilter: 'todas', // 'todas' | Nome da macrorregião
        microFilter: 'todas', // 'todas' | Nome da microrregião

        // Propriedades e Estado da Régua de Distâncias e Conectividade
        distanceMode: false,
        origemMunicipio: null,
        destinoMunicipio: null,
        pickingTarget: 'destino', // 'origem' | 'destino'
        showRouteLine: true,
        showErsLine: true,
        showCapitalLine: true,
        searchOrigem: '',
        searchDestino: '',
        filteredOrigemList: [],
        filteredDestinoList: [],

        // Configuração Oficial das 6 Macrorregiões de Saúde de Mato Grosso (SES-MT / CIB)
        macroConfig: {
            'Centro-Norte': {
                nome: 'Centro-Norte',
                polo: 'Cuiabá',
                fill: '#3B82F6',
                stroke: '#1D4ED8',
                hoverFill: '#1D4ED8',
                badgeBg: 'bg-blue-50',
                badgeText: 'text-blue-700',
                badgeBorder: 'border-blue-200',
                dotColor: 'bg-blue-600',
                activeBtnClass: 'bg-blue-600 text-white border-blue-600 shadow-sm ring-2 ring-blue-300/50',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:border-blue-300 hover:bg-blue-50/50',
                totalMunicipios: 11,
                populacao: '1.056.139',
                percentualPop: '28,9%',
                regioesSaude: 'Baixada Cuiabana'
            },
            'Norte': {
                nome: 'Norte',
                polo: 'Sinop',
                fill: '#10B981',
                stroke: '#047857',
                hoverFill: '#047857',
                badgeBg: 'bg-emerald-50',
                badgeText: 'text-emerald-700',
                badgeBorder: 'border-emerald-200',
                dotColor: 'bg-emerald-600',
                activeBtnClass: 'bg-emerald-600 text-white border-emerald-600 shadow-sm ring-2 ring-emerald-300/50',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:border-emerald-300 hover:bg-emerald-50/50',
                totalMunicipios: 36,
                populacao: '873.119',
                percentualPop: '23,9%',
                regioesSaude: 'Teles Pires, Alto Tapajós, Vale do Peixoto, Norte MT, Vale do Arinos'
            },
            'Sul': {
                nome: 'Sul',
                polo: 'Rondonópolis',
                fill: '#F59E0B',
                stroke: '#B45309',
                hoverFill: '#B45309',
                badgeBg: 'bg-amber-50',
                badgeText: 'text-amber-700',
                badgeBorder: 'border-amber-200',
                dotColor: 'bg-amber-600',
                activeBtnClass: 'bg-amber-600 text-white border-amber-600 shadow-sm ring-2 ring-amber-300/50',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:border-amber-300 hover:bg-amber-50/50',
                totalMunicipios: 19,
                populacao: '569.886',
                percentualPop: '15,6%',
                regioesSaude: 'Sul Matogrossense'
            },
            'Centro-Noroeste': {
                nome: 'Centro-Noroeste',
                polo: 'Tangará da Serra',
                fill: '#8B5CF6',
                stroke: '#6D28D9',
                hoverFill: '#6D28D9',
                badgeBg: 'bg-purple-50',
                badgeText: 'text-purple-700',
                badgeBorder: 'border-purple-200',
                dotColor: 'bg-purple-600',
                activeBtnClass: 'bg-purple-600 text-white border-purple-600 shadow-sm ring-2 ring-purple-300/50',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:border-purple-300 hover:bg-purple-50/50',
                totalMunicipios: 24,
                populacao: '483.497',
                percentualPop: '13,2%',
                regioesSaude: 'Médio Norte MT, Noroeste MT, Centro Norte'
            },
            'Leste': {
                nome: 'Leste',
                polo: 'Barra do Garças',
                fill: '#EC4899',
                stroke: '#BE185D',
                hoverFill: '#BE185D',
                badgeBg: 'bg-pink-50',
                badgeText: 'text-pink-700',
                badgeBorder: 'border-pink-200',
                dotColor: 'bg-pink-600',
                activeBtnClass: 'bg-pink-600 text-white border-pink-600 shadow-sm ring-2 ring-pink-300/50',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:border-pink-300 hover:bg-pink-50/50',
                totalMunicipios: 30,
                populacao: '373.083',
                percentualPop: '10,2%',
                regioesSaude: 'Garças Araguaia, Médio Araguaia, Araguaia Xingu, Norte Araguaia Karajá'
            },
            'Oeste': {
                nome: 'Oeste',
                polo: 'Cáceres',
                fill: '#06B6D4',
                stroke: '#0E7490',
                hoverFill: '#0E7490',
                badgeBg: 'bg-cyan-50',
                badgeText: 'text-cyan-700',
                badgeBorder: 'border-cyan-200',
                dotColor: 'bg-cyan-600',
                activeBtnClass: 'bg-cyan-600 text-white border-cyan-600 shadow-sm ring-2 ring-cyan-300/50',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:border-cyan-300 hover:bg-cyan-50/50',
                totalMunicipios: 22,
                populacao: '308.697',
                percentualPop: '8,4%',
                regioesSaude: 'Oeste Mato-Grossense, Sudoeste Mato-Grossense'
            }
        },

        // Configuração Oficial das 16 Microrregiões de Saúde (CIR / Escritórios Regionais)
        microConfig: {
            'Baixada Cuiabana': {
                nome: 'Baixada Cuiabana',
                macro: 'Centro-Norte',
                polo: 'Cuiabá',
                fill: '#2563EB',
                stroke: '#1D4ED8',
                hoverFill: '#1D4ED8',
                dotColor: 'bg-blue-600',
                badgeBg: 'bg-blue-50',
                badgeText: 'text-blue-700',
                badgeBorder: 'border-blue-200',
                activeBtnClass: 'bg-blue-600 text-white border-blue-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-blue-50',
                totalMunicipios: 11,
                populacao: '1.056.139'
            },
            'Sul Matogrossense': {
                nome: 'Sul Matogrossense',
                macro: 'Sul',
                polo: 'Rondonópolis',
                fill: '#D97706',
                stroke: '#B45309',
                hoverFill: '#92400E',
                dotColor: 'bg-amber-600',
                badgeBg: 'bg-amber-50',
                badgeText: 'text-amber-700',
                badgeBorder: 'border-amber-200',
                activeBtnClass: 'bg-amber-600 text-white border-amber-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-amber-50',
                totalMunicipios: 19,
                populacao: '569.886'
            },
            'Médio Norte Matogrossense': {
                nome: 'Médio Norte MT',
                macro: 'Centro-Noroeste',
                polo: 'Tangará da Serra',
                fill: '#7C3AED',
                stroke: '#6D28D9',
                hoverFill: '#5B21B6',
                dotColor: 'bg-violet-600',
                badgeBg: 'bg-violet-50',
                badgeText: 'text-violet-700',
                badgeBorder: 'border-violet-200',
                activeBtnClass: 'bg-violet-600 text-white border-violet-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-violet-50',
                totalMunicipios: 10,
                populacao: '253.894'
            },
            'Centro Norte': {
                nome: 'Centro Norte MT',
                macro: 'Centro-Noroeste',
                polo: 'Diamantino',
                fill: '#9333EA',
                stroke: '#7E22CE',
                hoverFill: '#6B21A8',
                dotColor: 'bg-purple-600',
                badgeBg: 'bg-purple-50',
                badgeText: 'text-purple-700',
                badgeBorder: 'border-purple-200',
                activeBtnClass: 'bg-purple-600 text-white border-purple-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-purple-50',
                totalMunicipios: 7,
                populacao: '87.608'
            },
            'Noroeste Matogrossense': {
                nome: 'Noroeste (Juína)',
                macro: 'Centro-Noroeste',
                polo: 'Juína',
                fill: '#6366F1',
                stroke: '#4F46E5',
                hoverFill: '#4338CA',
                dotColor: 'bg-indigo-600',
                badgeBg: 'bg-indigo-50',
                badgeText: 'text-indigo-700',
                badgeBorder: 'border-indigo-200',
                activeBtnClass: 'bg-indigo-600 text-white border-indigo-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-indigo-50',
                totalMunicipios: 7,
                populacao: '141.995'
            },
            'Oeste Matogrossense': {
                nome: 'Oeste (Cáceres)',
                macro: 'Oeste',
                polo: 'Cáceres',
                fill: '#0891B2',
                stroke: '#0E7490',
                hoverFill: '#155E75',
                dotColor: 'bg-cyan-600',
                badgeBg: 'bg-cyan-50',
                badgeText: 'text-cyan-700',
                badgeBorder: 'border-cyan-200',
                activeBtnClass: 'bg-cyan-600 text-white border-cyan-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-cyan-50',
                totalMunicipios: 12,
                populacao: '184.452'
            },
            'Sudoeste Matogrossense': {
                nome: 'Sudoeste (Pontes e Lacerda)',
                macro: 'Oeste',
                polo: 'Pontes e Lacerda',
                fill: '#0D9488',
                stroke: '#0F766E',
                hoverFill: '#115E59',
                dotColor: 'bg-teal-600',
                badgeBg: 'bg-teal-50',
                badgeText: 'text-teal-700',
                badgeBorder: 'border-teal-200',
                activeBtnClass: 'bg-teal-600 text-white border-teal-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-teal-50',
                totalMunicipios: 10,
                populacao: '124.245'
            },
            'Garças Araguaia': {
                nome: 'Garças Araguaia',
                macro: 'Leste',
                polo: 'Barra do Garças',
                fill: '#DB2777',
                stroke: '#BE185D',
                hoverFill: '#9D174D',
                dotColor: 'bg-pink-600',
                badgeBg: 'bg-pink-50',
                badgeText: 'text-pink-700',
                badgeBorder: 'border-pink-200',
                activeBtnClass: 'bg-pink-600 text-white border-pink-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-pink-50',
                totalMunicipios: 10,
                populacao: '141.350'
            },
            'Médio Araguaia': {
                nome: 'Médio Araguaia',
                macro: 'Leste',
                polo: 'Água Boa',
                fill: '#F43F5E',
                stroke: '#E11D48',
                hoverFill: '#BE123C',
                dotColor: 'bg-rose-600',
                badgeBg: 'bg-rose-50',
                badgeText: 'text-rose-700',
                badgeBorder: 'border-rose-200',
                activeBtnClass: 'bg-rose-600 text-white border-rose-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-rose-50',
                totalMunicipios: 8,
                populacao: '118.277'
            },
            'Araguaia Xingu': {
                nome: 'Araguaia Xingu',
                macro: 'Leste',
                polo: 'Porto Alegre do Norte',
                fill: '#E11D48',
                stroke: '#BE123C',
                hoverFill: '#9F1239',
                dotColor: 'bg-rose-700',
                badgeBg: 'bg-rose-50',
                badgeText: 'text-rose-800',
                badgeBorder: 'border-rose-200',
                activeBtnClass: 'bg-rose-700 text-white border-rose-700 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-rose-50',
                totalMunicipios: 7,
                populacao: '87.796'
            },
            'Norte Araguaia Karajá': {
                nome: 'Norte Araguaia Karajá',
                macro: 'Leste',
                polo: 'São Félix do Araguaia',
                fill: '#EA580C',
                stroke: '#C2410C',
                hoverFill: '#9A3412',
                dotColor: 'bg-orange-600',
                badgeBg: 'bg-orange-50',
                badgeText: 'text-orange-700',
                badgeBorder: 'border-orange-200',
                activeBtnClass: 'bg-orange-600 text-white border-orange-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-orange-50',
                totalMunicipios: 5,
                populacao: '25.660'
            },
            'Teles Pires': {
                nome: 'Teles Pires (Sinop)',
                macro: 'Norte',
                polo: 'Sinop',
                fill: '#059669',
                stroke: '#047857',
                hoverFill: '#065F46',
                dotColor: 'bg-emerald-600',
                badgeBg: 'bg-emerald-50',
                badgeText: 'text-emerald-700',
                badgeBorder: 'border-emerald-200',
                activeBtnClass: 'bg-emerald-600 text-white border-emerald-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-emerald-50',
                totalMunicipios: 15,
                populacao: '539.012'
            },
            'Norte Matogrossense': {
                nome: 'Norte MT (Colíder)',
                macro: 'Norte',
                polo: 'Colíder',
                fill: '#16A34A',
                stroke: '#15803D',
                hoverFill: '#166534',
                dotColor: 'bg-green-600',
                badgeBg: 'bg-green-50',
                badgeText: 'text-green-700',
                badgeBorder: 'border-green-200',
                activeBtnClass: 'bg-green-600 text-white border-green-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-green-50',
                totalMunicipios: 6,
                populacao: '68.322'
            },
            'Vale do Peixoto': {
                nome: 'Vale do Peixoto',
                macro: 'Norte',
                polo: 'Peixoto de Azevedo',
                fill: '#65A30D',
                stroke: '#4D7C0F',
                hoverFill: '#3F6212',
                dotColor: 'bg-lime-600',
                badgeBg: 'bg-lime-50',
                badgeText: 'text-lime-700',
                badgeBorder: 'border-lime-200',
                activeBtnClass: 'bg-lime-600 text-white border-lime-600 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-lime-50',
                totalMunicipios: 5,
                populacao: '100.965'
            },
            'Alto Tapajós': {
                nome: 'Alto Tapajós',
                macro: 'Norte',
                polo: 'Alta Floresta',
                fill: '#10B981',
                stroke: '#059669',
                hoverFill: '#047857',
                dotColor: 'bg-emerald-500',
                badgeBg: 'bg-emerald-50',
                badgeText: 'text-emerald-700',
                badgeBorder: 'border-emerald-200',
                activeBtnClass: 'bg-emerald-500 text-white border-emerald-500 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-emerald-50',
                totalMunicipios: 6,
                populacao: '111.154'
            },
            'Vale do Arinos': {
                nome: 'Vale do Arinos',
                macro: 'Norte',
                polo: 'Juara',
                fill: '#84CC16',
                stroke: '#65A30D',
                hoverFill: '#4D7C0F',
                dotColor: 'bg-lime-500',
                badgeBg: 'bg-lime-50',
                badgeText: 'text-lime-700',
                badgeBorder: 'border-lime-200',
                activeBtnClass: 'bg-lime-500 text-white border-lime-500 shadow-sm',
                inactiveBtnClass: 'bg-white text-slate-700 border-slate-200 hover:bg-lime-50',
                totalMunicipios: 4,
                populacao: '53.666'
            }
        },

        get activeDisplay() {
            return this.hoveredMunicipio || this.selectedMunicipio || {
                nome: 'Cuiabá',
                codarea: '5103403',
                populacao_formatada: '650.877 hab.',
                macrorregiao: 'Centro-Norte',
                regiao_saude: 'Baixada Cuiabana',
                polo_macro: 'Cuiabá',
                polo_micro: 'Cuiabá'
            };
        },

        get activeMacroDetails() {
            if (this.macroFilter && this.macroConfig[this.macroFilter]) {
                return this.macroConfig[this.macroFilter];
            }
            return null;
        },

        get activeMicroDetails() {
            if (this.microFilter && this.microConfig[this.microFilter]) {
                return this.microConfig[this.microFilter];
            }
            return null;
        },

        getDisplayBadgeClass() {
            if (this.filterLevel === 'micro') {
                const conf = this.microConfig[this.activeDisplay.regiao_saude];
                return conf ? conf.badgeBg + ' ' + conf.badgeBorder + ' ' + conf.badgeText : 'bg-emerald-50 border-emerald-100 text-emerald-800';
            }
            const conf = this.macroConfig[this.activeDisplay.macrorregiao];
            return conf ? conf.badgeBg + ' ' + conf.badgeBorder + ' ' + conf.badgeText : 'bg-blue-50 border-blue-100 text-[#004B8D]';
        },

        getSelectedBadgeClass() {
            if (this.selectedMunicipio) {
                if (this.filterLevel === 'micro') {
                    const conf = this.microConfig[this.selectedMunicipio.regiao_saude];
                    return conf ? conf.badgeBg + ' ' + conf.badgeText : 'bg-emerald-50 text-emerald-800';
                }
                const conf = this.macroConfig[this.selectedMunicipio.macrorregiao];
                return conf ? conf.badgeBg + ' ' + conf.badgeText : 'bg-blue-50 text-govmt-blue';
            }
            return 'bg-blue-50 text-govmt-blue';
        },

        getMicrosOfMacro(macro) {
            return Object.keys(this.microConfig).filter(k => this.microConfig[k].macro === macro);
        },

        // --- GETTERS E MÉTODOS DA RÉGUA DE DISTÂNCIAS ---
        get capitalMunicipio() {
            return this.municipiosList.find(m => m.nome === 'Cuiabá' || m.codarea === '5103403') || this.municipiosList[0] || null;
        },

        get ersMunicipio() {
            return this.getErsMunicipio(this.origemMunicipio);
        },

        get distRouteKm() {
            if (!this.origemMunicipio || !this.destinoMunicipio) return 0;
            if (this.origemMunicipio.codarea === this.destinoMunicipio.codarea) return 0;
            return this.calcHaversine(this.origemMunicipio.lat, this.origemMunicipio.lon, this.destinoMunicipio.lat, this.destinoMunicipio.lon);
        },

        get distRouteRoadKm() {
            return this.estimateRoadKm(this.distRouteKm);
        },

        get distRouteTime() {
            return this.estimateDriveTime(this.distRouteRoadKm);
        },

        get distErsKm() {
            if (!this.origemMunicipio || !this.ersMunicipio) return 0;
            if (this.origemMunicipio.codarea === this.ersMunicipio.codarea) return 0;
            return this.calcHaversine(this.origemMunicipio.lat, this.origemMunicipio.lon, this.ersMunicipio.lat, this.ersMunicipio.lon);
        },

        get distErsRoadKm() {
            return this.estimateRoadKm(this.distErsKm);
        },

        get distCapitalKm() {
            if (!this.origemMunicipio || !this.capitalMunicipio) return 0;
            if (this.origemMunicipio.codarea === this.capitalMunicipio.codarea) return 0;
            return this.calcHaversine(this.origemMunicipio.lat, this.origemMunicipio.lon, this.capitalMunicipio.lat, this.capitalMunicipio.lon);
        },

        get distCapitalRoadKm() {
            return this.estimateRoadKm(this.distCapitalKm);
        },

        get distCapitalTime() {
            return this.estimateDriveTime(this.distCapitalRoadKm);
        },

        get selectedErsDist() {
            if (!this.selectedMunicipio) return 0;
            const ers = this.getErsMunicipio(this.selectedMunicipio);
            if (!ers || ers.codarea === this.selectedMunicipio.codarea) return 0;
            return this.calcHaversine(this.selectedMunicipio.lat, this.selectedMunicipio.lon, ers.lat, ers.lon);
        },

        get selectedErsName() {
            if (!this.selectedMunicipio) return 'Cuiabá';
            const ers = this.getErsMunicipio(this.selectedMunicipio);
            return ers ? ers.nome : (this.selectedMunicipio.sede_ers || 'Cuiabá');
        },

        get selectedCapitalDist() {
            if (!this.selectedMunicipio || !this.capitalMunicipio) return 0;
            if (this.selectedMunicipio.codarea === this.capitalMunicipio.codarea) return 0;
            return this.calcHaversine(this.selectedMunicipio.lat, this.selectedMunicipio.lon, this.capitalMunicipio.lat, this.capitalMunicipio.lon);
        },

        calcHaversine(lat1, lon1, lat2, lon2) {
            if (lat1 === undefined || lon1 === undefined || lat2 === undefined || lon2 === undefined) return 0;
            const R = 6371;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return Math.round(R * c);
        },

        estimateRoadKm(km) {
            if (!km) return 0;
            return Math.round(km * 1.25);
        },

        estimateDriveTime(km) {
            if (!km) return '0 min';
            const hours = km / 75;
            const h = Math.floor(hours);
            const m = Math.round((hours - h) * 60);
            if (h === 0) return `${m} min`;
            return `${h}h ${m > 0 ? m + 'min' : ''}`;
        },

        getErsMunicipio(mun) {
            if (!mun) return null;
            const ersName = (mun.sede_ers || mun.polo_micro || '').toLowerCase().trim();
            return this.municipiosList.find(m => m.nome.toLowerCase().trim() === ersName)
                || this.municipiosList.find(m => m.nome.toLowerCase().includes(ersName))
                || null;
        },

        toggleDistanceMode() {
            if (this.distanceMode) {
                this.disableDistanceMode();
            } else {
                this.enableDistanceMode();
            }
        },

        enableDistanceMode(mun = null) {
            this.distanceMode = true;
            if (mun) {
                this.origemMunicipio = mun;
                this.selectedMunicipio = mun;
            } else if (!this.origemMunicipio) {
                this.origemMunicipio = this.selectedMunicipio || this.municipiosList[0];
            }
            if (!this.destinoMunicipio) {
                const sinop = this.municipiosList.find(m => m.nome.includes('Sinop'));
                this.destinoMunicipio = (this.origemMunicipio && sinop && this.origemMunicipio.codarea === sinop.codarea)
                    ? this.capitalMunicipio
                    : (sinop || this.capitalMunicipio);
            }
            this.pickingTarget = 'destino';
            this.updateAllPaths();
            this.$nextTick(() => {
                this.renderDistanceLines();
            });
        },

        disableDistanceMode() {
            this.distanceMode = false;
            this.updateAllPaths();
            this.clearDistanceLayers();
        },

        invertPoints() {
            const temp = this.origemMunicipio;
            this.origemMunicipio = this.destinoMunicipio;
            this.destinoMunicipio = temp;
            this.selectedMunicipio = this.origemMunicipio;
            this.updateAllPaths();
            this.renderDistanceLines();
        },

        clearDistanceLayers() {
            const routesGroup = document.getElementById('routes-group');
            const markersGroup = document.getElementById('markers-group');
            const badgesGroup = document.getElementById('badges-group');
            if (routesGroup) routesGroup.innerHTML = '';
            if (markersGroup) markersGroup.innerHTML = '';
            if (badgesGroup) badgesGroup.innerHTML = '';
        },

        createCurvedPath(p1, p2, offset = 20) {
            const x1 = p1[0], y1 = p1[1];
            const x2 = p2[0], y2 = p2[1];
            const dx = x2 - x1, dy = y2 - y1;
            const dist = Math.sqrt(dx * dx + dy * dy);
            if (dist < 1) {
                return { d: 'M ' + x1 + ' ' + y1 + ' L ' + x2 + ' ' + y2, mid: [x1, y1] };
            }
            const nx = -dy / dist;
            const ny = dx / dist;
            const actualOffset = Math.sign(offset) * Math.min(Math.abs(offset), dist * 0.16);
            const cx = (x1 + x2) / 2 + nx * actualOffset;
            const cy = (y1 + y2) / 2 + ny * actualOffset;
            const bx = 0.25 * x1 + 0.5 * cx + 0.25 * x2;
            const by = 0.25 * y1 + 0.5 * cy + 0.25 * y2;
            return {
                d: 'M ' + x1 + ' ' + y1 + ' Q ' + cx.toFixed(1) + ' ' + cy.toFixed(1) + ' ' + x2 + ' ' + y2,
                mid: [Math.round(bx), Math.round(by)]
            };
        },

        renderDistanceLines() {
            if (!this.distanceMode) {
                this.clearDistanceLayers();
                return;
            }
            const routesGroup = document.getElementById('routes-group');
            const markersGroup = document.getElementById('markers-group');
            const badgesGroup = document.getElementById('badges-group');
            if (!routesGroup || !markersGroup || !badgesGroup) return;

            routesGroup.innerHTML = '';
            markersGroup.innerHTML = '';
            badgesGroup.innerHTML = '';

            const NS = 'http://www.w3.org/2000/svg';
            const origem = this.origemMunicipio;
            if (!origem || !origem.center) return;

            const destino = this.destinoMunicipio;
            const ers = this.ersMunicipio;
            const capital = this.capitalMunicipio;

            const addPath = (curve, color, strokeWidth, animClass, dashArray = null) => {
                const path = document.createElementNS(NS, 'path');
                path.setAttribute('d', curve.d);
                path.setAttribute('fill', 'none');
                path.setAttribute('stroke', color);
                path.setAttribute('stroke-width', strokeWidth);
                path.setAttribute('stroke-linecap', 'round');
                if (dashArray) path.setAttribute('stroke-dasharray', dashArray);
                if (animClass) path.setAttribute('class', animClass);
                routesGroup.appendChild(path);
            };

            const addBadge = (mid, text, bgFill, strokeColor, textColor, title = '') => {
                const g = document.createElementNS(NS, 'g');
                g.setAttribute('transform', `translate(${mid[0]}, ${mid[1]})`);
                g.setAttribute('class', 'distance-badge cursor-pointer');
                if (title) {
                    const titleEl = document.createElementNS(NS, 'title');
                    titleEl.textContent = title;
                    g.appendChild(titleEl);
                }

                const width = Math.max(78, text.length * 7.5 + 24);
                const height = 26;
                const rect = document.createElementNS(NS, 'rect');
                rect.setAttribute('x', -width / 2);
                rect.setAttribute('y', -height / 2);
                rect.setAttribute('width', width);
                rect.setAttribute('height', height);
                rect.setAttribute('rx', 13);
                rect.setAttribute('fill', bgFill);
                rect.setAttribute('stroke', strokeColor);
                rect.setAttribute('stroke-width', '2');
                rect.setAttribute('filter', 'url(#badge-shadow)');

                const textEl = document.createElementNS(NS, 'text');
                textEl.setAttribute('x', '0');
                textEl.setAttribute('y', '4');
                textEl.setAttribute('text-anchor', 'middle');
                textEl.setAttribute('font-size', '11');
                textEl.setAttribute('font-weight', '800');
                textEl.setAttribute('fill', textColor);
                textEl.setAttribute('font-family', 'ui-sans-serif, system-ui, sans-serif');
                textEl.textContent = text;

                g.appendChild(rect);
                g.appendChild(textEl);
                badgesGroup.appendChild(g);
            };

            const addMarker = (pos, icon, label, color, isPulse = false) => {
                const g = document.createElementNS(NS, 'g');
                g.setAttribute('transform', `translate(${pos[0]}, ${pos[1]})`);

                if (isPulse) {
                    const pulse = document.createElementNS(NS, 'circle');
                    pulse.setAttribute('r', '18');
                    pulse.setAttribute('fill', color);
                    pulse.setAttribute('opacity', '0.28');
                    pulse.setAttribute('class', 'animate-ping-slow');
                    g.appendChild(pulse);
                }

                const outerCircle = document.createElementNS(NS, 'circle');
                outerCircle.setAttribute('r', '8');
                outerCircle.setAttribute('fill', color);
                outerCircle.setAttribute('stroke', '#FFFFFF');
                outerCircle.setAttribute('stroke-width', '2.5');
                g.appendChild(outerCircle);

                const innerCircle = document.createElementNS(NS, 'circle');
                innerCircle.setAttribute('r', '2.5');
                innerCircle.setAttribute('fill', '#FFFFFF');
                g.appendChild(innerCircle);

                const pillWidth = Math.max(68, label.length * 6.5 + 22);
                const pill = document.createElementNS(NS, 'rect');
                pill.setAttribute('x', -pillWidth / 2);
                pill.setAttribute('y', '-28');
                pill.setAttribute('width', pillWidth);
                pill.setAttribute('height', '18');
                pill.setAttribute('rx', '9');
                pill.setAttribute('fill', color);
                pill.setAttribute('filter', 'url(#badge-shadow)');
                g.appendChild(pill);

                const pillText = document.createElementNS(NS, 'text');
                pillText.setAttribute('x', '0');
                pillText.setAttribute('y', '-15');
                pillText.setAttribute('text-anchor', 'middle');
                pillText.setAttribute('font-size', '9');
                pillText.setAttribute('font-weight', '900');
                pillText.setAttribute('fill', '#FFFFFF');
                pillText.setAttribute('font-family', 'ui-sans-serif, system-ui, sans-serif');
                pillText.textContent = `${icon} ${label}`;
                g.appendChild(pillText);

                markersGroup.appendChild(g);
            };

            // 1. ROTA ORIGEM ↔ DESTINO
            if (destino && destino.center && this.showRouteLine && destino.codarea !== origem.codarea) {
                const distKm = this.distRouteKm;
                const curve = this.createCurvedPath(origem.center, destino.center, 22);
                addPath(curve, '#F59E0B', '3.5', 'route-line-anim');
                addBadge(curve.mid, `📍 ${distKm} km`, '#0F172A', '#F59E0B', '#FDE68A', `Distância entre ${origem.nome} e ${destino.nome}: ${distKm} km`);
                addMarker(destino.center, '🎯', destino.nome, '#3B82F6', true);
            }

            // 2. CONEXÃO ORIGEM ↔ ERS
            if (ers && ers.center && this.showErsLine && ers.codarea !== origem.codarea) {
                const distKm = this.distErsKm;
                const curve = this.createCurvedPath(origem.center, ers.center, -18);
                addPath(curve, '#10B981', '2.5', 'ers-line-anim', '6 4');
                addBadge(curve.mid, `🏥 ${distKm} km (ERS)`, '#064E3B', '#34D399', '#ECFDF5', `Distância até Escritório Regional (${ers.nome}): ${distKm} km`);
                if (!destino || destino.codarea !== ers.codarea) {
                    addMarker(ers.center, '🏥', `ERS ${ers.nome}`, '#10B981');
                }
            }

            // 3. CONEXÃO ORIGEM ↔ CAPITAL (Cuiabá)
            if (capital && capital.center && this.showCapitalLine && capital.codarea !== origem.codarea) {
                const distKm = this.distCapitalKm;
                const curve = this.createCurvedPath(origem.center, capital.center, 12);
                addPath(curve, '#3B82F6', '2.5', 'capital-line-anim', '5 5');
                addBadge(curve.mid, `🏛️ ${distKm} km (Capital)`, '#1E3A8A', '#60A5FA', '#EFF6FF', `Distância até Cuiabá (Capital): ${distKm} km`);
                if ((!destino || destino.codarea !== capital.codarea) && (!ers || ers.codarea !== capital.codarea)) {
                    addMarker(capital.center, '🏛️', 'Cuiabá (Capital)', '#1D4ED8');
                }
            }

            // 4. MARCADOR DA ORIGEM
            addMarker(origem.center, '🚩', origem.nome, '#D97706', true);
        },

        filterOrigemMunicipios() {
            const rawQ = (this.searchOrigem || '').trim();
            if (rawQ.length < 2) {
                this.filteredOrigemList = [];
                return;
            }
            const norm = (s) => (s || '').normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
            const q = norm(rawQ);
            this.filteredOrigemList = this.municipiosList.filter(m => norm(m.nome).includes(q));
        },

        filterDestinoMunicipios() {
            const rawQ = (this.searchDestino || '').trim();
            if (rawQ.length < 2) {
                this.filteredDestinoList = [];
                return;
            }
            const norm = (s) => (s || '').normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
            const q = norm(rawQ);
            this.filteredDestinoList = this.municipiosList.filter(m => norm(m.nome).includes(q));
        },

        selectOrigemByCod(cod) {
            const found = this.municipiosList.find(m => m.codarea == cod);
            if (found) {
                this.origemMunicipio = found;
                this.selectedMunicipio = found;
                this.searchOrigem = '';
                this.filteredOrigemList = [];
                this.updateAllPaths();
                this.renderDistanceLines();
            }
        },

        selectDestinoByCod(cod) {
            const found = this.municipiosList.find(m => m.codarea == cod);
            if (found) {
                this.destinoMunicipio = found;
                this.searchDestino = '';
                this.filteredDestinoList = [];
                this.updateAllPaths();
                this.renderDistanceLines();
            }
        },

        async init() {
            try {
                const response = await fetch('{{ asset("data/mt-municipios-paths.json") }}');
                const data = await response.json();
                this.municipiosList = data.municipios || [];

                // Cuiabá como padrão inicial
                const cuiaba = this.municipiosList.find(m => m.nome.includes('Cuiabá')) || this.municipiosList[0];
                this.selectedMunicipio = cuiaba;
                this.hoveredMunicipio = cuiaba;
                this.previousSelectedCod = cuiaba ? cuiaba.codarea : null;

                // Padrões da régua de distâncias
                this.origemMunicipio = cuiaba;
                const sinop = this.municipiosList.find(m => m.nome.includes('Sinop'));
                this.destinoMunicipio = sinop || this.municipiosList[1] || cuiaba;

                // Renderiza polígonos SVG
                this.$nextTick(() => {
                    this.renderPaths();
                });
            } catch (error) {
                console.error('Erro ao carregar dados do mapa de MT:', error);
            } finally {
                this.loading = false;
            }
        },

        getMunicipioBaseStyle(mun) {
            // Estilos em Modo Régua de Distâncias
            if (this.distanceMode) {
                const isOrigem = this.origemMunicipio && mun.codarea === this.origemMunicipio.codarea;
                const isDestino = this.destinoMunicipio && mun.codarea === this.destinoMunicipio.codarea;
                const ers = this.ersMunicipio;
                const isErs = ers && mun.codarea === ers.codarea;
                const isCapital = this.capitalMunicipio && mun.codarea === this.capitalMunicipio.codarea;

                if (isOrigem) {
                    return {
                        fill: '#F59E0B',
                        stroke: '#92400E',
                        strokeWidth: '3.0',
                        opacity: '1'
                    };
                }
                if (isDestino) {
                    return {
                        fill: '#3B82F6',
                        stroke: '#1E40AF',
                        strokeWidth: '3.0',
                        opacity: '1'
                    };
                }
                if (isErs && this.showErsLine) {
                    return {
                        fill: '#10B981',
                        stroke: '#065F46',
                        strokeWidth: '2.4',
                        opacity: '1'
                    };
                }
                if (isCapital && this.showCapitalLine) {
                    return {
                        fill: '#6366F1',
                        stroke: '#3730A3',
                        strokeWidth: '2.4',
                        opacity: '1'
                    };
                }

                return { fill: '#F8FAFC', stroke: '#CBD5E1', strokeWidth: '0.6', opacity: '0.40' };
            }

            const isSelected = this.isSelected(mun);

            // 1. Município Selecionado em destaque (modo normal)
            if (isSelected) {
                return {
                    fill: '#004B8D',
                    stroke: '#002B52',
                    strokeWidth: '2.8',
                    opacity: '1'
                };
            }

            // 2. Modo Neutro / Padrão
            if (this.filterLevel === 'padrao') {
                return {
                    fill: '#F1F5F9',
                    stroke: '#CBD5E1',
                    strokeWidth: '0.9',
                    opacity: '1'
                };
            }

            // 3. Nível: 6 MACRORREGIÕES
            if (this.filterLevel === 'macro') {
                if (this.macroFilter === 'todas') {
                    const conf = this.macroConfig[mun.macrorregiao];
                    return {
                        fill: conf ? conf.fill : '#CBD5E1',
                        stroke: conf ? conf.stroke : '#94A3B8',
                        strokeWidth: '0.95',
                        opacity: '0.92'
                    };
                }

                if (mun.macrorregiao === this.macroFilter) {
                    const conf = this.macroConfig[mun.macrorregiao];
                    return {
                        fill: conf ? conf.fill : '#3B82F6',
                        stroke: conf ? conf.stroke : '#1D4ED8',
                        strokeWidth: '1.4',
                        opacity: '1'
                    };
                } else {
                    return {
                        fill: '#F8FAFC',
                        stroke: '#E2E8F0',
                        strokeWidth: '0.6',
                        opacity: '0.32'
                    };
                }
            }

            // 4. Nível: 16 MICRORREGIÕES (CIR)
            if (this.filterLevel === 'micro') {
                if (this.microFilter === 'todas') {
                    const conf = this.microConfig[mun.regiao_saude];
                    return {
                        fill: conf ? conf.fill : '#CBD5E1',
                        stroke: conf ? conf.stroke : '#94A3B8',
                        strokeWidth: '0.95',
                        opacity: '0.92'
                    };
                }

                if (mun.regiao_saude === this.microFilter) {
                    const conf = this.microConfig[mun.regiao_saude];
                    return {
                        fill: conf ? conf.fill : '#10B981',
                        stroke: conf ? conf.stroke : '#047857',
                        strokeWidth: '1.6',
                        opacity: '1'
                    };
                } else {
                    return {
                        fill: '#F8FAFC',
                        stroke: '#E2E8F0',
                        strokeWidth: '0.6',
                        opacity: '0.30'
                    };
                }
            }

            return { fill: '#F1F5F9', stroke: '#CBD5E1', strokeWidth: '0.9', opacity: '1' };
        },

        applyPathStyle(path, mun) {
            const style = this.getMunicipioBaseStyle(mun);
            path.setAttribute('fill', style.fill);
            path.setAttribute('stroke', style.stroke);
            path.setAttribute('stroke-width', style.strokeWidth);
            path.style.opacity = style.opacity;
        },

        renderPaths() {
            const group = document.getElementById('municipios-group');
            if (!group) return;

            group.innerHTML = '';
            const fragment = document.createDocumentFragment();

            this.municipiosList.forEach(mun => {
                const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
                path.setAttribute('d', mun.d);
                path.setAttribute('id', 'mun-' + mun.codarea);
                path.setAttribute('data-cod', mun.codarea);
                path.setAttribute('class', 'municipio-shape');
                path.style.cursor = 'pointer';
                path.style.transition = 'fill 0.18s ease, stroke 0.18s ease, stroke-width 0.18s ease, opacity 0.18s ease';

                this.applyPathStyle(path, mun);

                // MouseEnter: feedback visual refinado
                path.addEventListener('mouseenter', () => {
                    this.hoveredMunicipio = mun;
                    
                    if (this.distanceMode) {
                        path.setAttribute('fill', '#FCD34D');
                        path.setAttribute('stroke', '#B45309');
                        path.setAttribute('stroke-width', '2.6');
                        path.style.opacity = '1';
                        return;
                    }

                    // Se for o município atualmente selecionado, mantém a seleção e dá foco de realce
                    if (this.isSelected(mun)) {
                        path.setAttribute('fill', '#003366');
                        path.setAttribute('stroke', '#FFFFFF');
                        path.setAttribute('stroke-width', '3.2');
                        path.style.opacity = '1';
                        return;
                    }

                    if (this.filterLevel === 'padrao') {
                        path.setAttribute('fill', '#38BDF8');
                        path.setAttribute('stroke', '#0284C7');
                        path.setAttribute('stroke-width', '1.8');
                        path.style.opacity = '1';
                    } else if (this.filterLevel === 'macro') {
                        if (this.macroFilter === 'todas' || mun.macrorregiao === this.macroFilter) {
                            const conf = this.macroConfig[mun.macrorregiao];
                            path.setAttribute('fill', conf ? conf.hoverFill : '#0284C7');
                            path.setAttribute('stroke', '#FFFFFF');
                            path.setAttribute('stroke-width', '2.2');
                            path.style.opacity = '1';
                        } else {
                            path.setAttribute('fill', '#CBD5E1');
                            path.setAttribute('stroke', '#94A3B8');
                            path.setAttribute('stroke-width', '1.0');
                            path.style.opacity = '0.7';
                        }
                    } else if (this.filterLevel === 'micro') {
                        if (this.microFilter === 'todas' || mun.regiao_saude === this.microFilter) {
                            const conf = this.microConfig[mun.regiao_saude];
                            path.setAttribute('fill', conf ? conf.hoverFill : '#047857');
                            path.setAttribute('stroke', '#FFFFFF');
                            path.setAttribute('stroke-width', '2.4');
                            path.style.opacity = '1';
                        } else {
                            path.setAttribute('fill', '#CBD5E1');
                            path.setAttribute('stroke', '#94A3B8');
                            path.setAttribute('stroke-width', '1.0');
                            path.style.opacity = '0.7';
                        }
                    }
                });

                // MouseLeave: sempre restaura o estilo base oficial (selecionado ou filtro ativo)
                path.addEventListener('mouseleave', () => {
                    this.hoveredMunicipio = null;
                    this.applyPathStyle(path, mun);
                });

                // Click
                path.addEventListener('click', () => {
                    this.selectMunicipio(mun);
                });

                fragment.appendChild(path);
            });

            group.appendChild(fragment);
            this.highlightSelected();
        },

        isSelected(mun) {
            return this.selectedMunicipio && mun && this.selectedMunicipio.codarea === mun.codarea;
        },

        selectMunicipio(mun) {
            if (!mun) return;
            if (this.distanceMode) {
                if (this.pickingTarget === 'origem') {
                    this.origemMunicipio = mun;
                    this.selectedMunicipio = mun;
                    this.hoveredMunicipio = mun;
                    this.pickingTarget = 'destino';
                } else {
                    this.destinoMunicipio = mun;
                    this.hoveredMunicipio = mun;
                }
                this.updateAllPaths();
                this.renderDistanceLines();
                return;
            }
            const prevCod = this.selectedMunicipio ? this.selectedMunicipio.codarea : null;
            this.selectedMunicipio = mun;
            this.hoveredMunicipio = mun;
            this.highlightSelected(prevCod);
        },

        selectMunicipioByCod(cod) {
            const found = this.municipiosList.find(m => m.codarea == cod);
            if (found) {
                this.selectMunicipio(found);
                this.searchQuery = '';
                this.filteredList = [];
            }
        },

        setFilterLevel(level) {
            this.filterLevel = level;
            this.updateAllPaths();
        },

        setMacroFilter(macro) {
            if (this.macroFilter === macro && macro !== 'todas') {
                this.macroFilter = 'todas';
            } else {
                this.macroFilter = macro;
            }

            this.updateAllPaths();

            if (this.macroFilter !== 'todas') {
                const poloName = this.macroConfig[this.macroFilter]?.polo;
                if (poloName) {
                    const poloMun = this.municipiosList.find(m => (m.nome || '').toLowerCase().includes(poloName.toLowerCase()));
                    if (poloMun && (!this.selectedMunicipio || this.selectedMunicipio.macrorregiao !== this.macroFilter)) {
                        this.selectMunicipio(poloMun);
                    }
                }
            }
        },

        setMicroFilter(micro) {
            if (this.microFilter === micro && micro !== 'todas') {
                this.microFilter = 'todas';
            } else {
                this.microFilter = micro;
            }

            this.updateAllPaths();

            if (this.microFilter !== 'todas') {
                const poloName = this.microConfig[this.microFilter]?.polo;
                if (poloName) {
                    const poloMun = this.municipiosList.find(m => (m.nome || '').toLowerCase().includes(poloName.toLowerCase()));
                    if (poloMun && (!this.selectedMunicipio || this.selectedMunicipio.regiao_saude !== this.microFilter)) {
                        this.selectMunicipio(poloMun);
                    }
                }
            }
        },

        updateAllPaths() {
            const group = document.getElementById('municipios-group');
            if (!group) return;

            const paths = group.querySelectorAll('path');
            paths.forEach(p => {
                const cod = p.getAttribute('data-cod');
                const mun = this.municipiosList.find(m => m.codarea === cod);
                if (mun) {
                    this.applyPathStyle(p, mun);
                }
            });

            this.highlightSelected();
        },

        highlightSelected(prevCod = null) {
            if (!this.selectedMunicipio) return;
            const group = document.getElementById('municipios-group');
            if (!group) return;

            // 1. Restaura imediatamente o município anteriormente selecionado para seu estilo original
            const oldCod = prevCod || this.previousSelectedCod;
            if (oldCod && oldCod !== this.selectedMunicipio.codarea) {
                const prevPath = group.querySelector(`path[data-cod="${oldCod}"]`);
                const prevMun = this.municipiosList.find(m => m.codarea === oldCod);
                if (prevPath && prevMun) {
                    this.applyPathStyle(prevPath, prevMun);
                }
            }

            // 2. Aplica o estilo de selecionado no município atual e eleva no SVG
            const selectedPath = group.querySelector(`path[data-cod="${this.selectedMunicipio.codarea}"]`);
            if (selectedPath) {
                this.applyPathStyle(selectedPath, this.selectedMunicipio);
                // Eleva para o topo da pilha SVG para borda não ser cortada pelos vizinhos
                group.appendChild(selectedPath);
            }

            this.previousSelectedCod = this.selectedMunicipio.codarea;
        },

        filterMunicipios() {
            const rawQ = (this.searchQuery || '').trim();
            if (rawQ.length < 2) {
                this.filteredList = [];
                return;
            }
            const norm = (s) => (s || '').normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
            const q = norm(rawQ);
            this.filteredList = this.municipiosList.filter(m => norm(m.nome).includes(q));
        },

        resetMap() {
            this.filterLevel = 'macro';
            this.macroFilter = 'todas';
            this.microFilter = 'todas';
            const cuiaba = this.municipiosList.find(m => m.nome.includes('Cuiabá')) || this.municipiosList[0];
            const sinop = this.municipiosList.find(m => m.nome.includes('Sinop'));
            this.origemMunicipio = cuiaba;
            this.destinoMunicipio = sinop || this.municipiosList[1] || cuiaba;
            this.searchQuery = '';
            this.searchOrigem = '';
            this.searchDestino = '';
            this.filteredList = [];
            this.filteredOrigemList = [];
            this.filteredDestinoList = [];
            this.updateAllPaths();
            this.selectMunicipio(cuiaba);
            if (this.distanceMode) {
                this.renderDistanceLines();
            } else {
                this.clearDistanceLayers();
            }
        }
    };
}
</script>
@endsection
