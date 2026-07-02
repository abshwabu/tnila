<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Models\Customer;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationGroup = 'CRM';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            TextInput::make('phone')
                ->required()
                ->maxLength(255),
            TextInput::make('company_name')
                ->maxLength(255),
            TextInput::make('address')
                ->required()
                ->maxLength(255),
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
            Textarea::make('notes')
                ->rows(5)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('phone')->searchable(),
            Tables\Columns\TextColumn::make('company_name')->label('Company')->searchable(),
            Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'lead',
                    'success' => 'active',
                    'gray' => 'past',
                ]),
            Tables\Columns\TextColumn::make('source')->badge(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->since()->sortable(),
        ])->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
