<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Section;
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

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Project Details')
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                    Select::make('customer_id')
                        ->relationship('customer', 'name')
                        ->searchable()
                        ->preload(),
                    Select::make('industry_id')
                        ->relationship('industry', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('status')
                        ->options([
                            'planning' => 'Planning',
                            'in_progress' => 'In progress',
                            'completed' => 'Completed',
                        ])
                        ->required(),
                    DatePicker::make('start_date')->required(),
                    DatePicker::make('end_date'),
                    TextInput::make('location')
                        ->required()
                        ->maxLength(255),
                    Toggle::make('featured'),
                ])
                ->columns(2),
            Section::make('Content')
                ->schema([
                    RichEditor::make('description')->columnSpanFull(),
                    SpatieMediaLibraryFileUpload::make('images')
                        ->collection('images')
                        ->image()
                        ->multiple()
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('featured_image')
                ->state(fn (Project $record): ?string => $record->featuredImageUrl()),
            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('customer.name')->label('Customer')->searchable(),
            Tables\Columns\TextColumn::make('industry.name')->label('Industry')->searchable(),
            Tables\Columns\TextColumn::make('location')->searchable(),
            Tables\Columns\IconColumn::make('featured')->boolean(),
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'planning',
                    'info' => 'in_progress',
                    'success' => 'completed',
                ]),
            Tables\Columns\TextColumn::make('start_date')->date()->sortable(),
        ])
            ->filters([
                Tables\Filters\SelectFilter::make('industry_id')
                    ->relationship('industry', 'name')
                    ->label('Industry'),
            ])
            ->defaultSort('start_date', 'desc');
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
