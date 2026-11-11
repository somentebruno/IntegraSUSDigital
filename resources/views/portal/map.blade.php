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
                    Malha Geográfica Oficial do IBGE
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                    Cobertura Estadual de Saúde Digital em Mato Grosso
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Visualização vetorial interativa com 100% dos municípios integrados à rede estadual de telessaúde da SES-MT.
                </p>
            </div>

            <!-- Resumo Rápido e Botão Redefinir -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2.5 bg-white px-4 py-2.5 rounded-2xl border border-slate-200/90 shadow-xs">
                    <span class="w-3 h-3 rounded-full bg-[#004B8D] ring-2 ring-blue-300/40"></span>
                    <span class="text-xs font-bold text-slate-700">142 Municípios • 3,65 Mi Habitantes</span>
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
            <div class="lg:col-span-9 xl:col-span-10 bg-white rounded-3xl border border-slate-200/90 shadow-sm relative overflow-hidden flex flex-col justify-between p-4 sm:p-6 min-h-[720px] lg:min-h-[820px]">
                
                <!-- Barra Superior Flutuante: Busca Rápida + Status -->
                <div class="flex flex-wrap items-center justify-between gap-3 pb-3 border-b border-slate-100 z-10">
                    
                    <!-- Busca rápida integrada no topo do mapa -->
                    <div class="relative w-full sm:w-80">
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
                            class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600"
                        >
                            <x-heroicon-o-x-mark class="w-3.5 h-3.5" />
                        </button>

                        <!-- Autocomplete Dropdown suspenso -->
                        <div
                            x-show="searchQuery.length >= 2"
                            class="absolute top-full left-0 right-0 mt-1 max-h-56 overflow-y-auto bg-white rounded-2xl shadow-xl border border-slate-200/90 divide-y divide-slate-100 z-30"
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
                                        <span class="text-[10px] text-slate-400 font-normal" x-text="(mun.populacao_formatada || '') + (mun.regiao ? ' • ' + mun.regiao : '')"></span>
                                    </div>
                                    <span class="text-[10px] text-slate-400 font-mono" x-text="mun.codarea"></span>
                                </button>
                            </template>
                            <div x-show="filteredList.length === 0" class="p-3 text-xs text-slate-400 text-center">
                                Nenhum município encontrado
                            </div>
                        </div>
                    </div>

                    <!-- Legenda Horizontal Discreta -->
                    <div class="flex items-center gap-4 text-xs font-medium text-slate-500">
                        <span class="inline-flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded-sm bg-[#004B8D]"></span>
                            <span class="text-slate-700 font-semibold">Selecionado</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded-sm bg-[#F1F5F9] border border-slate-300"></span>
                            <span>Integrado (100%)</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded-sm bg-[#38BDF8]"></span>
                            <span>Destaque</span>
                        </span>
                    </div>

                </div>

                <!-- Canvas Vetorial SVG do Mapa (100% da área, sem bordas pesadas) -->
                <div class="relative w-full flex-1 flex items-center justify-center my-2 overflow-hidden" id="canvas-container" style="min-height: 640px;">
                    
                    <!-- Loading Spinner -->
                    <div x-show="loading" class="absolute inset-0 bg-white/95 backdrop-blur-xs flex flex-col items-center justify-center z-30 gap-3">
                        <div class="w-10 h-10 border-4 border-govmt-blue border-t-transparent rounded-full animate-spin"></div>
                        <span class="text-xs font-bold text-slate-600">Renderizando malha geográfica oficial de Mato Grosso...</span>
                    </div>

                    <!-- SVG do Estado de Mato Grosso em Proporção 1000x850 com todos os 141 polígonos -->
                    <svg
                        id="mt-svg-map"
                        viewBox="0 0 1000 850"
                        class="w-full h-full max-h-[780px] select-none"
                        style="filter: drop-shadow(0 10px 24px rgba(0, 75, 141, 0.04));"
                    >
                        <g id="municipios-group"></g>
                    </svg>

                    <!-- Card Flutuante de Município no Canto Inferior Direito (Idêntico ao anexo de referência + População) -->
                    <div
                        x-show="hoveredMunicipio || selectedMunicipio"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        class="absolute bottom-5 right-5 bg-white/95 backdrop-blur-md p-4 sm:p-5 rounded-3xl shadow-2xl border border-slate-200/90 z-20 w-68 sm:w-80 space-y-3 pointer-events-auto"
                    >
                        <div class="flex items-start gap-3.5">
                            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-govmt-blue flex items-center justify-center shrink-0 border border-sky-100 mt-0.5">
                                <x-heroicon-o-building-office-2 class="w-6 h-6 text-[#004B8D]" />
                            </div>
                            <div class="overflow-hidden flex-1">
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 block">MUNICÍPIO</span>
                                <h3 class="text-lg sm:text-xl font-black text-slate-900 leading-tight truncate" x-text="activeDisplay.nome"></h3>
                                <div class="flex items-center gap-1.5 text-xs text-slate-600 font-semibold mt-1" x-show="activeDisplay.populacao_formatada">
                                    <x-heroicon-o-users class="w-3.5 h-3.5 text-govmt-blue shrink-0" />
                                    <span x-text="activeDisplay.populacao_formatada"></span>
                                    <span class="text-[10px] font-normal text-slate-400">(IBGE)</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="inline-flex items-center gap-1.5 font-bold text-emerald-700 tracking-tight uppercase">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-emerald-300/40"></span>
                                INTEGRADO
                            </span>
                            <span class="font-mono text-xs font-semibold text-slate-400" x-text="'Ref: ' + (activeDisplay.codarea || activeDisplay.id)"></span>
                        </div>
                    </div>

                    <!-- Botão Circular de Redefinir / Fechar no Canto Superior Direito (Como na referência) -->
                    <button
                        type="button"
                        @click="resetMap()"
                        class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/90 backdrop-blur-xs border border-slate-200 hover:bg-slate-100 text-slate-500 hover:text-slate-800 flex items-center justify-center shadow-sm transition z-20 cursor-pointer"
                        title="Redefinir visualização"
                    >
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                    </button>

                </div>

                <!-- Rodapé da visualização -->
                <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-2">
                    <span>Base cartográfica: Malha Municipal do IBGE (UF 51 - Mato Grosso)</span>
                    <span class="font-semibold text-govmt-blue">Secretaria de Estado de Saúde • Governo de Mato Grosso</span>
                </div>

            </div>

            <!-- Coluna Lateral de Detalhes: 3 Colunas no LG / 2 Colunas no XL -->
            <div class="lg:col-span-3 xl:col-span-2 space-y-4">
                
                <!-- Card de Destaque do Município Selecionado -->
                <div class="bg-white p-5 rounded-3xl border border-slate-200/90 shadow-sm space-y-4">
                    <div class="flex items-start justify-between">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-govmt-blue flex items-center justify-center">
                            <x-heroicon-o-map-pin class="w-5 h-5 text-govmt-blue" />
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            100% ATIVO
                        </span>
                    </div>

                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Município Selecionado</span>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight" x-text="selectedMunicipio ? selectedMunicipio.nome : 'Cuiabá'"></h2>
                        <p class="text-xs text-slate-500 mt-0.5" x-text="selectedMunicipio ? 'Região: ' + selectedMunicipio.regiao : 'Capital • Polo Central'"></p>
                    </div>

                    <div class="pt-3 border-t border-slate-100 space-y-2 text-xs">
                        <div class="flex items-center justify-between p-2 bg-slate-50 rounded-xl">
                            <span class="text-slate-400 font-medium">Código IBGE</span>
                            <span class="font-mono font-bold text-slate-800" x-text="selectedMunicipio ? selectedMunicipio.codarea : '5103403'"></span>
                        </div>
                        <div class="flex items-center justify-between p-2 bg-slate-50 rounded-xl">
                            <span class="text-slate-400 font-medium">População (Censo)</span>
                            <span class="font-bold text-slate-800" x-text="selectedMunicipio && selectedMunicipio.populacao_formatada ? selectedMunicipio.populacao_formatada : '650.877 hab.'"></span>
                        </div>
                        <div class="flex items-center justify-between p-2 bg-slate-50 rounded-xl">
                            <span class="text-slate-400 font-medium">Telessaúde SES</span>
                            <span class="font-bold text-emerald-700">Homologado</span>
                        </div>
                    </div>

                    <a
                        href="{{ route('portal.services') }}"
                        class="w-full inline-flex items-center justify-center gap-2 bg-govmt-blue hover:bg-govmt-darkBlue text-white font-bold py-2.5 px-3 rounded-xl text-xs transition shadow-xs cursor-pointer"
                    >
                        <span>Ver Serviços da Rede</span>
                        <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                    </a>
                </div>

                <!-- Card de Eficiência e Apoio -->
                <div class="bg-gradient-to-br from-[#06152B] to-[#0B2545] p-5 rounded-3xl text-white shadow-sm space-y-2">
                    <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">Rede IntegraSUS MT</span>
                    <h3 class="text-sm font-bold text-white">Teleinterconsulta & Laudos</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Conectando profissionais da Atenção Primária aos médicos especialistas da rede estadual.
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

            </div>

        </div>

    </div>
</div>

<script>
function mapaMatoGrosso() {
    return {
        loading: true,
        municipiosList: [],
        filteredList: [],
        searchQuery: '',
        selectedMunicipio: null,
        hoveredMunicipio: null,

        get activeDisplay() {
            return this.hoveredMunicipio || this.selectedMunicipio || { nome: 'Cuiabá', codarea: '5103403', populacao_formatada: '650.877 hab.' };
        },

        async init() {
            try {
                // Carrega diretamente os caminhos vetoriais pré-calculados em alta precisão
                const response = await fetch('{{ asset("data/mt-municipios-paths.json") }}');
                const data = await response.json();
                this.municipiosList = data.municipios || [];

                // Define Cuiabá como padrão inicial
                const cuiaba = this.municipiosList.find(m => m.nome.includes('Cuiabá')) || this.municipiosList[0];
                this.selectedMunicipio = cuiaba;
                this.hoveredMunicipio = cuiaba;

                // Renderiza os polígonos SVG imediatamente no DOM
                this.$nextTick(() => {
                    this.renderPaths();
                });
            } catch (error) {
                console.error('Erro ao carregar dados do mapa de MT:', error);
            } finally {
                this.loading = false;
            }
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

                const isSelected = this.selectedMunicipio && this.selectedMunicipio.codarea === mun.codarea;
                
                path.setAttribute('fill', isSelected ? '#004B8D' : '#F1F5F9');
                path.setAttribute('stroke', isSelected ? '#002B52' : '#CBD5E1');
                path.setAttribute('stroke-width', isSelected ? '2.4' : '0.9');
                path.style.cursor = 'pointer';
                path.style.transition = 'fill 0.15s ease, stroke 0.15s ease, stroke-width 0.15s ease';

                // Interações de Mouse
                path.addEventListener('mouseenter', () => {
                    this.hoveredMunicipio = mun;
                    if (!this.isSelected(mun)) {
                        path.setAttribute('fill', '#38BDF8');
                        path.setAttribute('stroke', '#0284C7');
                        path.setAttribute('stroke-width', '1.6');
                    }
                });

                path.addEventListener('mouseleave', () => {
                    this.hoveredMunicipio = null;
                    if (!this.isSelected(mun)) {
                        path.setAttribute('fill', '#F1F5F9');
                        path.setAttribute('stroke', '#CBD5E1');
                        path.setAttribute('stroke-width', '0.9');
                    }
                });

                path.addEventListener('click', () => {
                    this.selectMunicipio(mun);
                });

                fragment.appendChild(path);
            });

            group.appendChild(fragment);

            // Garante que o selecionado fique no topo do empilhamento
            this.highlightSelected();
        },

        isSelected(mun) {
            return this.selectedMunicipio && mun && this.selectedMunicipio.codarea === mun.codarea;
        },

        selectMunicipio(mun) {
            this.selectedMunicipio = mun;
            this.hoveredMunicipio = mun;
            this.highlightSelected();
        },

        selectMunicipioByCod(cod) {
            const found = this.municipiosList.find(m => m.codarea == cod);
            if (found) {
                this.selectMunicipio(found);
                this.searchQuery = '';
                this.filteredList = [];
            }
        },

        highlightSelected() {
            if (!this.selectedMunicipio) return;
            const group = document.getElementById('municipios-group');
            if (!group) return;

            // Restaura todos os estilos
            const paths = group.querySelectorAll('path');
            paths.forEach(p => {
                const cod = p.getAttribute('data-cod');
                if (cod === this.selectedMunicipio.codarea) {
                    p.setAttribute('fill', '#004B8D');
                    p.setAttribute('stroke', '#002B52');
                    p.setAttribute('stroke-width', '2.4');
                    // Eleva para o topo da pilha SVG
                    group.appendChild(p);
                } else {
                    p.setAttribute('fill', '#F1F5F9');
                    p.setAttribute('stroke', '#CBD5E1');
                    p.setAttribute('stroke-width', '0.9');
                }
            });
        },

        filterMunicipios() {
            const q = this.searchQuery.toLowerCase().trim();
            if (q.length < 2) {
                this.filteredList = [];
                return;
            }
            this.filteredList = this.municipiosList.filter(m => (m.nome || '').toLowerCase().includes(q));
        },

        resetMap() {
            const cuiaba = this.municipiosList.find(m => m.nome.includes('Cuiabá')) || this.municipiosList[0];
            this.selectMunicipio(cuiaba);
            this.searchQuery = '';
            this.filteredList = [];
        }
    };
}
</script>
@endsection
