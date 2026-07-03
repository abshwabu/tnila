<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers\ProjectsRelationManager;
use App\Filament\Resources\CustomerResource\RelationManagers\TestimonialsRelationManager;
use App\Models\Customer;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationGroup = 'CRM';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $modelLabel = 'Customer';

    protected static ?string $pluralModelLabel = 'Customers';

    public static function form(Form $form): Form
    {
        $isAdmin = fn (): bool => Auth::user()?->hasRole('Admin') ?? false;

        return $form->schema([
            Section::make('Contact Info')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->tel()
                        ->maxLength(255),
                    TextInput::make('company_name')
                        ->maxLength(255),
                    TextInput::make('address')
                        ->required()
                        ->columnSpanFull()
                        ->maxLength(255),
                ])
                ->columns(2),
            Section::make('Status')
                ->schema([
                    Select::make('status')
                        ->options([
                            'lead' => 'Lead',
                            'active' => 'Active',
                            'past' => 'Past',
                        ])
                        ->required()
                        ->default('lead'),
                    Select::make('source')
                        ->options([
                            'website' => 'Website',
                            'referral' => 'Referral',
                            'ads' => 'Ads',
                            'other' => 'Other',
                        ])
                        ->required()
                        ->default('website'),
                ])
                ->columns(2),
            Section::make('Notes')
                ->schema([
                    Textarea::make('notes')
                        ->rows(6)
                        ->columnSpanFull(),
                ])
                ->visible($isAdmin)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Company')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'lead',
                        'success' => 'active',
                        'gray' => 'past',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('source')
                    ->badge()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('projects_count')
                    ->counts('projects')
                    ->label('Projects')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M j, Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'lead' => 'Lead',
                        'active' => 'Active',
                        'past' => 'Past',
                    ]),
                Tables\Filters\SelectFilter::make('source')
                    ->options([
                        'website' => 'Website',
                        'referral' => 'Referral',
                        'ads' => 'Ads',
                        'other' => 'Other',
                    ]),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('convertToActive')
                    ->label('Convert to Active')
                    ->icon('heroicon-o-sparkles')
                    ->color('success')
                    ->visible(fn (Customer $record): bool => $record->status === 'lead')
                    ->action(fn (Customer $record): bool => (bool) $record->update(['status' => 'active'])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('updateStatus')
                        ->label('Update status')
                        ->icon('heroicon-o-adjustments-horizontal')
                        ->form([
                            Select::make('status')
                                ->options([
                                    'lead' => 'Lead',
                                    'active' => 'Active',
                                    'past' => 'Past',
                                ])
                                ->required(),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $records->each->update([
                                'status' => $data['status'],
                            ]);
                        }),
                    Tables\Actions\BulkAction::make('exportCsv')
                        ->label('Export selected to CSV')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function (Collection $records) {
                            $headers = [
                                'Content-Type' => 'text/csv',
                                'Content-Disposition' => 'attachment; filename="customers.csv"',
                            ];

                            return Response::streamDownload(function () use ($records): void {
                                $handle = fopen('php://output', 'wb');

                                fputcsv($handle, ['Name', 'Company', 'Email', 'Phone', 'Status', 'Source', 'Address', 'Created At']);

                                $records->each(function (Customer $record) use ($handle): void {
                                    fputcsv($handle, [
                                        $record->name,
                                        $record->company_name,
                                        $record->email,
                                        $record->phone,
                                        $record->status,
                                        $record->source,
                                        $record->address,
                                        optional($record->created_at)?->toDateTimeString(),
                                    ]);
                                });

                                fclose($handle);
                            }, 'customers.csv', $headers);
                        }),
                ]),
            ])
            ->recordUrl(fn (Customer $record): string => static::getUrl('view', ['record' => $record]));
    }

    public static function getRelations(): array
    {
        return [
            ProjectsRelationManager::class,
            TestimonialsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'phone', 'company_name'];
    }
}
