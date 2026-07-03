<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewCustomer extends ViewRecord
{
    protected static string $resource = CustomerResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Customer Summary')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('name'),
                            TextEntry::make('company_name')
                                ->label('Company'),
                            TextEntry::make('email'),
                            TextEntry::make('phone'),
                            TextEntry::make('address')
                                ->columnSpanFull(),
                            TextEntry::make('status')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'lead' => 'warning',
                                    'active' => 'success',
                                    default => 'gray',
                                }),
                            TextEntry::make('source')
                                ->badge(),
                        ]),
                    ]),
                Section::make('Timeline')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('created_at')->dateTime('M j, Y g:i A'),
                            TextEntry::make('updated_at')->dateTime('M j, Y g:i A'),
                            TextEntry::make('projects_count')
                                ->state(fn ($record): int => $record->projects()->count())
                                ->label('Projects'),
                        ]),
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

