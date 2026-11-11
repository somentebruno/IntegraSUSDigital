<?php

namespace App\Filament\Resources\Indicators\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class IndicatorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título do Indicador')
                    ->required()
                    ->maxLength(255),
                TextInput::make('value')
                    ->label('Valor / Número em Destaque')
                    ->placeholder('Ex: 141, +185.000, 16')
                    ->required()
                    ->maxLength(50),
                TextInput::make('suffix')
                    ->label('Sufixo / Unidade')
                    ->placeholder('Ex: municípios, laudos emitidos, teleconsultorias'),
                TextInput::make('icon')
                    ->label('HeroIcon')
                    ->default('heroicon-o-chart-bar')
                    ->helperText('Ex: heroicon-o-map-pin, heroicon-o-academic-cap, heroicon-o-chat-bubble-left-right')
                    ->required(),
                Textarea::make('description')
                    ->label('Descrição Complementar')
                    ->rows(2)
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->label('Ordem')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Indicador Ativo')
                    ->default(true),
            ]);
    }
}
