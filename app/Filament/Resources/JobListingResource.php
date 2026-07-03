<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobListingResource\Pages;
use App\Models\JobListing;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JobListingResource extends Resource
{
    protected static ?string $model = JobListing::class;

    protected static ?string $navigationGroup = 'Careers';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Job Details')
                ->schema([
                    TextInput::make('title')->required()->maxLength(255),
                    TextInput::make('department')->required()->maxLength(255),
                    TextInput::make('location')->required()->maxLength(255),
                    Select::make('employment_type')
                        ->options([
                            'full_time' => 'Full time',
                            'part_time' => 'Part time',
                            'contract' => 'Contract',
                        ])
                        ->required(),
                    Select::make('status')
                        ->options([
                            'open' => 'Open',
                            'closed' => 'Closed',
                        ])
                        ->required()
                        ->default('open'),
                ])
                ->columns(2),
            Section::make('Description')
                ->schema([
                    RichEditor::make('description')->columnSpanFull(),
                    Textarea::make('requirements')
                        ->required()
                        ->rows(8)
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('department')->toggleable(),
                Tables\Columns\TextColumn::make('location')->toggleable(),
                Tables\Columns\BadgeColumn::make('employment_type'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'open',
                        'gray' => 'closed',
                    ]),
                Tables\Columns\TextColumn::make('applications_count')
                    ->counts('applications')
                    ->label('Applications'),
            ])
            ->actions([
                Tables\Actions\Action::make('toggleStatus')
                    ->label(fn (JobListing $record): string => $record->status === 'open' ? 'Close' : 'Open')
                    ->icon(fn (JobListing $record): string => $record->status === 'open' ? 'heroicon-o-lock-closed' : 'heroicon-o-lock-open')
                    ->color(fn (JobListing $record): string => $record->status === 'open' ? 'gray' : 'success')
                    ->action(function (JobListing $record): void {
                        $record->update([
                            'status' => $record->status === 'open' ? 'closed' : 'open',
                        ]);
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobListings::route('/'),
            'create' => Pages\CreateJobListing::route('/create'),
            'edit' => Pages\EditJobListing::route('/{record}/edit'),
        ];
    }
}
