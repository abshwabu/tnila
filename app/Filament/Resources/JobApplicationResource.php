<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobApplicationResource\Pages;
use App\Models\JobApplication;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static ?string $navigationGroup = 'Careers';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Application Details')
                ->schema([
                    Select::make('job_listing_id')
                        ->relationship('jobListing', 'title')
                        ->searchable()
                        ->preload()
                        ->required(),
                    TextInput::make('applicant_name')->required()->maxLength(255),
                    TextInput::make('email')->email()->required()->maxLength(255),
                    TextInput::make('phone')->tel()->maxLength(255),
                    TextInput::make('resume')->label('Resume path')->required()->maxLength(255),
                    Select::make('status')
                        ->options([
                            'new' => 'New',
                            'reviewed' => 'Reviewed',
                            'interviewing' => 'Interviewing',
                            'rejected' => 'Rejected',
                            'hired' => 'Hired',
                        ])
                        ->required()
                        ->default('new'),
                    Textarea::make('cover_letter')->rows(8)->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('applicant_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('jobListing.title')->label('Position')->toggleable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('phone')->toggleable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'new',
                        'warning' => 'reviewed',
                        'info' => 'interviewing',
                        'danger' => 'rejected',
                        'success' => 'hired',
                    ]),
                Tables\Columns\TextColumn::make('resume')
                    ->label('Resume')
                    ->formatStateUsing(fn (): string => 'Download')
                    ->url(fn (JobApplication $record): string => Storage::url($record->resume))
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('created_at')->dateTime('M j, Y')->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('updateStatus')
                    ->label('Quick Update')
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->form([
                        Select::make('status')
                            ->options([
                                'new' => 'New',
                                'reviewed' => 'Reviewed',
                                'interviewing' => 'Interviewing',
                                'rejected' => 'Rejected',
                                'hired' => 'Hired',
                            ])
                            ->required(),
                    ])
                    ->action(fn (JobApplication $record, array $data): bool => (bool) $record->update($data)),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobApplications::route('/'),
            'create' => Pages\CreateJobApplication::route('/create'),
            'edit' => Pages\EditJobApplication::route('/{record}/edit'),
        ];
    }
}
