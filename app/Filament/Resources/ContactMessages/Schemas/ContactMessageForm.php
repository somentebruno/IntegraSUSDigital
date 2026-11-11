<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome Completo')
                    ->disabled(),
                TextInput::make('email')
                    ->label('E-mail')
                    ->disabled(),
                TextInput::make('phone')
                    ->label('Telefone / WhatsApp')
                    ->disabled(),
                TextInput::make('municipality')
                    ->label('Município (MT)')
                    ->disabled(),
                TextInput::make('profession')
                    ->label('Cargo / Profissão')
                    ->disabled(),
                TextInput::make('subject')
                    ->label('Assunto')
                    ->disabled(),
                Textarea::make('message')
                    ->label('Mensagem')
                    ->rows(6)
                    ->disabled()
                    ->columnSpanFull(),
                Toggle::make('is_read')
                    ->label('Marcar como Lido / Atendido')
                    ->default(false),
            ]);
    }
}
