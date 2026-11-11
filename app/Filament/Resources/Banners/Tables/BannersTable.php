<?php

namespace App\Filament\Resources\Banners\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BannersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label('Ordem')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Título do Destaque')
                    ->searchable()
                    ->limit(45),
                TextColumn::make('tag')
                    ->label('Tag / Selo')
                    ->badge()
                    ->color('info'),
                TextColumn::make('location')
                    ->label('Onde Aparece no Portal')
                    ->default('Faixa de Destaques da Home (Abaixo das 4 Portas)')
                    ->badge()
                    ->color('success'),
                TextColumn::make('button_text')
                    ->label('Botão de Ação'),
                IconColumn::make('is_active')
                    ->label('Ativo na Home')
                    ->boolean(),
            ])
            ->defaultSort('order', 'asc')
            ->recordActions([
                Action::make('view_home')
                    ->label('Ver no Portal')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('info')
                    ->url(url('/'))
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
