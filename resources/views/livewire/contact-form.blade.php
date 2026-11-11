<div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-8 sm:p-10">
    @if ($sent)
        <div class="text-center py-10 px-4">
            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-heroicon-o-check-circle class="w-10 h-10" />
            </div>
            <h3 class="text-2xl font-bold text-slate-800 mb-2">Mensagem Enviada com Sucesso!</h3>
            <p class="text-slate-600 max-w-lg mx-auto mb-6">
                Agradecemos o seu contato com o Núcleo de Telessaúde e Saúde Digital da SES-MT. Nossa equipe técnica responderá no seu e-mail informado o mais breve possível.
            </p>
            <button
                type="button"
                wire:click="resetForm"
                class="inline-flex items-center gap-2 bg-govmt-blue hover:bg-govmt-darkBlue text-white font-semibold px-6 py-3 rounded-xl transition duration-200"
            >
                <x-heroicon-o-arrow-path class="w-5 h-5" />
                Enviar nova mensagem
            </button>
        </div>
    @else
        <form wire:submit.prevent="submit" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nome -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">
                        Nome Completo <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <x-heroicon-o-user class="w-5 h-5" />
                        </div>
                        <input
                            type="text"
                            id="name"
                            wire:model.defer="name"
                            placeholder="Seu nome completo"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border @error('name') border-rose-400 ring-rose-200 @else border-slate-300 focus:border-sus-600 focus:ring-sus-200 @enderror focus:ring-4 transition text-sm text-slate-800 placeholder-slate-400"
                        />
                    </div>
                    @error('name') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- E-mail -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">
                        E-mail Institucional ou Pessoal <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <x-heroicon-o-envelope class="w-5 h-5" />
                        </div>
                        <input
                            type="email"
                            id="email"
                            wire:model.defer="email"
                            placeholder="seu.email@exemplo.gov.br"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border @error('email') border-rose-400 ring-rose-200 @else border-slate-300 focus:border-sus-600 focus:ring-sus-200 @enderror focus:ring-4 transition text-sm text-slate-800 placeholder-slate-400"
                        />
                    </div>
                    @error('email') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Município de MT -->
                <div>
                    <label for="municipality" class="block text-sm font-semibold text-slate-700 mb-1">
                        Município (Mato Grosso) <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <x-heroicon-o-map-pin class="w-5 h-5" />
                        </div>
                        <input
                            type="text"
                            id="municipality"
                            wire:model.defer="municipality"
                            placeholder="Ex: Cuiabá, Sinop, Rondonópolis..."
                            class="w-full pl-10 pr-4 py-3 rounded-xl border @error('municipality') border-rose-400 ring-rose-200 @else border-slate-300 focus:border-sus-600 focus:ring-sus-200 @enderror focus:ring-4 transition text-sm text-slate-800 placeholder-slate-400"
                        />
                    </div>
                    @error('municipality') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Cargo / Profissão -->
                <div>
                    <label for="profession" class="block text-sm font-semibold text-slate-700 mb-1">
                        Cargo / Profissão no SUS <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <x-heroicon-o-briefcase class="w-5 h-5" />
                        </div>
                        <input
                            type="text"
                            id="profession"
                            wire:model.defer="profession"
                            placeholder="Ex: Médico de Família, Enfermeiro, Dentista..."
                            class="w-full pl-10 pr-4 py-3 rounded-xl border @error('profession') border-rose-400 ring-rose-200 @else border-slate-300 focus:border-sus-600 focus:ring-sus-200 @enderror focus:ring-4 transition text-sm text-slate-800 placeholder-slate-400"
                        />
                    </div>
                    @error('profession') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Telefone / WhatsApp -->
                <div>
                    <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1">
                        Telefone / WhatsApp (Opcional)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <x-heroicon-o-phone class="w-5 h-5" />
                        </div>
                        <input
                            type="text"
                            id="phone"
                            wire:model.defer="phone"
                            placeholder="(65) 99999-9999"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 focus:border-sus-600 focus:ring-4 focus:ring-sus-200 transition text-sm text-slate-800 placeholder-slate-400"
                        />
                    </div>
                </div>

                <!-- Assunto -->
                <div>
                    <label for="subject" class="block text-sm font-semibold text-slate-700 mb-1">
                        Assunto <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <select
                            id="subject"
                            wire:model.defer="subject"
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:border-sus-600 focus:ring-4 focus:ring-sus-200 transition text-sm text-slate-800"
                        >
                            <option value="Dúvida Geral / Informações">Dúvida Geral / Informações</option>
                            <option value="Adesão ao IntegraSUS Digital MT">Adesão ao IntegraSUS Digital MT</option>
                            <option value="Suporte Técnico / Acesso à Plataforma">Suporte Técnico / Acesso à Plataforma</option>
                            <option value="Agendamento de Treinamento / Capacitação">Agendamento de Treinamento / Capacitação</option>
                            <option value="Solicitação de Telediagnóstico Municipal">Solicitação de Telediagnóstico Municipal</option>
                            <option value="Outros Assuntos">Outros Assuntos</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Mensagem -->
            <div>
                <label for="message" class="block text-sm font-semibold text-slate-700 mb-1">
                    Mensagem / Descrição <span class="text-rose-500">*</span>
                </label>
                <textarea
                    id="message"
                    rows="5"
                    wire:model.defer="message"
                    placeholder="Descreva com detalhes sua dúvida ou necessidade técnica..."
                    class="w-full px-4 py-3 rounded-xl border @error('message') border-rose-400 ring-rose-200 @else border-slate-300 focus:border-sus-600 focus:ring-sus-200 @enderror focus:ring-4 transition text-sm text-slate-800 placeholder-slate-400"
                ></textarea>
                @error('message') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="pt-2">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-govmt-blue hover:bg-govmt-darkBlue text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 disabled:opacity-60 cursor-pointer"
                >
                    <span wire:loading.remove wire:target="submit" class="inline-flex items-center gap-2">
                        <x-heroicon-o-paper-airplane class="w-5 h-5 rotate-45" />
                        Enviar Mensagem
                    </span>
                    <span wire:loading wire:target="submit" class="inline-flex items-center gap-2">
                        <x-heroicon-o-arrow-path class="w-5 h-5 animate-spin" />
                        Enviando...
                    </span>
                </button>
            </div>
        </form>
    @endif
</div>
