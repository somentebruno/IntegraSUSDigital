<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use App\Models\Service;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_portal')
                ->label('Visualizar no Portal')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('info')
                ->url(fn (Service $record): string => route('services.show', $record->slug))
                ->openUrlInNewTab(),
            DeleteAction::make(),
        ];
    }
}
