# 🏥 IntegraSUS Digital Mato Grosso (SES-MT)

Portal institucional público e administrativo do **IntegraSUS Digital Mato Grosso** (antigo *Saúde Digital Mato Grosso*), vinculado à **Secretaria de Estado de Saúde de Mato Grosso (SES-MT)**.

O portal tem como objetivo democratizar o acesso à saúde de qualidade em todo o território mato-grossense, integrando a Atenção Primária aos centros de referência através de **Telessaúde**, **Telediagnóstico** e **Tele-educação** para os **141 municípios** e **16 Escritórios Regionais de Saúde (ERS)** do estado.

---

## 🛠️ Stack Tecnológica

- **Framework Backend**: Laravel 11 (PHP 8.3+)
- **Painel Administrativo / CMS**: Filament v3 / v4 (Painel completo com recursos dedicados)
- **Frontend / Componentes Reativos**: Blade + Livewire 3 + Tailwind CSS
- **Ícones**: Blade Heroicons (Heroicons v2)
- **Identidade Visual**: Padrão institucional Governo de MT / SUS (Azul institucional `#004B8D`, Verde `#00843D`, Dourado `#FFB81C` e Branco)

---

## 🚀 Instalação e Execução

### 1. Clonar e Instalar Dependências PHP & Node
```bash
# Dependências do Composer (Laravel 11, Filament v3, Blade Heroicons, Livewire 3)
composer install

# Dependências do Front-end (Tailwind CSS, Vite, PostCSS)
npm install
```

### 2. Configurar o Ambiente e Banco de Dados
```bash
cp .env.example .env
php artisan key:generate
php artisan storage:link
```

### 3. Executar Migrações e Dados Iniciais (Seeders)
```bash
php artisan migrate --seed
```

> **Credenciais padrão do Painel Administrativo:**
> - **URL**: `http://127.0.0.1:8000/admin`
> - **E-mail**: `admin@saude.mt.gov.br`
> - **Senha**: `admin123`

### 4. Compilar Assets e Iniciar o Servidor
```bash
# Compilar assets para produção ou desenvolvimento
npm run build # ou npm run dev

# Iniciar o servidor Laravel
php artisan serve
```

Acesse o portal em: `http://127.0.0.1:8000`

---

## 📁 Estrutura do Portal Público

1. **Página Inicial (`/`)**:
   - Hero Section com chamadas de impacto e botões de ação rápida (*Acesso ao Sistema de Telessaúde*, *Conheça os Serviços*).
   - Indicadores numéricos rápidos com métricas dos 141 municípios e mais de 185 mil laudos.
   - Grid de serviços principais com ícones dedicados do Heroicons.
   - Chamada para a rede de 16 Escritórios Regionais de Saúde (ERS).
   - Carrossel com as 3 notícias mais recentes e preview da galeria de fotos.
   - Rodapé com dados de contato, endereço no CPA em Cuiabá e conformidade LGPD.

2. **Quem Somos (`/quem-somos`)**:
   - Histórico e missão do Núcleo de Telessaúde e Saúde Digital da SES-MT.
   - Alinhamento normativo com a **Política Nacional de Informação e Saúde Digital (PNISD - Portaria GM/MS nº 12.301/2026)** e **Regimento SES-MT (Decreto nº 667/2024)**.
   - Mapeamento e cobertura dos **16 Escritórios Regionais de Saúde (ERS)** do estado.

3. **Serviços de Telessaúde (`/servicos` e `/servicos/{slug}`)**:
   - **Teleretinografia**: Rastreamento de retinopatia e prevenção de perda visual.
   - **Teleestomatologia**: Avaliação remota e laudos de lesões bucais para diagnóstico precoce de câncer oral.
   - **Teledermatologia & Outros Telediagnósticos**: Laudos de pele e eletrocardiogramas (Tele-ECG).
   - **Teleconsultoria**: Segunda opinião médica e discussão multiprofissional.
   - **Tele-educação & Webconferências**: Capacitações continuadas e webpalestras semanais.

4. **Notícias e Ações (`/noticias` e `/noticias/{slug}`)**:
   - Listagem com componente Livewire reativo (`BlogList`) permitindo pesquisa instantânea por texto e filtro dinâmico por categoria.
   - Página de leitura completa (`Single Post`) com tempo estimado de leitura e botões de compartilhamento (WhatsApp / Copiar Link).

5. **Galeria de Fotos (`/galeria`)**:
   - Componente Livewire interativo (`PhotoGallery`) com filtro por categorias (*Capacitações*, *Campanhas de Telediagnóstico*, *Eventos*, *Visitas Técnicas*).
   - Modal Lightbox em alta resolução para visualização e leitura de legendas.

6. **Contato & Suporte (`/contato`)**:
   - Componente Livewire reativo (`ContactForm`) com validação em tempo real e persistência na base de dados.
   - Informações institucionais de contato e FAQ com dúvidas frequentes.

---

## 🗄️ Modelagem de Dados & Painel Filament

O painel administrativo em `/admin` gerencia:
- `Services` (`ServiceResource`): Título, slug, ícone HeroIcon, descrição curta, conteúdo rico, público-alvo, fluxo de solicitação e ordenação.
- `Posts` (`PostResource`): Título, slug, categoria, imagem destacada, resumo, conteúdo em RichEditor, data de publicação e status.
- `Categories` (`CategoryResource`): Categorias de notícias com contagem de matérias vinculadas.
- `GalleryAlbums` (`GalleryAlbumResource`): Álbum, capa, data do evento, categoria e fotos vinculadas com legendas (`GalleryPhotos`).
- `Banners` (`BannerResource`): Banners da página inicial com tags, chamadas, links de botões e imagem de apoio.
- `Indicators` (`IndicatorResource`): Métricas e números de impacto exibidos na homepage.
- `ContactMessages` (`ContactMessageResource`): Caixa de mensagens recebidas pelo formulário público, com marcação de leitura e suporte.

---

## 🧪 Testes Automatizados

A aplicação conta com suíte de testes cobrindo todas as rotas e componentes Livewire:

```bash
php artisan test
```
Resultados: **15 testes aprovados (47 asserções)** cobrindo disponibilidade HTTP 200, integridade do layout Blade e reatividade do Livewire.
