@extends('layouts.app')

@section('title', 'Contato, Suporte e Transparência - IntegraSUS Digital MT')

@section('content')
    <!-- Banner de Topo -->
    <section class="bg-gradient-to-r from-sus-900 via-govmt-darkBlue to-sus-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 text-xs font-bold text-govmt-gold uppercase tracking-wider">
                    Canais de Atendimento Oficiais
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                    Contato & Suporte Técnico
                </h1>
                <p class="text-slate-200 text-base sm:text-lg">
                    Estamos à disposição dos gestores municipais, equipes de saúde da família e cidadãos para esclarecer dúvidas sobre os serviços de telessaúde em Mato Grosso.
                </p>
            </div>
        </div>
    </section>

    <!-- Formulário e Informações -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Coluna Esquerda: Informações Institucionais e FAQ -->
            <div class="lg:col-span-5 space-y-8">
                <!-- Informações Oficiais do Relatório SES-MT (Slide 20) -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200/80 space-y-6">
                    <h2 class="text-xl font-bold text-slate-900 border-b border-slate-100 pb-3">
                        Núcleo de Telessaúde e Saúde Digital
                    </h2>

                    <div class="space-y-4 text-sm text-slate-700">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-sus-50 text-govmt-blue flex items-center justify-center flex-shrink-0">
                                <x-heroicon-o-building-office-2 class="w-5 h-5" />
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block">Endereço da Sede</span>
                                <span class="text-slate-600 text-xs">R. Júlio Domingos de Campos "Seo Fiote", CEP 78.049-902<br>Centro Político Administrativo (CPA), Cuiabá - MT</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                <x-heroicon-o-phone class="w-5 h-5" />
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block">Suporte Plataforma (WhatsApp)</span>
                                <a href="https://wa.me/556536223660" target="_blank" class="text-emerald-700 font-bold hover:underline text-xs flex items-center gap-1">
                                    (65) 3622-3660
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-sus-600 flex items-center justify-center flex-shrink-0">
                                <x-heroicon-o-envelope class="w-5 h-5" />
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block">E-mail Institucional</span>
                                <a href="mailto:saudedigitalmt@ses.mt.gov.br" class="text-govmt-blue hover:underline text-xs">
                                    saudedigitalmt@ses.mt.gov.br
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center flex-shrink-0">
                                <x-heroicon-o-globe-alt class="w-5 h-5" />
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block">Portal Institucional</span>
                                <a href="https://digital.saude.mt.gov.br/" target="_blank" class="text-slate-600 hover:text-govmt-blue text-xs">
                                    https://digital.saude.mt.gov.br/
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Redes Sociais Oficiais -->
                    <div class="pt-4 border-t border-slate-100">
                        <span class="text-xs font-bold text-slate-800 uppercase tracking-wider block mb-2">Redes Oficiais</span>
                        <div class="flex flex-col gap-2 text-xs">
                            <a href="https://instagram.com/saudedigitalmt" target="_blank" class="text-pink-600 hover:underline flex items-center gap-2">
                                <strong>Instagram:</strong> @saudedigitalmt
                            </a>
                            <a href="https://facebook.com/telessaudemt" target="_blank" class="text-blue-600 hover:underline flex items-center gap-2">
                                <strong>Facebook:</strong> @telessaudemt
                            </a>
                            <a href="https://youtube.com/@TeleEducaMatoGrosso1" target="_blank" class="text-red-600 hover:underline flex items-center gap-2">
                                <strong>YouTube:</strong> @TeleEducaMatoGrosso1
                            </a>
                        </div>
                    </div>
                </div>

                <!-- FAQ Rápido -->
                <div class="bg-slate-100 rounded-3xl p-8 border border-slate-200 space-y-4">
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <x-heroicon-o-question-mark-circle class="w-5 h-5 text-govmt-blue" />
                        Dúvidas Frequentes
                    </h3>
                    <div class="space-y-3 text-xs text-slate-600">
                        <div class="p-3 bg-white rounded-xl">
                            <p class="font-bold text-slate-800 mb-1">Como aderir aos serviços de telediagnóstico?</p>
                            <p>Os 142 municípios mato-grossenses possuem adesão pactuada. Para instalação de novos polos ou habilitação de retinógrafo e ECG, envie uma mensagem ao lado ou no WhatsApp oficial.</p>
                        </div>
                        <div class="p-3 bg-white rounded-xl">
                            <p class="font-bold text-slate-800 mb-1">Qual o tempo de resposta das teleconsultorias?</p>
                            <p>Triagem em até 24h pelo telerregulador e devolutiva especializada completa em 48h a 72h.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna Direita: Formulário de Contato Livewire -->
            <div class="lg:col-span-7">
                <div class="mb-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-govmt-blue bg-sus-50 px-3.5 py-1 rounded-full border border-sus-100">
                        Formulário Eletrônico
                    </span>
                    <h2 class="text-2xl font-extrabold text-slate-900 mt-2">
                        Envie sua Mensagem ou Dúvida Técnica
                    </h2>
                    <p class="text-slate-600 text-sm mt-1">
                        Preencha os dados abaixo para receber retorno direto da equipe do Núcleo de Saúde Digital da SES-MT.
                    </p>
                </div>

                @livewire('contact-form')
            </div>
        </div>
    </div>
@endsection
