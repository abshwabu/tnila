<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialsRelationManager extends RelationManager
{
    protected static string $relationship = 'testimonials';

    protected static ?string $title = 'Testimonials';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('author_name')
                ->required()
                ->maxLength(255),
            TextInput::make('author_role')
                ->maxLength(255),
            TextInput::make('company')
                ->maxLength(255),
            Select::make('rating')
                ->options(array_combine(range(1, 5), range(1, 5)))
                ->required(),
            Textarea::make('content')
                ->required()
                ->rows(6)
                ->columnSpanFull(),
            Select::make('project_id')
                ->relationship('project', 'title')
                ->searchable()
                ->preload(),
            Tables\Forms\Components\Toggle::make('featured'),
            Tables\Forms\Components\Toggle::make('approved'),
        ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('author_role')->toggleable(),
                Tables\Columns\TextColumn::make('company')->toggleable(),
                Tables\Columns\TextColumn::make('project.title')->label('Project'),
                Tables\Columns\TextColumn::make('rating')->badge(),
                Tables\Columns\ToggleColumn::make('approved')->label('Approved'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}

