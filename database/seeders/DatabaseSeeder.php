<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\GalleryAlbum;
use App\Models\GalleryPhoto;
use App\Models\Indicator;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Administrador SES-MT
        User::firstOrCreate(
            ['email' => 'admin@saude.mt.gov.br'],
            [
                'name' => 'Administrador IntegraSUS Digital MT',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Indicadores Reais do Programa Saúde Digital MT (extraídos do relatório oficial)
        $indicators = [
            [
                'title' => 'Municípios com Adesão',
                'value' => '142',
                'suffix' => 'municípios integrados',
                'description' => '142 municípios assinaram o Termo de Adesão e foram capacitados para Telessaúde',
                'icon' => 'heroicon-o-map-pin',
                'order' => 1,
            ],
            [
                'title' => 'Teleconsultorias Registradas',
                'value' => '10.204',
                'suffix' => 'solicitações clínicas',
                'description' => '9.486 concluídas com 93% de resolutividade sem necessidade de deslocamento',
                'icon' => 'heroicon-o-chat-bubble-left-right',
                'order' => 2,
            ],
            [
                'title' => 'Municípios com Tele-Raio-X',
                'value' => '117',
                'suffix' => 'municípios atendidos',
                'description' => 'Laudos radiológicos a distância, incluindo atendimento a mais de 4.276 PPL no sistema prisional',
                'icon' => 'heroicon-o-document-chart-bar',
                'order' => 3,
            ],
            [
                'title' => 'Visualizações Tele-Educa',
                'value' => '+1.574.000',
                'suffix' => 'visualizações no canal',
                'description' => '18.000 profissionais inscritos e 579 webconferências no @TeleEducaMatoGrosso1',
                'icon' => 'heroicon-o-academic-cap',
                'order' => 4,
            ],
        ];

        foreach ($indicators as $ind) {
            Indicator::updateOrCreate(['title' => $ind['title']], $ind);
        }

        // 3. Banners Principais
        $banners = [
            [
                'title' => 'Saúde Digital MT: A Revolução da Saúde Pública em Mato Grosso',
                'subtitle' => 'O IntegraSUS Digital MT conecta as Unidades Básicas de Saúde (UBS) aos centros de referência e hospitais de alta complexidade, promovendo cuidado qualificado perto do cidadão.',
                'tag' => 'TRANSFORMAÇÃO DIGITAL DO SUS-MT',
                'button_text' => 'Acesso ao Sistema de Telessaúde',
                'button_url' => 'https://servicos.saude.mt.gov.br/telessaude/',
                'secondary_button_text' => 'Conheça Todos os Serviços',
                'secondary_button_url' => '#servicos',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Rede Integrada de Telediagnósticos Estaduais e Nacionais',
                'subtitle' => 'Tele-Raio-X, Tele-retinografia, Tele-estomatologia, Tele-ECG, Teledermatologia e Tele-espirometria com laudos ágeis de especialistas em tempo oportuno.',
                'tag' => 'TELEDIAGNÓSTICOS DE PONTA',
                'button_text' => 'Catálogo de Serviços',
                'button_url' => '/servicos',
                'secondary_button_text' => 'Suporte Plataforma (65) 3622-3660',
                'secondary_button_url' => '/contato',
                'order' => 2,
                'is_active' => true,
            ]
        ];

        foreach ($banners as $b) {
            Banner::updateOrCreate(['title' => $b['title']], $b);
        }

        // 4. Catálogo Completo e Oficial de Serviços de Saúde Digital MT
        $services = [
            // EIXO 1: Ambulatório de Telessaúde
            [
                'title' => 'Teleconsultoria',
                'slug' => 'teleconsultoria',
                'category_type' => 'Ambulatório de Telessaúde',
                'partner' => 'SDMT / SES-MT (Rede Estadual & Parceiros)',
                'technical_responsible' => 'Coordenação Médica de Telerregulação SES-MT',
                'response_time' => 'Triagem em 24h | Parecer em 48h a 72h',
                'icon' => 'heroicon-o-chat-bubble-left-right',
                'short_description' => 'Consultoria remota entre profissionais de saúde (modalidade biprofissional) para esclarecer dúvidas sobre procedimentos clínicos, diagnóstico e conduta, reduzindo encaminhamentos desnecessários.',
                'target_audience' => 'Médicos e profissionais da Atenção Primária em Saúde (APS) dos 141 municípios de Mato Grosso.',
                'content' => '<h3>Como Nasce a Teleconsultoria?</h3><p>Surge da necessidade do profissional de saúde da UBS que, diante de uma dúvida clínica, assistencial ou de gestão, busca o apoio de outro profissional mais experiente ou especializado para qualificar a tomada de decisão.</p><h3>Rede de Teleconsultores Especialistas</h3><p>O estado conta com ampla rede de teleconsultores estaduais e parceiros:</p><ul><li><strong>CERMAC (09 especialidades):</strong> Dermatologia, Endocrinologia Adulto e Pediátrica, Hanseníase (Hansenologia), Ortopedia e Traumatologia, Infectologia Pediátrica, Reumatologia Pediátrica, Pneumologia Adulto, Urologia Adulto.</li><li><strong>HEMOCENTRO (06 especialidades):</strong> Hematologia Adulto e Pediátrica, Ortopedia/Trauma, Clínica da Dor, Pediatria Geral, Cardiologia Adulto.</li><li><strong>CRIDAC (04 especialidades):</strong> Fisiatria, Neuropediatria, Urologia, Ortopedia e Traumatologia.</li><li><strong>FARMÁCIA DE ALTO CUSTO:</strong> Pneumologia Adulto e Assistência Farmacêutica Especializada.</li><li><strong>HOSPITAL DO CÂNCER (11 especialidades):</strong> Dermatologia, Cardiologia Adulto, Geriatria, Oncologia Clínica e Pediátrica, Cirurgia de Cabeça e Pescoço, Mastologia, Cuidados Paliativos, Urologia Adulto, Radioterapia, Clínica da Dor em Oncologia.</li><li><strong>HOSPITAL GERAL (04 especialidades):</strong> Reumatologia Adulto, Neurologia Adulto e Pediátrica, Oncologia Clínica.</li><li><strong>CEMs CUIABÁ (19 especialidades):</strong> Oftalmologia, Ginecologia, Gastroenterologia, Psiquiatria, Otorrinolaringologia, Nefrologia, Proctologia e mais.</li><li><strong>SAE LIXEIRA:</strong> Infectologia Especializada.</li></ul>',
                'flow_description' => "1. Atendimento na UBS: Médico atende o paciente com dúvida clínica ou lesão.\n2. Solicitação da Teleconsultoria: Médico da UBS anexa história clínica, exames e imagens na plataforma oficial.\n3. Telerregulação (até 24h): O telerregulador avalia a pertinência e encaminha ao teleconsultor especialista adequado.\n4. Análise do Especialista (48h a 72h): O especialista analisa os dados e emite orientações (diagnóstico provável, exames, conduta inicial).\n5. Desfecho: Acompanhamento resolutivo na UBS, agendamento de Teleinterconsulta ou, quando indispensável, encaminhamento via Regula MT.",
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Teleinterconsulta',
                'slug' => 'teleinterconsulta',
                'category_type' => 'Ambulatório de Telessaúde',
                'partner' => 'SDMT / SES-MT',
                'technical_responsible' => 'Médicos Especialistas da Rede Estadual',
                'response_time' => 'Agendada em Tempo Real',
                'icon' => 'heroicon-o-video-camera',
                'short_description' => 'Triangulação assistencial por vídeo com a presença simultânea do paciente, do profissional da UBS e do médico especialista, facilitando a tomada de decisão compartilhada.',
                'target_audience' => 'Pacientes do SUS em acompanhamento na UBS e equipes multiprofissionais de saúde da família.',
                'content' => '<p>A <strong>Teleinterconsulta</strong> cria uma triangulação assistencial inovadora: <em>médico especialista + profissional de saúde da UBS + paciente</em>, mediada por tecnologias de vídeo e prontuário integrado.</p><p>Permite a discussão do caso em tempo real, tirando dúvidas com o especialista enquanto o paciente permanece no conforto e proximidade do seu próprio município, eliminando viagens desgastantes para Cuiabá.</p>',
                'flow_description' => "1. Indicação após análise de teleconsultoria ou triagem regulatória.\n2. Agendamento da sala virtual na UBS de origem.\n3. Conexão por videoconferência com médico especialista, profissional local e paciente.\n4. Prescrição, orientações terapêuticas e plano de cuidado pactuado.",
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Teleconsulta no Cárcere',
                'slug' => 'teleconsulta-carcere',
                'category_type' => 'Ambulatório de Telessaúde',
                'partner' => 'SDMT / SES-MT & Sistema Prisional e Custódia MT',
                'technical_responsible' => 'Equipes de Saúde Penitenciária e Médicos Especialistas',
                'response_time' => 'Conforme agenda regulada',
                'icon' => 'heroicon-o-user-group',
                'short_description' => 'Consultas médicas remotas e suporte especializado com atendimento seguro e humanizado a populações prioritárias e pessoas privadas de liberdade (PPL).',
                'target_audience' => 'Pessoas Privadas de Liberdade (PPL), equipes de saúde do sistema prisional e usuários do SUS.',
                'content' => '<p>A <strong>Teleconsulta no Cárcere</strong> é um dos projetos mais resolutivos de Mato Grosso, garantindo atendimento médico especializado dentro dos estabelecimentos prisionais sem necessidade de escoltas policiais complexas ou deslocamentos arriscados.</p><p>O programa já contabiliza mais de <strong>4.555 laudos emitidos e 4.276 Pessoas Privadas de Liberdade (PPL) atendidas</strong>, unindo eficiência na segurança pública e cumprimento dos direitos humanos à saúde.</p>',
                'flow_description' => "1. Triagem e solicitação clínica pela equipe de saúde da unidade prisional.\n2. Agendamento e conexão em sala de telemedicina do estabelecimento.\n3. Consulta com especialista e emissão de receita eletrônica certificada.\n4. Registro no prontuário e acompanhamento farmacológico no local.",
                'order' => 3,
                'is_active' => true,
            ],

            // EIXO 2: Telediagnósticos - Oferta Estadual (SDMT/SES-MT)
            [
                'title' => 'Tele-Raio-X',
                'slug' => 'tele-raio-x',
                'category_type' => 'Telediagnóstico - Oferta Estadual',
                'partner' => 'SDMT / SES-MT (+ UMEX)',
                'technical_responsible' => 'Dra. Sandra Regina Guiraldeli (Médica Radiologista)',
                'response_time' => 'Laudos em até 24h a 48h (Urgências em tempo oportuno)',
                'icon' => 'heroicon-o-document-chart-bar',
                'short_description' => 'Emissão de laudos de raio-X à distância para 117 municípios de Mato Grosso conectados ao sistema, agilizando diagnósticos de imagem.',
                'target_audience' => 'Médicos e técnicos em radiologia de hospitais municipais, UPA e unidades de saúde equipadas com aparelho de Raio-X.',
                'content' => '<p>O serviço de <strong>Tele-Raio-X</strong> da SES-MT permite analisar exames radiológicos a distância com emissão de laudos emitidos por médicos radiologistas especialistas da própria secretaria.</p><p>Está disponibilizado para todos os municípios onde os aparelhos de Raio-X comportem a conexão digital com o sistema, atingindo a marca recorde de mais de <strong>2.047 laudos em um único mês</strong> e capilaridade em <strong>117 municípios mato-grossenses</strong>.</p>',
                'flow_description' => "1. Realização do exame radiográfico no aparelho do município.\n2. Envio das imagens digitais DICOM pela plataforma da Saúde Digital MT.\n3. Análise e elaboração do laudo radiológico especializado.\n4. Laudo assinado digitalmente disponível para o médico assistente em minutos ou poucas horas.",
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Teleretinografia',
                'slug' => 'tele-retinografia',
                'category_type' => 'Telediagnóstico - Oferta Nacional',
                'partner' => 'SDMT / SES-MT & Universidade Federal de Goiás (UFG)',
                'technical_responsible' => 'Médicos Oftalmologistas da UFG Especialistas em Retina',
                'response_time' => 'Laudos em até 72h',
                'icon' => 'heroicon-o-eye',
                'short_description' => 'Rastreamento remoto e laudos de fundo de olho em oferta nacional pela UFG com retinógrafos portáteis para prevenção da cegueira e retinopatia diabética nos municípios.',
                'target_audience' => 'Pacientes diabéticos, hipertensos e usuários da Atenção Primária dos municípios polos.',
                'content' => '<p>Técnica de captura precisa e detalhada de imagens da retina realizada em parceria de <strong>Oferta Nacional com a Universidade Federal de Goiás (UFG)</strong>, permitindo que médicos oftalmologistas especialistas analisem de forma remota a condição da retina de pacientes do SUS em Mato Grosso.</p><h3>Patologias Identificadas:</h3><ul><li>Retinopatia Diabética</li><li>Glaucoma</li><li>Degeneração Macular Relacionada à Idade (DMRI)</li><li>Retinopatia Hipertensiva</li><li>Oclusões Vasculares Oculares</li><li>Descolamento de Retina</li></ul><h3>Estrutura e Parceria:</h3><p>O Governo de Mato Grosso viabilizou <strong>retinógrafos portáteis de última geração</strong> distribuídos por termo de comodato nas unidades de saúde municipais, com suporte de laudos oftalmológicos emitidos diretamente pelos especialistas da UFG.</p>',
                'flow_description' => "1. Paciente faz a foto de fundo de olho na UBS com retinógrafo portátil (não midriático).\n2. Imagens enviadas pela plataforma de Telessaúde para a UFG.\n3. Médico oftalmologista especialista da UFG emite laudo detalhado em até 72h.\n4. Pacientes com alterações recebem conduta clínica imediata ou encaminhamento prioritário.",
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Tele-estomatologia',
                'slug' => 'tele-estomatologia',
                'category_type' => 'Telediagnóstico - Oferta Estadual',
                'partner' => 'SDMT / SES-MT em parceria com a Universidade Federal da Paraíba (UFPB)',
                'technical_responsible' => 'Dra. Diurianne Caroline Campos França',
                'response_time' => 'Devolutiva em até 72h',
                'icon' => 'heroicon-o-sparkles',
                'short_description' => 'Diagnóstico remoto e discussão de lesões orais para cirurgiões-dentistas via aplicativo dedicado Tele Estomato MT, com alerta e vigilância oncológica.',
                'target_audience' => 'Cirurgiões-dentistas de toda a rede de saúde bucal dos municípios de Mato Grosso.',
                'content' => '<p>O serviço de <strong>Tele-estomatologia</strong> apoia os cirurgiões-dentistas no diagnóstico diferencial de lesões bucais, orientação de conduta e hipótese diagnóstica através do aplicativo móvel dedicado <strong>Tele Estomato MT</strong>.</p><h3>Alerta e Vigilância Oncológica:</h3><p>Identificação precoce de casos suspeitos de malignidade (câncer de boca), garantindo encaminhamento prioritário para biópsia e início do tratamento em tempo oportuno na rede de oncologia estadual.</p><h3>Resultados Alcançados:</h3><ul><li><strong>1.164 casos respondidos</strong> com suporte especializado;</li><li><strong>85 municípios</strong> mato-grossenses com ampla cobertura territorial;</li><li><strong>649 profissionais</strong> cadastrados no aplicativo;</li><li>Devolutiva ágil em <strong>até 72 horas</strong>.</li></ul>',
                'flow_description' => "1. Cirurgião-dentista identifica lesão bucal na UBS ou CEO.\n2. Registro fotográfico e dados clínicos cadastrados no app Tele Estomato MT.\n3. Análise pelo estomatologista responsável da SES-MT.\n4. Devolutiva com conduta terapêutica ou agendamento de biópsia prioritária.",
                'order' => 6,
                'is_active' => true,
            ],

            // EIXO 3: Telediagnósticos - Oferta Nacional (Parcerias Federativas)
            [
                'title' => 'Tele-ECG / Cardiologia',
                'slug' => 'tele-ecg-cardio',
                'category_type' => 'Telediagnóstico - Oferta Nacional',
                'partner' => 'Universidade Federal de Minas Gerais (UFMG)',
                'technical_responsible' => 'Cardiologistas da Rede Nacional de Telediagnóstico',
                'response_time' => 'Emergências em até 10 min | Eletivos em poucas horas',
                'icon' => 'heroicon-o-heart',
                'short_description' => 'Emissão de laudos ágeis de Eletrocardiograma (ECG) digital com apoio da UFMG, suporte à habilitação de equipamentos e suporte clínico aos municípios.',
                'target_audience' => 'Médicos e equipes de enfermagem de UBS, Pronto Atendimentos e Hospitais Municipais.',
                'content' => '<p>O <strong>Tele-ECG</strong> oferece suporte rápido e seguro para diagnóstico de infarto agudo do miocárdio, arritmias cardíacas e avaliação pré-operatória ou de rotina.</p><p>A Saúde Digital MT atua junto aos municípios apoiando a habilitação dos aparelhos de ECG, viabilização dos fluxos e suporte técnico contínuo em parceria com a UFMG.</p>',
                'flow_description' => "1. Realização do traçado de ECG na unidade de saúde.\n2. Transmissão imediata via software de telediagnóstico.\n3. Laudo emitido por cardiologista de plantão.\n4. Orientações de conduta imediata para casos de urgência cardiovascular.",
                'order' => 7,
                'is_active' => true,
            ],
            [
                'title' => 'Tele-Espirometria',
                'slug' => 'tele-espirometria',
                'category_type' => 'Telediagnóstico - Oferta Nacional',
                'partner' => 'Universidade Federal de Minas Gerais (UFMG)',
                'technical_responsible' => 'Médicos Pneumologistas do Centro de Telessaúde da UFMG',
                'response_time' => 'Laudos em até 72h úteis',
                'icon' => 'heroicon-o-beaker',
                'short_description' => 'Pneumologia clínica especializada e laudos de prova de função pulmonar em oferta nacional pela UFMG para diagnóstico e manejo de asma e DPOC nos municípios de MT.',
                'target_audience' => 'Médicos da Atenção Básica e pacientes com queixas respiratórias crônicas.',
                'content' => '<p>A <strong>Tele-espirometria em Oferta Nacional pela UFMG</strong> amplia o diagnóstico de doenças respiratórias obstrutivas crônicas (como DPOC e Asma brônquica) na Atenção Primária, permitindo laudos de alta precisão sem que o paciente precise se deslocar até a capital.</p>',
                'flow_description' => "1. Realização do exame de espirometria com técnico treinado.\n2. Envio da curva respiratória e dados antropométricos para a equipe da UFMG.\n3. Emissão do laudo por pneumologista da UFMG com parecer interpretativo.\n4. Ajuste da terapêutica inalatória no município de origem.",
                'order' => 8,
                'is_active' => true,
            ],
            [
                'title' => 'Teledermatologia',
                'slug' => 'teledermatologia',
                'category_type' => 'Telediagnóstico - Oferta Nacional',
                'partner' => 'Universidade Federal de Santa Catarina (UFSC)',
                'technical_responsible' => 'Médicos Dermatologistas Especialistas em Teledermatologia',
                'response_time' => 'Laudos em até 72h',
                'icon' => 'heroicon-o-shield-check',
                'short_description' => 'Teledermatoscopia e laudos remotos de lesões cutâneas suspeitas de câncer de pele (melanoma) e dermatoses crônicas em oferta nacional.',
                'target_audience' => 'Médicos da APS e pacientes com lesões de pele suspeitas de malignidade.',
                'content' => '<p>A <strong>Teledermatologia em Oferta Nacional</strong> possibilita a estratificação de risco de lesões de pele através de imagens macroscópicas e dermatoscópicas padronizadas, reduzindo as filas e priorizando casos oncológicos graves com rapidez.</p>',
                'flow_description' => "1. Consulta na Atenção Primária com registro fotográfico com dermatoscópio.\n2. Preenchimento de protocolo clínico direcionado.\n3. Parecer emitido pelo dermatologista com classificação de risco.\n4. Tratamento na UBS ou cirurgia dermatológica prioritária.",
                'order' => 9,
                'is_active' => true,
            ],

            // EIXO 4: Tele-Educação
            [
                'title' => 'Tele-Educação',
                'slug' => 'tele-educacao',
                'category_type' => 'Tele-Educação',
                'partner' => 'SDMT / SES-MT (Tele-Educa MT)',
                'technical_responsible' => 'Coordenação de Tele-educação e Educação Permanente SES-MT',
                'response_time' => 'Transmissões semanais e conteúdo on-demand 24/7',
                'icon' => 'heroicon-o-academic-cap',
                'short_description' => 'Polo central de conhecimento, webpalestras, capacitação contínua e apoio direto aos municípios com mais de 1,5 milhão de visualizações.',
                'target_audience' => 'Trabalhadores da saúde, gestores municipais, médicos, enfermeiros, cirurgiões-dentistas e residentes.',
                'content' => '<p>O <strong>Tele-Educação (Tele-Educa MT)</strong> é o polo difusor de conhecimento científico e técnico para os profissionais do SUS em Mato Grosso. Transmite webpalestras semanais com temas prioritários, cursos autoinstrucionais e treinamentos operacionais das plataformas de saúde digital.</p><h3>Alcance e Impacto Comprovado:</h3><ul><li><strong>18.000 profissionais</strong> inscritos no canal oficial <em>@TeleEducaMatoGrosso1</em>;</li><li><strong>579 vídeos e webpalestras</strong> publicados no acervo;</li><li><strong>Mais de 1.574.040 visualizações</strong> acumuladas de profissionais de todo o estado;</li><li>Ambiente virtual com certificação institucional do Programa Saúde Digital MT.</li></ul>',
                'flow_description' => "1. Divulgação da programação mensal de webconferências.\n2. Acesso ao vivo via canal @TeleEducaMatoGrosso1 com chat de dúvidas.\n3. Registro de frequência para certificação digital.\n4. Gravação disponibilizada permanentemente no acervo da plataforma.",
                'order' => 10,
                'is_active' => true,
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(['slug' => $srv['slug']], $srv);
        }

        // 5. Categorias de Notícias
        $catNoticias = Category::firstOrCreate(
            ['slug' => 'noticias'],
            ['name' => 'Notícias & Ações', 'description' => 'Notícias sobre os avanços e expansão do IntegraSUS Digital em MT']
        );
        $catCapacitacao = Category::firstOrCreate(
            ['slug' => 'capacitacoes'],
            ['name' => 'Capacitações', 'description' => 'Informações e agendas de treinamentos para profissionais de saúde']
        );
        $catArtigos = Category::firstOrCreate(
            ['slug' => 'artigos-tecnicos'],
            ['name' => 'Artigos Técnicos & Normativas', 'description' => 'Notas técnicas, protocolos clínicos e legislação do SUS']
        );

        // 6. Postagens Iniciais com Dados da Apresentação
        $posts = [
            [
                'category_id' => $catNoticias->id,
                'title' => 'Saúde Digital MT supera marca de 10 mil teleconsultorias e consolida 93% de resolutividade',
                'slug' => 'saude-digital-mt-supera-marca-10-mil-teleconsultorias',
                'excerpt' => 'Com 142 municípios aderidos ao programa, a rede estadual de teleconsultores evita transferências desnecessárias e qualifica o cuidado na Atenção Primária.',
                'content' => '<p>O programa <strong>Saúde Digital MT</strong> alcançou resultados históricos na modernização da saúde pública de Mato Grosso. Dados consolidados apontam mais de <strong>10.204 solicitações de teleconsultorias</strong> registradas no sistema, com <strong>9.486 atendimentos concluídos (93% de resolutividade)</strong>.</p><p>Segundo o levantamento, 142 municípios já assinaram o termo de adesão e passaram por capacitação técnica. A rede conta com a retaguarda de 4 polos estaduais (CERMAC, Hemocentro, CRIDAC e Farmácia de Alto Custo) e 4 redes parceiras contratualizadas (Hospital do Câncer, Hospital Geral, CEMs Cuiabá e SAE Lixeira), oferecendo mais de 50 especialidades médicas e multiprofissionais.</p>',
                'published_at' => now()->subDays(2),
                'is_published' => true,
            ],
            [
                'category_id' => $catNoticias->id,
                'title' => 'Tele-retinografia: 70 retinógrafos portáteis ampliam diagnóstico de retinopatia e glaucoma em 50 municípios',
                'slug' => 'tele-retinografia-70-retinografos-portateis-mt',
                'excerpt' => 'Equipamentos adquiridos pelo Governo do Estado já lauderam quase 7 mil exames, prevenindo a perda visual em quase 5 mil cidadãos.',
                'content' => '<p>Com a distribuição de 68 retinógrafos portáteis em comodato para 73 unidades de saúde, a Tele-retinografia de Mato Grosso tornou-se referência nacional em prevenção à cegueira associada ao diabetes e hipertensão.</p><p>A tecnologia não midriática permite que o exame seja realizado na própria UBS municipal por profissional capacitado, com envio digital das imagens para laudo de médicos oftalmologistas especialistas em até 72 horas.</p>',
                'published_at' => now()->subDays(4),
                'is_published' => true,
            ],
            [
                'category_id' => $catCapacitacao->id,
                'title' => 'Tele-Educa MT atinge 1,5 milhão de visualizações com 579 capacitações para profissionais do SUS',
                'slug' => 'tele-educa-mt-atinge-1-5-milhao-visualizacoes',
                'excerpt' => 'Canal oficial @TeleEducaMatoGrosso1 ultrapassa 18 mil profissionais de saúde inscritos em todo o estado de Mato Grosso.',
                'content' => '<p>O canal oficial do <strong>Tele-Educa MT</strong> reafirma seu papel como polo central de conhecimento e educação permanente da SES-MT. Com 579 vídeos e webpalestras transmitidos, o canal registrou exatamente <strong>1.574.040 visualizações</strong> de trabalhadores de saúde dos 141 municípios mato-grossenses.</p>',
                'published_at' => now()->subDays(7),
                'is_published' => true,
            ],
        ];

        foreach ($posts as $p) {
            Post::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 7. Álbum e Fotos da Galeria Institucional
        GalleryAlbum::updateOrCreate(
            ['slug' => 'capacitacao-regional-sinop-teles-pires'],
            [
                'title' => 'Oficina Regional de Telessaúde e Telediagnóstico - Polo Teles Pires (Sinop)',
                'category' => 'Capacitações',
                'event_date' => now()->subDays(15),
                'description' => 'Treinamento prático de cirurgiões-dentistas e médicos no uso do Tele Estomato MT e dos retinógrafos portáteis estaduais.',
                'is_active' => true,
            ]
        );

        GalleryAlbum::updateOrCreate(
            ['slug' => 'mutirao-telediagnostico-caceres-pantanal'],
            [
                'title' => 'Ação de Telediagnóstico e Tele-Raio-X em Cáceres e Pantanal',
                'category' => 'Campanhas de Telediagnóstico',
                'event_date' => now()->subDays(25),
                'description' => 'Mutirão de laudos de imagens e teledermatoscopia para comunidades ribeirinhas e unidades prisionais da região.',
                'is_active' => true,
            ]
        );

        GalleryAlbum::updateOrCreate(
            ['slug' => 'encontro-estadual-ers-cuiaba'],
            [
                'title' => 'Encontro de Integração dos 16 Escritórios Regionais de Saúde (ERS)',
                'category' => 'Eventos',
                'event_date' => now()->subDays(40),
                'description' => 'Reunião estratégica na sede da SES-MT no Centro Político Administrativo (CPA) em Cuiabá para expansão da telessaúde.',
                'is_active' => true,
            ]
        );
    }
}
