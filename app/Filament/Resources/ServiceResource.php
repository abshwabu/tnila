<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Service Details')
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('short_description')
                        ->maxLength(255),
                    TextInput::make('icon')
                        ->required()
                        ->maxLength(255),
                    Toggle::make('featured'),
                    TextInput::make('order')
                        ->numeric()
                        ->default(0)
                        ->required(),
                ])
                ->columns(2),
            Section::make('Content')
                ->schema([
                    RichEditor::make('description')
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('icon'),
            Tables\Columns\IconColumn::make('featured')->boolean(),
            Tables\Columns\TextColumn::make('order')->sortable(),
        ])
            ->defaultSort('order')
            ->reorderable('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
