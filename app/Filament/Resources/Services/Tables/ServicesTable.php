<?php

namespace App\Filament\Resources\Services\Tables;

use App\Models\Service;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')
                    ->label('Ordem')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Título do Serviço')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category_type')
                    ->label('Eixo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Ambulatório de Telessaúde' => 'info',
                        'Telediagnóstico - Oferta Estadual' => 'success',
                        'Telediagnóstico - Oferta Nacional' => 'warning',
                        'Tele-Educação' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('partner')
                    ->label('Parceria / Ofertante')
                    ->searchable(),
                TextColumn::make('response_time')
                    ->label('Prazo / SLA'),
                IconColumn::make('is_active')
                    ->label('Ativo')
                    ->boolean(),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                SelectFilter::make('category_type')
                    ->label('Filtrar por Eixo')
                    ->options([
                        'Ambulatório de Telessaúde' => 'Ambulatório de Telessaúde',
                        'Telediagnóstico - Oferta Estadual' => 'Telediagnóstico - Oferta Estadual',
                        'Telediagnóstico - Oferta Nacional' => 'Telediagnóstico - Oferta Nacional',
                        'Tele-Educação' => 'Tele-Educação',
                    ]),
            ])
            ->recordActions([
                Action::make('view_portal')
                    ->label('Visualizar')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->color('info')
                    ->tooltip('Abrir página pública do serviço no portal')
                    ->url(fn (Service $record): string => route('services.show', $record->slug))
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
