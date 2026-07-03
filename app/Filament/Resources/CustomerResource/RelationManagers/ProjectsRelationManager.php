<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'projects';

    protected static ?string $title = 'Projects';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->required()
                ->maxLength(255),
            Select::make('industry_id')
                ->relationship('industry', 'name')
                ->required()
                ->searchable()
                ->preload(),
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
            RichEditor::make('description')->columnSpanFull(),
            Toggle::make('featured'),
            SpatieMediaLibraryFileUpload::make('images')
                ->collection('images')
                ->image()
                ->multiple()
                ->columnSpanFull(),
        ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('industry.name')->label('Industry'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'planning',
                        'info' => 'in_progress',
                        'success' => 'completed',
                    ]),
                Tables\Columns\IconColumn::make('featured')->boolean(),
                Tables\Columns\TextColumn::make('start_date')->date()->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

