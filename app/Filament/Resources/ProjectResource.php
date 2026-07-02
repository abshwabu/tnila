<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('client')
                ->maxLength(255),
            TextInput::make('location')
                ->maxLength(255),
            Select::make('status')
                ->options([
                    'planned' => 'Planned',
                    'in_progress' => 'In progress',
                    'completed' => 'Completed',
                ])
                ->required()
                ->default('completed'),
            Textarea::make('summary')
                ->rows(3)
                ->columnSpanFull(),
            RichEditor::make('description')
                ->columnSpanFull(),
            DatePicker::make('completed_at'),
            Toggle::make('featured'),
            SpatieMediaLibraryFileUpload::make('featured_image')
                ->collection('featured')
                ->image()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('featured_image')
                ->state(fn (Project $record): ?string => $record->getFirstMediaUrl('featured', 'preview') ?: null),
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('client')->searchable(),
            Tables\Columns\TextColumn::make('location')->searchable(),
            Tables\Columns\IconColumn::make('featured')->boolean(),
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'planned',
                    'info' => 'in_progress',
                    'success' => 'completed',
                ]),
            Tables\Columns\TextColumn::make('updated_at')->dateTime()->since()->sortable(),
        ])->defaultSort('updated_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
