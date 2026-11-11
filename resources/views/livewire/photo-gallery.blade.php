<div>
    <!-- Barra de Filtros por Categoria -->
    <div class="flex flex-wrap items-center justify-center gap-3 mb-10">
        @php
            $categories = [
                'Todas' => 'Todas as Ações',
                'Capacitações' => 'Capacitações & Oficinas',
                'Campanhas de Telediagnóstico' => 'Campanhas de Telediagnóstico',
                'Eventos' => 'Eventos Estaduais',
                'Visitas Técnicas' => 'Visitas Técnicas aos Municípios',
            ];
        @endphp

        @foreach ($categories as $catKey => $catLabel)
            <button
                type="button"
                wire:click="setCategory('{{ $catKey }}')"
                class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 cursor-pointer {{ $activeCategory === $catKey ? 'bg-govmt-blue text-white shadow-md shadow-blue-900/20' : 'bg-white text-slate-700 border border-slate-200 hover:border-govmt-blue hover:text-govmt-blue' }}"
            >
                {{ $catLabel }}
            </button>
        @endforeach
    </div>

    <!-- Lista de Álbuns e Registros Fotográficos -->
    @if ($albums->count() > 0)
        <div class="space-y-12">
            @foreach ($albums as $album)
                <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-slate-200/80">
                    <div class="flex flex-col md:flex-row md:items-center justify-between pb-6 mb-6 border-b border-slate-100 gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="bg-govmt-green/10 text-govmt-darkGreen text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                    {{ $album->category }}
                                </span>
                                @if($album->event_date)
                                    <span class="text-xs text-slate-500 flex items-center gap-1">
                                        <x-heroicon-o-calendar class="w-4 h-4 text-slate-400" />
                                        {{ $album->event_date->format('d/m/Y') }}
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-2xl font-bold text-slate-800">{{ $album->title }}</h3>
                            @if($album->description)
                                <p class="text-slate-600 text-sm mt-1 max-w-3xl">{{ $album->description }}</p>
                            @endif
                        </div>
                        <div class="text-xs font-semibold text-slate-500 bg-slate-50 px-4 py-2 rounded-xl border border-slate-100 self-start md:self-auto">
                            {{ $album->photos->count() }} {{ Str::plural('foto', $album->photos->count()) }} registradas
                        </div>
                    </div>

                    <!-- Grid de Fotos do Álbum -->
                    @if($album->photos->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($album->photos as $photo)
                                <div
                                    wire:click="openLightbox({{ $photo->id }})"
                                    class="group relative aspect-[4/3] rounded-2xl overflow-hidden bg-slate-100 cursor-pointer border border-slate-100 hover:shadow-lg transition-all"
                                >
                                    <img
                                        src="{{ asset('storage/' . $photo->image_path) }}"
                                        alt="{{ $photo->caption ?? $album->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                        loading="lazy"
                                    />
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                        <div class="text-white text-xs">
                                            <p class="font-medium line-clamp-2">{{ $photo->caption ?? $album->title }}</p>
                                            <span class="inline-flex items-center gap-1 text-[11px] text-sus-300 mt-1 font-semibold">
                                                <x-heroicon-o-magnifying-glass-plus class="w-3.5 h-3.5" />
                                                Ampliar imagem
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Card Institucional quando ainda não há fotos anexadas -->
                        <div class="p-8 text-center bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                            <x-heroicon-o-camera class="w-10 h-10 text-slate-300 mx-auto mb-2" />
                            <p class="text-sm text-slate-500">Imagens da ação em fase de arquivamento institucional.</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl p-12 text-center border border-slate-200">
            <x-heroicon-o-photo class="w-12 h-12 text-slate-300 mx-auto mb-3" />
            <h4 class="text-lg font-bold text-slate-800 mb-1">Nenhum álbum nesta categoria</h4>
            <p class="text-slate-600 text-sm">Selecione outra categoria acima para visualizar as ações da saúde digital em MT.</p>
        </div>
    @endif

    <!-- Modal / Lightbox Interativo Livewire -->
    @if ($isModalOpen && $activePhotoData)
        <div
            class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-slate-950/80 backdrop-blur-md transition-opacity"
            x-data
            @keydown.escape.window="$wire.closeLightbox()"
        >
            <div
                class="relative bg-white rounded-3xl overflow-hidden shadow-2xl max-w-4xl w-full border border-white/20 animate-in fade-in zoom-in-95 duration-200"
                @click.away="$wire.closeLightbox()"
            >
                <!-- Botão Fechar -->
                <button
                    type="button"
                    wire:click="closeLightbox"
                    class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center transition"
                >
                    <x-heroicon-o-x-mark class="w-6 h-6" />
                </button>

                <!-- Imagem em Destaque -->
                <div class="bg-black/95 flex items-center justify-center max-h-[70vh] overflow-hidden">
                    <img
                        src="{{ asset('storage/' . $activePhotoData['image_path']) }}"
                        alt="{{ $activePhotoData['caption'] }}"
                        class="w-full h-auto max-h-[70vh] object-contain"
                    />
                </div>

                <!-- Detalhes da Foto -->
                <div class="p-6 bg-white flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-bold text-govmt-blue uppercase tracking-wider">
                                {{ $activePhotoData['category'] }}
                            </span>
                            @if(!empty($activePhotoData['event_date']))
                                <span class="text-xs text-slate-400">• {{ $activePhotoData['event_date'] }}</span>
                            @endif
                        </div>
                        <h4 class="text-lg font-bold text-slate-900">{{ $activePhotoData['album_title'] }}</h4>
                        <p class="text-sm text-slate-600 mt-0.5">{{ $activePhotoData['caption'] }}</p>
                    </div>

                    <button
                        type="button"
                        wire:click="closeLightbox"
                        class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold transition self-end sm:self-auto"
                    >
                        Fechar Visualização
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
