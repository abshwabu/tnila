<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndustryResource\Pages;
use App\Models\Industry;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class IndustryResource extends Resource
{
    protected static ?string $model = Industry::class;

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Industry Details')
                ->schema([
                    TextInput::make('name')->required()->maxLength(255),
                    TextInput::make('icon')->required()->maxLength(255),
                    TextInput::make('description')->maxLength(255)->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('slug')->toggleable(),
            Tables\Columns\TextColumn::make('icon'),
            Tables\Columns\TextColumn::make('description')->limit(60)->toggleable(),
        ])->defaultSort('name');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIndustries::route('/'),
            'create' => Pages\CreateIndustry::route('/create'),
            'edit' => Pages\EditIndustry::route('/{record}/edit'),
        ];
    }
}
