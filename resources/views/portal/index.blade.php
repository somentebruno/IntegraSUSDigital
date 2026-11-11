@extends('layouts.app')

@section('title', 'IntegraSUS Digital MT - Centro Integrado de Telessaúde e Telediagnóstico | SES-MT')

@section('content')

    <!-- 1. First Fold: 4 Portas de Entrada Rápida (Variação 3) -->
    <section class="relative bg-gradient-to-b from-slate-100/80 via-white to-slate-50 pt-10 pb-16 overflow-hidden border-b border-slate-200">
        <!-- Detalhe decorativo sutil de fundo -->
        <div class="absolute inset-0 bg-[radial-gradient(#004B8D_1px,transparent_1px)] [background-size:24px_24px] opacity-[0.03] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Cabeçalho Principal First-Fold -->
            <div class="text-center max-w-3xl mx-auto mb-10">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white border border-slate-200 shadow-sm text-xs font-bold text-govmt-blue mb-4">
                    <span class="w-2 h-2 rounded-full bg-govmt-green animate-pulse"></span>
                    <span>Rede Estadual de Saúde Digital em Operação Contínua</span>
                    <span class="text-slate-300">•</span>
                    <span class="text-slate-500 font-mono">Portaria GM/MS nº 12.301/2026</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight mb-4">
                    Saúde Digital Integral, Universal e Equitativa para os <span class="bg-gradient-to-r from-govmt-blue via-sus-600 to-govmt-green bg-clip-text text-transparent">142 Municípios</span> de Mato Grosso
                </h1>

                <p class="text-base sm:text-lg text-slate-600 leading-relaxed">
                    Plataforma estadual de telessaúde integrada às Redes de Atenção à Saúde do SUS-MT, promovendo acesso equitativo a laudos especializados, consultoria clínica e educação permanente para todos os 142 municípios.
                </p>
            </div>

            <!-- 4 Portas de Entrada Rápida (Utility Direct Doors) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-12">
                
                <!-- Porta 1: Rede de Telediagnóstico -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-govmt-blue/40 transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 text-govmt-blue flex items-center justify-center group-hover:bg-govmt-blue group-hover:text-white transition-colors duration-200">
                                <x-heroicon-o-eye class="w-6 h-6" />
                            </div>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 border border-blue-100">
                                Laudos Ágeis
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1.5 group-hover:text-govmt-blue transition-colors">
                            Rede de Telediagnóstico
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-6">
                            Emissão remota de laudos especializados em Raio-X, Retinografia, ECG, Espirometria e Estomatologia.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-govmt-blue">
                        <a href="{{ route('services.show', 'tele-retinografia') }}" class="inline-flex items-center gap-1 group-hover:underline">
                            Ver Laudos e Fluxos
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" />
                        </a>
                    </div>
                </div>

                <!-- Porta 2: Teleinterconsulta -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-govmt-green/40 transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-govmt-green flex items-center justify-center group-hover:bg-govmt-green group-hover:text-white transition-colors duration-200">
                                <x-heroicon-o-user-group class="w-6 h-6" />
                            </div>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-100">
                                Em Tempo Real
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1.5 group-hover:text-govmt-green transition-colors">
                            Teleinterconsulta
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-6">
                            Atendimento compartilhado por vídeo unindo o profissional da UBS, o médico especialista e o paciente.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-govmt-green">
                        <a href="{{ route('services.show', 'teleinterconsulta') }}" class="inline-flex items-center gap-1 group-hover:underline">
                            Entender a Modalidade
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" />
                        </a>
                    </div>
                </div>

                <!-- Porta 3: Teleconsultoria Clínica -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-sus-600/40 transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-sus-700 flex items-center justify-center group-hover:bg-sus-700 group-hover:text-white transition-colors duration-200">
                                <x-heroicon-o-chat-bubble-bottom-center-text class="w-6 h-6" />
                            </div>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-md bg-indigo-50 text-indigo-700 border border-indigo-100">
                                Até 72 Horas
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1.5 group-hover:text-sus-700 transition-colors">
                            Teleconsultoria Clínica
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-6">
                            Suporte biprofissional entre médicos para esclarecer condutas, dosagens e evitar encaminhamentos desnecessários.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-sus-700">
                        <a href="{{ route('services.show', 'teleconsultoria') }}" class="inline-flex items-center gap-1 group-hover:underline">
                            Solicitar Apoio Clínico
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" />
                        </a>
                    </div>
                </div>

                <!-- Porta 4: Tele-Educação MT -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-amber-500/40 transition-all duration-300 flex flex-col justify-between group hover:-translate-y-1">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-colors duration-200">
                                <x-heroicon-o-academic-cap class="w-6 h-6" />
                            </div>
                            <span class="text-[11px] font-bold px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 border border-amber-100">
                                Educação SUS
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1.5 group-hover:text-amber-600 transition-colors">
                            Tele-Educação MT
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-6">
                            Webconferências semanais, cursos técnicos e capacitação permanente para todos os trabalhadores do SUS-MT.
                        </p>
                    </div>
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-amber-600">
                        <a href="{{ route('services.show', 'tele-educacao') }}" class="inline-flex items-center gap-1 group-hover:underline">
                            Acessar Capacitações
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" />
                        </a>
                    </div>
                </div>

            </div>

            <!-- 2. Barômetro de Eficiência e Resolutividade da Telessaúde MT -->
            <div id="barometro" class="rounded-3xl bg-gradient-to-br from-[#06152B] via-[#0B2545] to-[#06152B] p-8 sm:p-10 text-white shadow-2xl border border-white/10 relative overflow-hidden">
                <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-sus-600/10 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-white/10 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-500/20 border border-blue-400/30 flex items-center justify-center">
                            <x-heroicon-o-chart-bar class="w-5 h-5 text-blue-400" />
                        </div>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-white">Barômetro de Eficiência e Resolutividade Estadual</h2>
                            <p class="text-xs text-slate-400">Dados consolidados do Núcleo de Telessaúde e Saúde Digital SES-MT</p>
                        </div>
                    </div>
                    <div class="text-xs font-mono text-slate-400 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Atualização Contínua • 100% dos Municípios
                    </div>
                </div>

                <!-- Grid dos 4 Indicadores Estratégicos Dinâmicos -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
                    @forelse ($indicators->take(4) as $index => $ind)
                        @php
                            // Cores de destaque elegantes para cada métrica
                            $valueColor = match($index) {
                                0 => 'text-white',
                                1 => 'text-govmt-gold',
                                2 => 'text-emerald-400',
                                3 => 'text-blue-400',
                                default => 'text-white',
                            };
                        @endphp
                        <div>
                            <div class="text-3xl sm:text-4xl lg:text-5xl font-black {{ $valueColor }} tracking-tight mb-1 flex items-baseline gap-1">
                                <span>{{ $ind->value }}</span>
                                @if($ind->suffix && !str_contains($ind->value, $ind->suffix))
                                    <span class="text-sm sm:text-base font-semibold text-slate-400 font-sans opacity-90">{{ $ind->suffix }}</span>
                                @endif
                            </div>
                            <div class="text-sm font-bold text-slate-200 mb-0.5">{{ $ind->title }}</div>
                            <p class="text-xs text-slate-400 leading-relaxed">{{ $ind->description }}</p>
                        </div>
                    @empty
                        <div>
                            <div class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight mb-1">
                                142<span class="text-blue-400 text-2xl sm:text-3xl font-bold">/142</span>
                            </div>
                            <div class="text-sm font-bold text-slate-200 mb-0.5">Municípios com Adesão Ativa</div>
                            <p class="text-xs text-slate-400">100% de cobertura territorial em Mato Grosso</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </section>

    <!-- 3. Catálogo Operacional de Serviços com Filtro por Perfil Profissional (Variação 3) -->
    @php
        $servicesData = $services->map(function($s) {
            $slug = $s->slug;
            $cats = ['todos'];
            if (str_contains($slug, 'retinografia') || str_contains($slug, 'raio-x') || str_contains($slug, 'espirometria') || str_contains($slug, 'einstein') || str_contains($slug, 'hcor') || str_contains($slug, 'cardio') || str_contains($slug, 'dermatologia')) {
                $cats[] = 'medicos';
                $cats[] = 'enfermeiros';
            }
            if (str_contains($slug, 'estomatologia')) {
                $cats[] = 'odonto';
                $cats[] = 'medicos';
            }
            if (str_contains($slug, 'teleconsultoria') || str_contains($slug, 'especialidades')) {
                $cats[] = 'medicos';
            }
            if (str_contains($slug, 'educacao') || str_contains($slug, 'webconferencias') || str_contains($slug, 'suporte')) {
                $cats[] = 'medicos';
                $cats[] = 'enfermeiros';
                $cats[] = 'odonto';
            }
            return [
                'id' => $s->id,
                'profiles' => $cats,
            ];
        });
    @endphp

    <section
        class="py-16 bg-white"
        id="servicos"
        x-data="{
            currentFilter: 'todos',
            limit: 6,
            services: {{ Js::from($servicesData) }},
            setFilter(filter) {
                this.currentFilter = filter;
                this.limit = 6;
            },
            get filteredServices() {
                if (this.currentFilter === 'todos') {
                    return this.services;
                }
                return this.services.filter(s => s.profiles.includes(this.currentFilter));
            },
            get visibleServices() {
                return this.filteredServices.slice(0, this.limit);
            },
            get hasMore() {
                return this.limit < this.filteredServices.length;
            },
            get remainingCount() {
                return Math.max(0, this.filteredServices.length - this.limit);
            },
            get isExpanded() {
                return this.limit > 6;
            },
            loadMore() {
                this.limit += 3;
            },
            resetLimit() {
                this.limit = 6;
                document.getElementById('servicos').scrollIntoView({ behavior: 'smooth' });
            }
        }"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Cabeçalho Centralizado e Refinado da Seção -->
            <div class="text-center max-w-3xl mx-auto mb-8">
                <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-govmt-blue border border-blue-100/90 mb-3 tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-govmt-blue"></span>
                    Atenção Primária & Especializada
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">
                    Catálogo de Serviços Homologados
                </h2>
                <p class="text-sm sm:text-base text-slate-600 mt-2.5 leading-relaxed">
                    Filtre pelo perfil de atuação para consultar os fluxos, especialidades e sistemas habilitados pela SES-MT.
                </p>
            </div>

            <!-- Filtros Modernos em Pílulas Independentes (Sem caixa cinza pesada, sem quebras desordenadas, sem barra de rolagem) -->
            <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-3 mb-10">
                <button
                    type="button"
                    @click="setFilter('todos')"
                    :class="currentFilter === 'todos' 
                        ? 'bg-govmt-blue text-white shadow-md shadow-govmt-blue/25 ring-2 ring-govmt-blue/20 border-transparent' 
                        : 'bg-white text-slate-700 hover:text-govmt-blue hover:border-govmt-blue/40 hover:bg-slate-50/80 border-slate-200/90 shadow-xs'"
                    class="border px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-200 inline-flex items-center gap-2 cursor-pointer"
                >
                    <x-heroicon-o-squares-2x2 class="w-4 h-4" />
                    <span>Todos os Serviços</span>
                    <span
                        :class="currentFilter === 'todos' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600'"
                        class="px-2 py-0.5 rounded-full text-[11px] font-black transition-colors"
                        x-text="services.length"
                    ></span>
                </button>

                <button
                    type="button"
                    @click="setFilter('medicos')"
                    :class="currentFilter === 'medicos' 
                        ? 'bg-govmt-blue text-white shadow-md shadow-govmt-blue/25 ring-2 ring-govmt-blue/20 border-transparent' 
                        : 'bg-white text-slate-700 hover:text-govmt-blue hover:border-govmt-blue/40 hover:bg-slate-50/80 border-slate-200/90 shadow-xs'"
                    class="border px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-200 inline-flex items-center gap-2 cursor-pointer"
                >
                    <x-heroicon-o-user class="w-4 h-4" />
                    <span>Médicos</span>
                    <span
                        :class="currentFilter === 'medicos' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600'"
                        class="px-2 py-0.5 rounded-full text-[11px] font-black transition-colors"
                        x-text="services.filter(s => s.profiles.includes('medicos')).length"
                    ></span>
                </button>

                <button
                    type="button"
                    @click="setFilter('enfermeiros')"
                    :class="currentFilter === 'enfermeiros' 
                        ? 'bg-govmt-blue text-white shadow-md shadow-govmt-blue/25 ring-2 ring-govmt-blue/20 border-transparent' 
                        : 'bg-white text-slate-700 hover:text-govmt-blue hover:border-govmt-blue/40 hover:bg-slate-50/80 border-slate-200/90 shadow-xs'"
                    class="border px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-200 inline-flex items-center gap-2 cursor-pointer"
                >
                    <x-heroicon-o-shield-check class="w-4 h-4" />
                    <span>Enfermeiros</span>
                    <span
                        :class="currentFilter === 'enfermeiros' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600'"
                        class="px-2 py-0.5 rounded-full text-[11px] font-black transition-colors"
                        x-text="services.filter(s => s.profiles.includes('enfermeiros')).length"
                    ></span>
                </button>

                <button
                    type="button"
                    @click="setFilter('odonto')"
                    :class="currentFilter === 'odonto' 
                        ? 'bg-govmt-blue text-white shadow-md shadow-govmt-blue/25 ring-2 ring-govmt-blue/20 border-transparent' 
                        : 'bg-white text-slate-700 hover:text-govmt-blue hover:border-govmt-blue/40 hover:bg-slate-50/80 border-slate-200/90 shadow-xs'"
                    class="border px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold transition-all duration-200 inline-flex items-center gap-2 cursor-pointer"
                >
                    <x-heroicon-o-sparkles class="w-4 h-4" />
                    <span>Odontologia</span>
                    <span
                        :class="currentFilter === 'odonto' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600'"
                        class="px-2 py-0.5 rounded-full text-[11px] font-black transition-colors"
                        x-text="services.filter(s => s.profiles.includes('odonto')).length"
                    ></span>
                </button>
            </div>

            <!-- Grid de Serviços (Limite inicial dinâmico de 2 linhas x 3 colunas = 6 cards para QUALQUER filtro) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($services as $svc)
                    @php
                        $isNacional = str_contains($svc->category_type, 'Nacional');
                        
                        // Mapeamento institucional oficial das universidades e redes parceiras
                        $siglaParceiro = match($svc->slug) {
                            'tele-retinografia' => 'UFG',
                            'teledermatologia' => 'UFSC',
                            'tele-espirometria' => 'UFMG',
                            'tele-ecg-cardio' => 'UFMG',
                            'tele-estomatologia' => 'UFPB',
                            'tele-raio-x' => 'SES-MT',
                            'teleconsultoria', 'teleinterconsulta' => 'Rede SES',
                            'tele-educacao' => 'Tele-Educa',
                            'teleconsulta-carcere' => 'SES / SEJUSP',
                            default => $isNacional ? 'Rede Nac.' : 'SES-MT',
                        };

                        // Título limpo sem parênteses redundantes
                        $cleanTitle = preg_replace('/\s*\(.*?\)\s*/', ' ', $svc->title);
                        $cleanTitle = trim($cleanTitle);
                    @endphp

                    <div
                        x-show="visibleServices.some(s => s.id === {{ $svc->id }})"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-3"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="bg-slate-50/70 hover:bg-white rounded-2xl p-6 border border-slate-200/80 hover:border-govmt-blue/30 shadow-sm hover:shadow-xl transition-all duration-200 flex flex-col justify-between group"
                    >
                        <div>
                            <div class="flex items-start justify-between gap-3 mb-4">
                                <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 text-govmt-blue flex items-center justify-center shadow-sm group-hover:bg-govmt-blue group-hover:text-white transition-colors">
                                    <x-dynamic-component :component="$svc->icon" class="w-6 h-6" />
                                </div>

                                <!-- Pílula Oficial: Bandeira + Nacional/Estadual + Sigla da Instituição Parceira -->
                                <span
                                    class="inline-flex items-center gap-1.5 text-[11px] font-bold px-2.5 py-1 rounded-full {{ $isNacional ? 'bg-sky-50 text-sky-800 border border-sky-200/70' : 'bg-green-50 text-green-800 border border-green-200/70' }}"
                                    title="{{ $isNacional ? 'Oferta Nacional' : 'Oferta Estadual SUS-MT' }} • Parceiro Técnico: {{ $siglaParceiro }}"
                                >
                                    <img
                                        src="{{ asset($isNacional ? 'images/flag-brasil.svg' : 'images/flag-mato-grosso.svg') }}"
                                        alt="{{ $isNacional ? 'Brasil' : 'Mato Grosso' }}"
                                        class="w-4 h-[11px] rounded-[2px] shadow-sm object-cover"
                                        style="display:inline-block;"
                                    >
                                    <span>{{ $isNacional ? 'Nacional' : 'Estadual' }}</span>
                                    <span class="opacity-35">•</span>
                                    <span class="font-black tracking-tight text-govmt-blue">{{ $siglaParceiro }}</span>
                                </span>
                            </div>

                            <h3 class="text-base font-bold text-slate-900 group-hover:text-govmt-blue transition-colors mb-2 line-clamp-1">
                                {{ $cleanTitle }}
                            </h3>

                            <p class="text-xs text-slate-600 leading-relaxed mb-6 line-clamp-3">
                                {{ $svc->short_description }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-200/60 flex items-center justify-between text-xs">
                            @php
                                $scopeBadge = match($svc->slug) {
                                    'tele-raio-x' => 'Hospitais & UPAs',
                                    'tele-ecg-cardio' => 'Urgência, UPA & APS',
                                    'tele-estomatologia' => 'Saúde Bucal (CEO / UBS)',
                                    'teleconsultoria', 'teleinterconsulta' => 'APS & Especializada',
                                    'tele-educacao' => 'Rede Integrada SUS-MT',
                                    'teleconsulta-carcere' => 'Sistema Prisional (PPL)',
                                    default => 'Atenção Primária (APS)',
                                };
                            @endphp

                            <span class="text-slate-500 font-medium inline-flex items-center gap-1.5" title="Ponto de Atenção / Âmbito Operacional">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                {{ $scopeBadge }}
                            </span>

                            <a
                                href="{{ route('services.show', $svc->slug) }}"
                                class="font-bold text-govmt-blue hover:text-govmt-darkBlue inline-flex items-center gap-1 group-hover:underline"
                            >
                                Detalhes e Fluxo
                                <x-heroicon-o-chevron-right class="w-3.5 h-3.5" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Botões Reativos de Paginação Progressiva (+1 linha de 3 cards por clique) -->
            <div class="mt-12 flex flex-col items-center justify-center gap-4">
                
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <!-- Botão Ver Mais: adiciona mais 1 linha (3 cards) a cada clique -->
                    <template x-if="hasMore">
                        <button
                            type="button"
                            @click="loadMore()"
                            class="inline-flex items-center gap-2.5 text-sm font-bold text-govmt-blue hover:text-white bg-blue-50/80 hover:bg-govmt-blue border border-blue-200/80 hover:border-govmt-blue px-7 py-3 rounded-full transition-all duration-200 shadow-xs hover:shadow-md cursor-pointer group"
                        >
                            <x-heroicon-o-squares-plus class="w-4 h-4 text-govmt-blue group-hover:text-white transition-colors" />
                            <span>Carregar mais 3 serviços</span>
                            <span class="text-xs px-2 py-0.5 rounded-full bg-blue-100/80 group-hover:bg-white/20 text-govmt-blue group-hover:text-white font-bold transition-colors" x-text="'+' + Math.min(3, remainingCount)"></span>
                        </button>
                    </template>

                    <!-- Botão Recolher: visível sempre que o usuário tiver expandido além dos 6 iniciais -->
                    <template x-if="isExpanded">
                        <button
                            type="button"
                            @click="resetLimit()"
                            class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-100 border border-slate-200 shadow-xs px-6 py-3 rounded-full transition-all cursor-pointer"
                        >
                            <x-heroicon-o-chevron-up class="w-4 h-4" />
                            <span>Recolher para 6 principais</span>
                        </button>
                    </template>
                </div>

                <!-- Indicador discreto de progresso -->
                <p class="text-xs text-slate-400 font-medium">
                    Exibindo <span class="font-bold text-slate-600" x-text="visibleServices.length"></span> de <span class="font-bold text-slate-600" x-text="filteredServices.length"></span> serviços homologados
                </p>
            </div>

        </div>
    </section>

    <!-- 4. Notícias e Galeria Integrada (Reorganizado conforme referência) -->
    <section class="py-16 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                
                <!-- Coluna 1: Notícias Recentes (Exatamente 2 Notícias + Chamada Instigante) -->
                <div class="lg:col-span-7">
                    <div class="flex items-center justify-between mb-6 pb-3 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-bold text-govmt-blue uppercase tracking-wider block">Transparência & Atos</span>
                            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Notícias e Ações Recentes</h2>
                        </div>
                        <a href="{{ route('portal.posts') }}" class="text-xs font-bold text-govmt-blue hover:underline">
                            Ver Todas &rarr;
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse ($latestPosts->take(2) as $post)
                            <article class="p-5 rounded-2xl bg-white border border-slate-200/90 shadow-sm hover:shadow-md hover:border-govmt-blue/40 transition-all duration-200 flex flex-col sm:flex-row gap-5 group">
                                @if ($post->featured_image)
                                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full sm:w-44 h-28 sm:h-32 object-cover rounded-xl bg-slate-200 flex-shrink-0" />
                                @else
                                    <div class="w-full sm:w-44 h-28 sm:h-32 rounded-xl bg-gradient-to-tr from-govmt-blue via-sus-700 to-govmt-lightBlue flex items-center justify-center text-white flex-shrink-0 shadow-inner">
                                        <x-heroicon-o-newspaper class="w-10 h-10 opacity-70" />
                                    </div>
                                @endif
                                <div class="flex flex-col justify-between py-0.5">
                                    <div>
                                        <div class="flex items-center gap-2 text-[11px] text-slate-500 mb-1.5">
                                            <span class="font-bold text-govmt-blue uppercase tracking-wider">{{ $post->category->name ?? 'Notícias' }}</span>
                                            <span>•</span>
                                            <span>{{ $post->published_at ? $post->published_at->translatedFormat('d \d\e F \d\e Y') : '' }}</span>
                                        </div>
                                        <h3 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-govmt-blue transition-colors line-clamp-2 leading-snug">
                                            <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                                        </h3>
                                        <p class="text-xs text-slate-600 line-clamp-2 mt-1.5 leading-relaxed">
                                            {{ $post->excerpt }}
                                        </p>
                                    </div>
                                    <div class="pt-3">
                                        <a href="{{ route('posts.show', $post->slug) }}" class="text-xs font-bold text-govmt-blue inline-flex items-center gap-1 group-hover:gap-1.5 transition-all">
                                            <span>Ler notícia completa</span>
                                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <p class="text-sm text-slate-500">Nenhuma notícia publicada no momento.</p>
                        @endforelse
                    </div>

                    <!-- Bloco Instigante: Mais Notícias -->
                    <div class="mt-5 p-4 rounded-2xl bg-slate-50 border border-slate-200/90 flex flex-col sm:flex-row items-center justify-between gap-3">
                        <div class="flex items-center gap-3 text-center sm:text-left">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-govmt-blue flex items-center justify-center shrink-0 hidden sm:flex">
                                <x-heroicon-o-sparkles class="w-5 h-5" />
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-bold text-slate-900">Acompanhe todos os avanços em saúde digital</h4>
                                <p class="text-xs text-slate-500">Publicações oficiais, notas técnicas e resultados em Mato Grosso.</p>
                            </div>
                        </div>
                        <a
                            href="{{ route('portal.posts') }}"
                            class="inline-flex items-center gap-1.5 bg-white hover:bg-govmt-blue text-govmt-blue hover:text-white border border-slate-300 hover:border-govmt-blue text-xs font-bold px-4 py-2.5 rounded-xl transition-all shadow-sm shrink-0 whitespace-nowrap"
                        >
                            <span>Ver Arquivo de Notícias</span>
                            <x-heroicon-o-arrow-right class="w-3.5 h-3.5" />
                        </a>
                    </div>
                </div>

                <!-- Coluna 2: Galeria Institucional (Estilo Referência: Card Branco com Grid 2x2 de 4 Blocos Pequenos) -->
                <div class="lg:col-span-5">
                    <div class="flex items-center justify-between mb-6 pb-3 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-bold text-govmt-green uppercase tracking-wider block">Atuação em Campo</span>
                            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Galeria Institucional</h2>
                        </div>
                        <a href="{{ route('portal.gallery') }}" class="text-xs font-bold text-govmt-blue hover:underline">
                            Ver Álbum &rarr;
                        </a>
                    </div>

                    <!-- Container da Galeria estilo Referência -->
                    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/90 shadow-sm">
                        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed mb-5">
                            Registros fotográficos das capacitações, mutirões de telediagnóstico e atendimentos nos municípios.
                        </p>

                        <!-- Grid 2x2 com 4 Blocos Pequenos -->
                        <div class="grid grid-cols-2 gap-3.5">
                            @php
                                $albums = $galleryPreview->take(3);
                            @endphp

                            @foreach ($albums as $album)
                                <a
                                    href="{{ route('portal.gallery') }}"
                                    class="group relative h-28 sm:h-32 rounded-2xl overflow-hidden border border-slate-200/90 bg-slate-100 flex flex-col justify-end p-3 transition-all duration-200 hover:shadow-md hover:border-govmt-blue/50"
                                >
                                    @if ($album->cover_image)
                                        <img
                                            src="{{ Storage::url($album->cover_image) }}"
                                            alt="{{ $album->title }}"
                                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-950/30 to-transparent"></div>
                                    @else
                                        <div class="absolute inset-0 bg-gradient-to-br from-slate-100 via-slate-200 to-slate-100 group-hover:bg-blue-50 transition-colors flex items-center justify-center">
                                            <x-heroicon-o-camera class="w-8 h-8 text-slate-400 group-hover:text-govmt-blue transition-colors opacity-70" />
                                        </div>
                                    @endif

                                    <div class="relative z-10">
                                        <span class="text-[11px] sm:text-xs font-bold {{ $album->cover_image ? 'text-white' : 'text-slate-800' }} line-clamp-2 leading-tight group-hover:text-govmt-blue transition-colors">
                                            {{ $album->title }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach

                            <!-- 4º Bloco: Chamada "Ver Todos (+48)" -->
                            <a
                                href="{{ route('portal.gallery') }}"
                                class="group h-28 sm:h-32 rounded-2xl border-2 border-dashed border-slate-300 hover:border-govmt-blue bg-slate-50 hover:bg-blue-50/70 p-3 flex flex-col items-center justify-center text-center transition-all duration-200 hover:shadow-md"
                            >
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-govmt-blue flex items-center justify-center mb-1.5 group-hover:scale-110 transition-transform">
                                    <x-heroicon-o-photo class="w-4 h-4" />
                                </div>
                                <span class="text-xs sm:text-sm font-black text-slate-800 group-hover:text-govmt-blue transition-colors">
                                    Ver Todos (+48)
                                </span>
                                <span class="text-[10px] text-slate-500 font-semibold mt-0.5">
                                    Fotos & Registros
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Card de Suporte Técnico às Unidades Básicas -->
                    <div class="mt-5 p-5 rounded-2xl bg-gradient-to-br from-govmt-blue to-govmt-darkBlue text-white shadow-md">
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-white/15 flex items-center justify-center text-govmt-gold shrink-0">
                                    <x-heroicon-o-phone class="w-5 h-5" />
                                </div>
                                <div>
                                    <h3 class="text-xs sm:text-sm font-bold">Suporte às Unidades Básicas</h3>
                                    <p class="text-[11px] text-slate-300 leading-tight">Dúvidas sobre laudos e agendamentos?</p>
                                </div>
                            </div>
                            <a
                                href="https://wa.me/556536223660"
                                target="_blank"
                                class="inline-flex items-center gap-1.5 bg-govmt-green hover:bg-govmt-darkGreen text-white text-xs font-bold py-2 px-3.5 rounded-xl transition shrink-0 whitespace-nowrap shadow-sm"
                            >
                                <span>(65) 3622-3660</span>
                                <x-heroicon-o-arrow-top-right-on-square class="w-3.5 h-3.5" />
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
