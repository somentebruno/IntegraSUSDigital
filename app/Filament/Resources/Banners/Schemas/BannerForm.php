<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tag')
                    ->label('Selo / Tag Superior')
                    ->placeholder('Ex: NOVO PORTAL INSTITUCIONAL SES-MT'),
                TextInput::make('title')
                    ->label('Título do Banner')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Textarea::make('subtitle')
                    ->label('Subtítulo / Texto de Apoio')
                    ->rows(3)
                    ->columnSpanFull(),
                TextInput::make('button_text')
                    ->label('Texto do Botão Principal')
                    ->placeholder('Ex: Acesso ao Sistema de Telessaúde'),
                TextInput::make('button_url')
                    ->label('Link do Botão Principal')
                    ->placeholder('https://... ou /servicos'),
                TextInput::make('secondary_button_text')
                    ->label('Texto do Botão Secundário')
                    ->placeholder('Ex: Conheça os Serviços'),
                TextInput::make('secondary_button_url')
                    ->label('Link do Botão Secundário')
                    ->placeholder('#servicos'),
                FileUpload::make('image_path')
                    ->label('Imagem de Fundo / Ilustração')
                    ->image()
                    ->directory('banners')
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->label('Ordem')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Banner Ativo')
                    ->default(true),
            ]);
    }
}
