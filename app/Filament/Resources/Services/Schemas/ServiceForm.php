<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título do Serviço')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->label('Slug')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Select::make('category_type')
                    ->label('Eixo de Atuação')
                    ->options([
                        'Ambulatório de Telessaúde' => 'Ambulatório de Telessaúde (Teleconsultoria / Teleinterconsulta / Teleconsulta)',
                        'Telediagnóstico - Oferta Estadual' => 'Telediagnóstico - Oferta Estadual (SDMT / SES-MT)',
                        'Telediagnóstico - Oferta Nacional' => 'Telediagnóstico - Oferta Nacional (Parcerias MS/Universidades)',
                        'Tele-Educação' => 'Tele-Educação (Tele-Educa MT)',
                    ])
                    ->default('Telediagnóstico - Oferta Estadual')
                    ->required(),
                TextInput::make('partner')
                    ->label('Instituição Parceira / Ofertante')
                    ->placeholder('Ex: SDMT/SES-MT, UFMG, UFSC, UFG, UFPB'),
                TextInput::make('technical_responsible')
                    ->label('Responsável Técnico / Coordenação')
                    ->placeholder('Ex: Dra. Sandra Regina Guiraldeli, Dra. Diurianne Caroline Campos França'),
                TextInput::make('response_time')
                    ->label('Tempo de Resposta / SLA')
                    ->placeholder('Ex: Até 72h, 24h a 48h, Tempo Real'),
                TextInput::make('icon')
                    ->label('Ícone HeroIcon')
                    ->helperText('Ex: heroicon-o-eye, heroicon-o-sparkles, heroicon-o-chat-bubble-left-right, heroicon-o-heart, heroicon-o-camera, heroicon-o-academic-cap')
                    ->default('heroicon-o-cpu-chip')
                    ->required(),
                TextInput::make('target_audience')
                    ->label('Público-Alvo')
                    ->placeholder('Ex: Médicos, Cirurgiões-dentistas, Equipes da APS, PPL')
                    ->maxLength(255),
                Textarea::make('short_description')
                    ->label('Descrição Curta')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Apresentação / Conteúdo Completo')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('flow_description')
                    ->label('Fluxo de Atendimento / Passo a Passo')
                    ->placeholder('Passo 1... Passo 2... Passo 3...')
                    ->rows(4)
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->label('Ordem de Exibição')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Serviço Ativo')
                    ->default(true),
            ]);
    }
}
