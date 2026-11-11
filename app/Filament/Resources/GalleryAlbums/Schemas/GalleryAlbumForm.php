<?php

namespace App\Filament\Resources\GalleryAlbums\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GalleryAlbumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título do Álbum / Ação')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Select::make('category')
                    ->label('Categoria do Álbum')
                    ->options([
                        'Capacitações' => 'Capacitações',
                        'Eventos' => 'Eventos',
                        'Visitas Técnicas' => 'Visitas Técnicas',
                        'Campanhas de Telediagnóstico' => 'Campanhas de Telediagnóstico',
                    ])
                    ->default('Capacitações')
                    ->required(),
                DatePicker::make('event_date')
                    ->label('Data do Evento')
                    ->default(now()),
                FileUpload::make('cover_image')
                    ->label('Foto de Capa do Álbum')
                    ->image()
                    ->directory('gallery/covers')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Descrição da Ação nos Municípios / ERS')
                    ->rows(3)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Álbum Visível no Portal')
                    ->default(true),
                Repeater::make('photos')
                    ->relationship('photos')
                    ->label('Fotos do Álbum')
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Imagem')
                            ->image()
                            ->directory('gallery/photos')
                            ->required(),
                        TextInput::make('caption')
                            ->label('Legenda / Local da Foto'),
                        TextInput::make('order')
                            ->label('Ordem')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                    ->collapsible()
                    ->defaultItems(0),
            ]);
    }
}
