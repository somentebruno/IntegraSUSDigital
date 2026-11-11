<?php

namespace App\Filament\Resources\Indicators\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IndicatorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label('Ordem')
                    ->sortable(),
                TextColumn::make('value')
                    ->label('Valor Destaque')
                    ->weight('black')
                    ->color('primary'),
                TextColumn::make('title')
                    ->label('Nome do Indicador')
                    ->searchable(),
                TextColumn::make('suffix')
                    ->label('Sufixo / Unidade'),
                TextColumn::make('location')
                    ->label('Onde Aparece no Portal')
                    ->default('Barômetro da Home (Top 4 Ativos por Ordem)')
                    ->badge()
                    ->color('warning'),
                IconColumn::make('is_active')
                    ->label('Ativo na Home')
                    ->boolean(),
            ])
            ->defaultSort('order', 'asc')
            ->recordActions([
                Action::make('view_barometro')
                    ->label('Ver no Portal')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('info')
                    ->url(url('/#barometro'))
                    ->openUrlInNewTab(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
