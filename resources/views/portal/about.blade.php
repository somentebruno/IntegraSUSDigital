@extends('layouts.app')

@section('title', 'Quem Somos - Núcleo de Telessaúde e Saúde Digital | SES-MT')

@section('content')
    <!-- Banner de Topo -->
    <section class="bg-gradient-to-r from-sus-900 via-govmt-darkBlue to-sus-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 text-xs font-bold text-govmt-gold uppercase tracking-wider">
                    Apresentação Institucional
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight">
                    Quem Somos
                </h1>
                <p class="text-slate-200 text-base sm:text-lg">
                    Conheça a história, a fundamentação legal e o papel estratégico do Programa Saúde Digital MT (IntegraSUS Digital) da Secretaria de Estado de Saúde de Mato Grosso.
                </p>
            </div>
        </div>
    </section>

    <!-- Conteúdo Institucional -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16">
        <!-- 1. Conceito: Saúde Digital e Telessaúde são a mesma coisa? (Slide 3 da Apresentação) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm space-y-4">
                <span class="text-xs font-bold uppercase tracking-wider bg-sus-100 text-govmt-blue px-3 py-1 rounded-full">
                    Escopo Macroestratégico
                </span>
                <h3 class="text-2xl font-extrabold text-slate-900">Saúde Digital (Conceito Amplo)</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Conjunto de saberes, técnicas, práticas, atitudes, modos de pensar e valores relacionados ao uso de tecnologias digitais em saúde e ao crescimento do espaço digital, englobando telessaúde, dados em saúde, sistemas de informação em saúde, prontuário eletrônico e gestão de dados.
                </p>
                <div class="pt-2 flex flex-wrap gap-2 text-xs">
                    <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-lg font-medium">Telessaúde</span>
                    <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-lg font-medium">Dados em Saúde</span>
                    <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-lg font-medium">Sistemas de Informação</span>
                    <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-lg font-medium">Prontuário Eletrônico</span>
                    <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-lg font-medium">Gestão de Dados</span>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm space-y-4">
                <span class="text-xs font-bold uppercase tracking-wider bg-emerald-100 text-govmt-darkGreen px-3 py-1 rounded-full">
                    Ação Assistencial e Educativa
                </span>
                <h3 class="text-2xl font-extrabold text-slate-900">Telessaúde (Componente Operacional)</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Ações práticas de assistência e educação em saúde mediadas pelas Tecnologias de Informação e Comunicação (TDICs), englobando modalidades assistenciais diretas: Teleconsultoria, Teleconsulta, Telediagnóstico, Teleinterconsulta e Tele-educação.
                </p>
                <div class="pt-2 flex flex-wrap gap-2 text-xs">
                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-lg font-medium">Teleconsultoria</span>
                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-lg font-medium">Teleconsulta</span>
                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-lg font-medium">Telediagnóstico</span>
                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-lg font-medium">Teleinterconsulta</span>
                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-lg font-medium">Tele-educação</span>
                </div>
            </div>
        </div>

        <!-- 2. Histórico e Missão -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6 text-slate-700 leading-relaxed">
                <span class="text-xs font-bold uppercase tracking-widest text-govmt-blue bg-sus-50 px-3.5 py-1 rounded-full border border-sus-100">
                    Nossa Missão Institucional
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900">
                    A Revolução da Saúde Pública em Mato Grosso
                </h2>
                <p>
                    O Programa <strong>Saúde Digital MT</strong>, hoje operando sob a diretriz <strong>IntegraSUS Digital MT</strong>, foi instituído pela <em>Resolução CIB/MT nº 830/2023</em> e regulamentado pela <em>Lei Estadual nº 12.389/2024</em> para transformar o modelo assistencial em Mato Grosso.
                </p>
                <p>
                    Com mais de <strong>142 municípios que assinaram termo de adesão</strong> e ampla adesão prática, o programa atua diretamente na qualificação da Atenção Primária, reduzindo filas presenciais de especialistas e evitando transferências e custos de TFD (Tratamento Fora de Domicílio).
                </p>
                <div class="p-6 bg-slate-100 rounded-2xl border-l-4 border-govmt-blue">
                    <p class="italic text-slate-800 text-sm font-medium">
                        "Mais cuidado perto de você. Esse é o SUS que a gente quer: reduzir filas de espera, usar racionalmente os recursos públicos e levar a opinião dos melhores especialistas a qualquer cidade do estado."
                    </p>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="bg-gradient-to-tr from-sus-800 to-govmt-darkBlue text-white rounded-3xl p-8 shadow-xl space-y-6">
                    <h3 class="text-xl font-bold flex items-center gap-2">
                        <x-heroicon-o-chart-bar class="w-6 h-6 text-govmt-gold" />
                        Impactos Positivos Comprovados
                    </h3>
                    <ul class="space-y-4 text-sm text-slate-200">
                        <li class="flex items-start gap-3">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-govmt-green flex-shrink-0 mt-0.5" />
                            <span><strong>Redução de Custos e TFD:</strong> Transferências de pacientes minimizadas, gerando economia logística ao erário público.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-govmt-green flex-shrink-0 mt-0.5" />
                            <span><strong>Acesso Rápido e Seguro:</strong> Pareceres de especialistas em poucas horas, reduzindo o risco de cronicidade e agravamento.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-govmt-green flex-shrink-0 mt-0.5" />
                            <span><strong>Acesso Expandido:</strong> Cuidado especializado garantido para populações remotas, ribeirinhas e indígenas.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-govmt-green flex-shrink-0 mt-0.5" />
                            <span><strong>Educação Permanente:</strong> Discussão interprofissional que qualifica continuamente as equipes da Atenção Básica.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- 3. Base Normativa Completa (Slide 19 do Relatório Oficial) -->
        <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-sm border border-slate-200/80">
            <div class="max-w-3xl mb-8">
                <span class="text-xs font-bold uppercase tracking-widest text-govmt-green bg-emerald-50 px-3.5 py-1 rounded-full border border-emerald-200">
                    Segurança Jurídica & Governança
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900 mt-3">
                    Marco Legal e Referências Oficiais
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2">
                    Legislação federal, resoluções estaduais e portarias do Ministério da Saúde que regulamentam a atuação da Telessaúde em Mato Grosso:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="font-bold text-govmt-blue block mb-1">Lei Federal nº 14.510/2022</span>
                    <p class="text-slate-600">Autoriza e disciplina a prática de Telessaúde em todo o território nacional.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="font-bold text-govmt-green block mb-1">Lei Estadual MT nº 12.389/2024</span>
                    <p class="text-slate-600">Prática da Telessaúde no Território do Estado de Mato Grosso.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="font-bold text-slate-800 block mb-1">Resolução CIB/MT nº 830/2023</span>
                    <p class="text-slate-600">Criação do Programa Saúde Digital MT no âmbito da SES-MT.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="font-bold text-govmt-blue block mb-1">Portaria GM/MS nº 3.233/2024</span>
                    <p class="text-slate-600">Institui o Programa SUS Digital em âmbito nacional.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="font-bold text-slate-800 block mb-1">Portaria SAES/MS nº 2.907/2025</span>
                    <p class="text-slate-600">Define procedimentos de telessaúde e ocupações no CNES.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="font-bold text-slate-800 block mb-1">Portaria GM/MS nº 1.348/2022</span>
                    <p class="text-slate-600">Ações e serviços de Telessaúde no âmbito do SUS.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="font-bold text-slate-800 block mb-1">Resolução CFM nº 2.314/2022</span>
                    <p class="text-slate-600">Regula a prática da telemedicina no Brasil.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="font-bold text-slate-800 block mb-1">Lei nº 13.709/2018 (LGPD)</span>
                    <p class="text-slate-600">Proteção de dados pessoais e sensíveis em saúde digital.</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="font-bold text-govmt-green block mb-1">Portaria SAES/MS nº 2.326/2024</span>
                    <p class="text-slate-600">Normativa para oferta de Tele-retinografia no SUS.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
