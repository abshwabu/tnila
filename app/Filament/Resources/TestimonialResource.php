<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationGroup = 'CRM';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Testimonial Details')
                ->schema([
                    Select::make('customer_id')
                        ->relationship('customer', 'name')
                        ->searchable()
                        ->preload(),
                    Select::make('project_id')
                        ->relationship('project', 'title')
                        ->searchable()
                        ->preload(),
                    TextInput::make('author_name')->required()->maxLength(255),
                    TextInput::make('author_role')->maxLength(255),
                    TextInput::make('company')->maxLength(255),
                    Select::make('rating')
                        ->options(array_combine(range(1, 5), range(1, 5)))
                        ->required(),
                    Toggle::make('featured'),
                    Toggle::make('approved'),
                    Textarea::make('content')
                        ->required()
                        ->rows(8)
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('customer.name')->label('Customer')->toggleable(),
                Tables\Columns\TextColumn::make('project.title')->label('Project')->toggleable(),
                Tables\Columns\TextColumn::make('rating')->badge(),
                Tables\Columns\ToggleColumn::make('approved'),
                Tables\Columns\IconColumn::make('featured')->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('approved'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
