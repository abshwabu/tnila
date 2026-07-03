<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InquiryResource\Pages;
use App\Models\ContactSubmission;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InquiryResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static ?string $navigationGroup = 'CRM';

    protected static ?string $navigationLabel = 'Contact Submissions';

    protected static ?string $navigationIcon = 'heroicon-o-inbox';

    protected static ?int $navigationSort = 3;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('phone')->toggleable(),
                Tables\Columns\TextColumn::make('source_page')->searchable()->limit(30),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'new',
                        'warning' => 'contacted',
                        'success' => 'closed',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime('M j, Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\Action::make('reply')
                    ->label('Reply')
                    ->icon('heroicon-o-envelope')
                    ->url(fn (ContactSubmission $record): string => 'mailto:' . $record->email . '?subject=' . rawurlencode('Thanks for contacting Tnila'))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('markContacted')
                    ->label('Contacted')
                    ->icon('heroicon-o-check-circle')
                    ->color('warning')
                    ->visible(fn (ContactSubmission $record): bool => $record->status !== 'contacted')
                    ->action(fn (ContactSubmission $record): bool => (bool) $record->update(['status' => 'contacted'])),
                Tables\Actions\Action::make('markClosed')
                    ->label('Closed')
                    ->icon('heroicon-o-x-circle')
                    ->color('gray')
                    ->visible(fn (ContactSubmission $record): bool => $record->status !== 'closed')
                    ->action(fn (ContactSubmission $record): bool => (bool) $record->update(['status' => 'closed'])),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'closed' => 'Closed',
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInquiries::route('/'),
            'create' => Pages\CreateInquiry::route('/create'),
            'edit' => Pages\EditInquiry::route('/{record}/edit'),
        ];
    }
}
