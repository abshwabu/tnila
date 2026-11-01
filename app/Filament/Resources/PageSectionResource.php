<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\PageSectionResource\Pages\CreatePageSection;
use App\Filament\Resources\PageSectionResource\Pages\EditPageSection;
use App\Filament\Resources\PageSectionResource\Pages\ListPageSections;
use App\Models\PageSection;
use App\Support\SectionTypes;
use App\Support\Site;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PageSectionResource extends Resource
{
    protected static ?string $model = PageSection::class;

    protected static ?string $navigationGroup = 'Site';

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Page Sections';

    protected static ?string $pluralModelLabel = 'Page Sections';

    protected static ?string $modelLabel = 'Page Section';

    /**
     * Essential core sections that cannot be deleted.
     *
     * @var list<string>
     */
    public const CORE_KEYS = [
        'hero',
        'services',
        'projects',
        'testimonials',
        'contact',
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Section Settings')
                    ->tabs([
                        Tab::make('General')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextInput::make('nav_label')
                                        ->label('Navigation Label')
                                        ->placeholder('e.g. Services')
                                        ->helperText('Text displayed in header navigation links.'),

                                    TextInput::make('anchor')
                                        ->label('HTML Anchor ID')
                                        ->placeholder('services')
                                        ->helperText('Section ID for on-page anchor navigation (e.g. #services).'),

                                    Toggle::make('is_visible')
                                        ->label('Visible on Site')
                                        ->default(true)
                                        ->helperText('Toggle whether this section appears on the live page.'),
                                ]),

                                Grid::make(3)->schema([
                                    TextInput::make('key')
                                        ->label('Unique Section Key')
                                        ->required()
                                        ->unique(ignoreRecord: true)
                                        ->disabled(fn (string $operation): bool => $operation === 'edit')
                                        ->helperText('Internal identifier used to query this section in code.'),

                                    Select::make('type')
                                        ->label('Section Type')
                                        ->options(SectionTypes::options())
                                        ->required()
                                        ->disabled(fn (string $operation): bool => $operation === 'edit')
                                        ->helperText('Select template type to determine available layout.'),

                                    TextInput::make('sort_order')
                                        ->label('Display Sort Order')
                                        ->numeric()
                                        ->default(0)
                                        ->required()
                                        ->helperText('Position in page flow (lower numbers appear first).'),
                                ]),
                            ]),

                        Tab::make('Header & Copy')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('content.eyebrow')
                                    ->label('Eyebrow / Category Tag')
                                    ->placeholder('e.g. Portfolio')
                                    ->helperText('Small accent label displayed above the main heading.'),

                                TextInput::make('content.heading')
                                    ->label('Main Heading')
                                    ->placeholder('e.g. What We Do Best')
                                    ->helperText('Primary title of this section.'),

                                TextInput::make('content.subheading')
                                    ->label('Subheading')
                                    ->placeholder('e.g. Dedicated craftsmanship across all build phases...')
                                    ->helperText('Subtitle supporting the main heading.'),

                                RichEditor::make('content.body')
                                    ->label('Rich Text Body Copy')
                                    ->helperText('Optional detailed narrative body text.'),
                            ]),

                        Tab::make('Style & Background')
                            ->icon('heroicon-o-paint-brush')
                            ->schema([
                                Grid::make(4)->schema([
                                    Select::make('style.background_type')
                                        ->label('Background Type')
                                        ->options([
                                            'none' => 'Transparent / Default',
                                            'color' => 'Solid Color',
                                        ])
                                        ->default('none')
                                        ->live(),

                                    ColorPicker::make('style.background_color')
                                        ->label('Background Color')
                                        ->visible(fn (Get $get): bool => ($get('style.background_type') ?? 'none') === 'color'),

                                    Select::make('style.text_theme')
                                        ->label('Text Contrast Theme')
                                        ->options([
                                            'dark' => 'Dark Text (for light backgrounds)',
                                            'light' => 'Light Text (for dark backgrounds)',
                                        ])
                                        ->default('dark'),

                                    Select::make('style.vertical_padding')
                                        ->label('Vertical Padding Size')
                                        ->options([
                                            's' => 'Compact (Small)',
                                            'm' => 'Normal (Medium)',
                                            'l' => 'Spacious (Large)',
                                            'xl' => 'Hero (Extra Large)',
                                        ])
                                        ->default('m'),
                                ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order', 'asc')
            ->columns([
                TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable()
                    ->width('50px'),

                TextColumn::make('nav_label')
                    ->label('Navigation Label')
                    ->placeholder('—')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('key')
                    ->label('Key')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Section Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => SectionTypes::label($state))
                    ->color(fn (string $state): string => match ($state) {
                        'hero' => 'primary',
                        'cta_banner' => 'warning',
                        'contact' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                ToggleColumn::make('is_visible')
                    ->label('Visible')
                    ->afterStateUpdated(fn () => Site::flushCache()),

                TextColumn::make('anchor')
                    ->label('Anchor')
                    ->prefix('#')
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\ReplicateAction::make()
                    ->label('Duplicate')
                    ->modalHeading('Duplicate Section')
                    ->beforeReplicaSaved(function (PageSection $replica): void {
                        $baseKey = $replica->key;
                        $counter = 2;
                        while (PageSection::query()->where('key', "{$baseKey}-{$counter}")->exists()) {
                            $counter++;
                        }
                        $replica->key = "{$baseKey}-{$counter}";
                        $replica->nav_label = $replica->nav_label ? "{$replica->nav_label} (Copy)" : null;
                        $replica->anchor = $replica->key;
                        $replica->sort_order = ((int) PageSection::max('sort_order')) + 1;
                    })
                    ->after(fn () => Site::flushCache()),

                Tables\Actions\DeleteAction::make()
                    ->hidden(fn (PageSection $record): bool => in_array($record->key, PageSectionResource::CORE_KEYS, true))
                    ->after(fn () => Site::flushCache()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records): void {
                            $records
                                ->reject(fn (PageSection $record): bool => in_array($record->key, PageSectionResource::CORE_KEYS, true))
                                ->each->delete();
                            Site::flushCache();
                        }),
                ]),
            ]);
    }

    public static function canDelete(Model $record): bool
    {
        /** @var PageSection $record */
        return ! in_array($record->key, static::CORE_KEYS, true);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPageSections::route('/'),
            'create' => CreatePageSection::route('/create'),
            'edit' => EditPageSection::route('/{record}/edit'),
        ];
    }
}
