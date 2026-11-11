<!DOCTYPE html>
<html lang="pt-BR" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'IntegraSUS Digital Mato Grosso') | SES-MT</title>
    <meta name="description" content="@yield('meta_description', 'Portal oficial do IntegraSUS Digital Mato Grosso (Saúde Digital MT) - Secretaria de Estado de Saúde (SES-MT). Telessaúde, telediagnóstico e tele-educação integrando os 142 municípios de MT.')">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Vite Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full flex flex-col font-sans bg-slate-50 text-slate-800 antialiased selection:bg-sus-500 selection:text-white" x-data="{ mobileMenuOpen: false }">

    <!-- 1. Barra Superior Institucional do Governo de Mato Grosso (Full Width) -->
    <aside class="w-full bg-[#001f3f] text-slate-300 text-xs border-b border-white/10 py-2 px-4 sm:px-6 lg:px-8">
        <div class="w-full flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-3 whitespace-nowrap">
                <span class="inline-block w-2.5 h-2.5 rounded-full bg-govmt-green ring-2 ring-emerald-400/30 shrink-0"></span>
                <span class="font-bold tracking-wide uppercase text-white">
                    Governo do Estado de Mato Grosso
                </span>
                <span class="text-slate-500 hidden sm:inline">•</span>
                <span class="text-slate-300 hidden sm:inline">Secretaria de Estado de Saúde (SES-MT)</span>
            </div>
            <div class="flex items-center gap-4 text-xs text-slate-300 whitespace-nowrap">
                <span class="hidden md:inline text-slate-400">Centro Político Administrativo (CPA) • Cuiabá - MT</span>
                <span class="text-slate-600 hidden md:inline">|</span>
                <a href="{{ url('/admin') }}" class="hover:text-white flex items-center gap-1.5 font-semibold text-slate-200 transition">
                    <x-heroicon-o-lock-closed class="w-3.5 h-3.5 text-govmt-gold shrink-0" />
                    Área Administrativa (CMS)
                </a>
            </div>
        </div>
    </aside>

    <!-- 2. Navbar Principal Full Width (Sem caixas centralizadas, 100% de largura, sem quebra de linhas) -->
    <header class="sticky top-0 z-40 w-full bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-200">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20 gap-4">
                <!-- Marca Institucional Oficial (Logo enviada) -->
                <a href="{{ route('portal.index') }}" class="flex items-center gap-3 group shrink-0 py-1.5" title="IntegraSUS Digital Mato Grosso - Página Inicial">
                    <img
                        src="{{ asset('images/logo-integrasus-digital.png') }}"
                        alt="IntegraSUS Digital Mato Grosso"
                        class="h-10 sm:h-12 w-auto object-contain transition-transform group-hover:scale-[1.02]"
                    />
                </a>

                <!-- Navegação Desktop (Linha única, espaçamento equilibrado, sem quebras) -->
                <nav class="hidden lg:flex items-center gap-4 xl:gap-7 flex-nowrap shrink-0">
                    <a href="{{ route('portal.index') }}" class="text-sm font-semibold transition py-1 relative whitespace-nowrap shrink-0 {{ request()->routeIs('portal.index') ? 'text-govmt-blue font-bold after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-govmt-blue' : 'text-slate-700 hover:text-govmt-blue' }}">
                        Início
                    </a>
                    <a href="{{ route('portal.about') }}" class="text-sm font-semibold transition py-1 relative whitespace-nowrap shrink-0 {{ request()->routeIs('portal.about') ? 'text-govmt-blue font-bold after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-govmt-blue' : 'text-slate-700 hover:text-govmt-blue' }}">
                        Quem Somos
                    </a>
                    <a href="{{ route('portal.services') }}" class="text-sm font-semibold transition py-1 relative whitespace-nowrap shrink-0 {{ request()->routeIs('portal.services*') || request()->routeIs('services.show') ? 'text-govmt-blue font-bold after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-govmt-blue' : 'text-slate-700 hover:text-govmt-blue' }}">
                        Serviços Ofertados
                    </a>
                    <a href="{{ route('portal.posts') }}" class="text-sm font-semibold transition py-1 relative whitespace-nowrap shrink-0 {{ request()->routeIs('portal.posts*') || request()->routeIs('posts.show') ? 'text-govmt-blue font-bold after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-govmt-blue' : 'text-slate-700 hover:text-govmt-blue' }}">
                        Notícias & Resultados
                    </a>
                    <a href="{{ route('portal.gallery') }}" class="text-sm font-semibold transition py-1 relative whitespace-nowrap shrink-0 {{ request()->routeIs('portal.gallery') ? 'text-govmt-blue font-bold after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-govmt-blue' : 'text-slate-700 hover:text-govmt-blue' }}">
                        Galeria de Ações
                    </a>
                    <a href="{{ route('portal.map') }}" class="text-sm font-semibold transition py-1 relative whitespace-nowrap shrink-0 {{ request()->routeIs('portal.map') ? 'text-govmt-blue font-bold after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-govmt-blue' : 'text-slate-700 hover:text-govmt-blue' }}">
                        Mapa MT
                    </a>
                    <a href="{{ route('portal.contact') }}" class="text-sm font-semibold transition py-1 relative whitespace-nowrap shrink-0 {{ request()->routeIs('portal.contact') ? 'text-govmt-blue font-bold after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-govmt-blue' : 'text-slate-700 hover:text-govmt-blue' }}">
                        Contato & Suporte
                    </a>
                </nav>

                <!-- Botão Dinâmico com Status Operacional em Tempo Real -->
                @php
                    $isOnline = $platformStatus['is_online'] ?? false;
                @endphp
                <div class="hidden sm:flex items-center gap-3 shrink-0 whitespace-nowrap">
                    <a
                        href="{{ $platformStatus['url'] }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="{{ $isOnline ? 'btn-memoravel' : 'btn-memoravel-offline' }} px-5 py-2.5 text-xs sm:text-sm whitespace-nowrap shrink-0 flex-nowrap"
                        title="{{ $platformStatus['tooltip'] }}"
                    >
                        <span class="{{ $isOnline ? 'pulse-dot-green' : 'pulse-dot-red' }} shrink-0"></span>
                        <span class="whitespace-nowrap font-bold">{{ $platformStatus['label'] }}</span>
                        <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4 ml-0.5 shrink-0" />
                    </a>
                </div>

                <!-- Botão Menu Mobile -->
                <button
                    type="button"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden p-2 rounded-xl text-slate-700 hover:bg-slate-100 transition shrink-0"
                    aria-label="Abrir menu"
                >
                    <x-heroicon-o-bars-3 class="w-7 h-7" x-show="!mobileMenuOpen" />
                    <x-heroicon-o-x-mark class="w-7 h-7" x-show="mobileMenuOpen" x-cloak />
                </button>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div
            x-show="mobileMenuOpen"
            x-cloak
            class="lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-2 shadow-xl"
        >
            <a href="{{ route('portal.index') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-slate-800 hover:bg-sus-50 hover:text-sus-700">
                Início
            </a>
            <a href="{{ route('portal.about') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-slate-800 hover:bg-sus-50 hover:text-sus-700">
                Quem Somos
            </a>
            <a href="{{ route('portal.services') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-slate-800 hover:bg-sus-50 hover:text-sus-700">
                Serviços Ofertados
            </a>
            <a href="{{ route('portal.posts') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-slate-800 hover:bg-sus-50 hover:text-sus-700">
                Notícias & Resultados
            </a>
            <a href="{{ route('portal.gallery') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-slate-800 hover:bg-sus-50 hover:text-sus-700">
                Galeria de Fotos
            </a>
            <a href="{{ route('portal.map') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-slate-800 hover:bg-sus-50 hover:text-sus-700">
                Mapa dos Municípios
            </a>
            <a href="{{ route('portal.contact') }}" class="block px-3 py-2.5 rounded-xl text-base font-semibold text-slate-800 hover:bg-sus-50 hover:text-sus-700">
                Contato & Suporte
            </a>
            <div class="pt-4 mt-2 border-t border-slate-100">
                <a
                    href="{{ $platformStatus['url'] }}"
                    target="_blank"
                    class="{{ $isOnline ? 'btn-memoravel' : 'btn-memoravel-offline' }} w-full justify-center py-3.5 text-sm"
                    title="{{ $platformStatus['tooltip'] }}"
                >
                    <span class="{{ $isOnline ? 'pulse-dot-green' : 'pulse-dot-red' }}"></span>
                    <span>{{ $platformStatus['label'] }}</span>
                    <x-heroicon-o-arrow-top-right-on-square class="w-4 h-4 ml-1" />
                </a>
            </div>
        </div>
    </header>

    <!-- 3. Conteúdo Principal da Página -->
    <main id="conteudo-principal" class="flex-grow">
        @yield('content')
    </main>

    <!-- 4. Rodapé Institucional do Estado de Mato Grosso / SES-MT -->
    <footer class="bg-slate-900 text-slate-300 border-t border-slate-800 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-12 border-b border-slate-800">
                <!-- Coluna 1: Apresentação & Redes Oficiais -->
                <div class="space-y-4">
                    <a href="{{ route('portal.index') }}" class="inline-block bg-white p-2.5 rounded-2xl shadow-md">
                        <img
                            src="{{ asset('images/logo-integrasus-digital.png') }}"
                            alt="IntegraSUS Digital Mato Grosso"
                            class="h-8 w-auto object-contain"
                        />
                    </a>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Transformação digital do SUS promovendo o acesso qualificado, integral e oportuno à saúde pública em todos os municípios de Mato Grosso.
                    </p>
                    <!-- Redes Sociais Oficiais do Slide 20 -->
                    <div class="pt-2 flex flex-wrap items-center gap-2 text-xs">
                        <span class="text-slate-400 font-semibold block w-full mb-1">Canais Oficiais:</span>
                        <a href="https://instagram.com/saudedigitalmt" target="_blank" class="px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-pink-400 transition font-medium">@saudedigitalmt</a>
                        <a href="https://facebook.com/telessaudemt" target="_blank" class="px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-blue-400 transition font-medium">@telessaudemt</a>
                        <a href="https://youtube.com/@TeleEducaMatoGrosso1" target="_blank" class="px-2.5 py-1 rounded-lg bg-slate-800 hover:bg-slate-700 text-red-400 transition font-medium">@TeleEducaMatoGrosso1</a>
                    </div>
                </div>

                <!-- Coluna 2: Navegação Rápida -->
                <div>
                    <h3 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Navegação</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('portal.index') }}" class="hover:text-white transition">Página Inicial</a></li>
                        <li><a href="{{ route('portal.about') }}" class="hover:text-white transition">Quem Somos</a></li>
                        <li><a href="{{ route('portal.services') }}" class="hover:text-white transition">Serviços Ofertados</a></li>
                        <li><a href="{{ route('portal.posts') }}" class="hover:text-white transition">Notícias e Publicações</a></li>
                        <li><a href="{{ route('portal.gallery') }}" class="hover:text-white transition">Galeria das Ações nos Municípios</a></li>
                        <li><a href="{{ route('portal.contact') }}" class="hover:text-white transition">Fale Conosco / Suporte</a></li>
                    </ul>
                </div>

                <!-- Coluna 3: Serviços Principais -->
                <div>
                    <h3 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Eixos & Serviços</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('services.show', 'teleconsultoria') }}" class="hover:text-white transition">Teleconsultoria (50+ esp.)</a></li>
                        <li><a href="{{ route('services.show', 'teleinterconsulta') }}" class="hover:text-white transition">Teleinterconsulta em Vídeo</a></li>
                        <li><a href="{{ route('services.show', 'tele-raio-x') }}" class="hover:text-white transition">Tele-Raio-X (117 municípios)</a></li>
                        <li><a href="{{ route('services.show', 'tele-retinografia') }}" class="hover:text-white transition">Tele-retinografia (70 retinógrafos)</a></li>
                        <li><a href="{{ route('services.show', 'tele-estomatologia') }}" class="hover:text-white transition">Tele-estomatologia (App dedicado)</a></li>
                        <li><a href="{{ route('services.show', 'tele-ecg-cardio') }}" class="hover:text-white transition">Tele-ECG & Cardiologia</a></li>
                        <li><a href="{{ route('services.show', 'tele-educacao') }}" class="hover:text-white transition">Tele-Educação (Tele-Educa MT)</a></li>
                    </ul>
                </div>

                <!-- Coluna 4: Endereço & Contato Oficial do Slide 20 -->
                <div class="space-y-3">
                    <h3 class="text-white font-bold text-sm tracking-wider uppercase mb-4">Sede & Atendimento</h3>
                    <div class="flex items-start gap-3 text-sm text-slate-400">
                        <x-heroicon-o-map-pin class="w-5 h-5 text-sus-400 flex-shrink-0 mt-0.5" />
                        <span>R. Júlio Domingos de Campos "Seo Fiote", CEP 78.049-902 - Centro Político Administrativo (CPA), Cuiabá - MT</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-400">
                        <x-heroicon-o-envelope class="w-5 h-5 text-sus-400 flex-shrink-0" />
                        <a href="mailto:saudedigitalmt@ses.mt.gov.br" class="hover:text-white transition">saudedigitalmt@ses.mt.gov.br</a>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-slate-400">
                        <x-heroicon-o-phone class="w-5 h-5 text-emerald-400 flex-shrink-0" />
                        <a href="https://wa.me/556536223660" target="_blank" class="text-white font-semibold hover:underline">
                            Suporte Plataforma: (65) 3622-3660 (WhatsApp)
                        </a>
                    </div>
                    <div class="pt-3">
                        <a
                            href="{{ route('portal.contact') }}"
                            class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl border border-slate-700 transition"
                        >
                            <x-heroicon-o-chat-bubble-bottom-center-text class="w-4 h-4 text-govmt-green" />
                            Canal de Dúvidas e Suporte
                        </a>
                    </div>
                </div>
            </div>

            <!-- Faixa Inferior de Direitos e LGPD -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>
                    © {{ date('Y') }} Governo do Estado de Mato Grosso — Secretaria de Estado de Saúde (SES-MT). Todos os direitos reservados.
                </p>
                <div class="flex items-center gap-6">
                    <span class="hover:text-slate-400 transition cursor-pointer">Termos de Uso</span>
                    <span>•</span>
                    <span class="hover:text-slate-400 transition cursor-pointer">Política de Privacidade (LGPD)</span>
                    <span>•</span>
                    <a href="{{ url('/admin') }}" class="hover:text-slate-400 transition">Painel CMS</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
