<?php

declare(strict_types=1);

namespace App\Support\SectionTypes;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class StatsSectionType extends BaseSectionType
{
    public static function getKey(): string
    {
        return 'stats';
    }

    public static function getLabel(): string
    {
        return 'Impact & Statistics Counters';
    }

    public static function getIcon(): string
    {
        return 'heroicon-o-chart-bar';
    }

    public static function getDefaultContent(): array
    {
        return [
            'intro' => 'A track record of dependable construction across East Africa.',
            'layout' => 'grid_4',
            'counters' => [
                ['value' => '12+', 'label' => 'Years Experience', 'subtext' => 'Delivering quality builds since 2014', 'icon' => 'heroicon-o-calendar'],
                ['value' => '50+', 'label' => 'Delivered Projects', 'subtext' => 'Across 4 key sectors', 'icon' => 'heroicon-o-check-badge'],
                ['value' => '100%', 'label' => 'Safety Compliance', 'subtext' => 'Zero critical site incidents', 'icon' => 'heroicon-o-shield-check'],
                ['value' => '24h', 'label' => 'Client Response', 'subtext' => 'Dedicated site managers', 'icon' => 'heroicon-o-chat-bubble-left-right'],
            ],
        ];
    }

    public static function formSchema(): array
    {
        return [
            Section::make('Statistics Counters Configuration')
                ->schema([
                    Textarea::make('content.intro')
                        ->label('Section Intro Copy')
                        ->rows(2)
                        ->placeholder('Context for the metrics displayed...'),

                    Select::make('content.layout')
                        ->label('Counter Layout')
                        ->options([
                            'grid_4' => '4 Columns (Horizontal Strip)',
                            'grid_3' => '3 Columns (Spacious Cards)',
                            'cards' => 'Elevated Surface Cards with Icons',
                        ])
                        ->default('grid_4'),

                    Repeater::make('content.counters')
                        ->label('Metric Counters')
                        ->itemLabel(fn (array $state): ?string => isset($state['value']) ? "{$state['value']} — ".($state['label'] ?? '') : null)
                        ->reorderable()
                        ->collapsible()
                        ->schema([
                            Grid::make(3)->schema([
                                TextInput::make('value')
                                    ->label('Metric Value')
                                    ->placeholder('e.g. 50+')
                                    ->required(),

                                TextInput::make('label')
                                    ->label('Primary Label')
                                    ->placeholder('e.g. Completed Projects')
                                    ->required(),

                                TextInput::make('icon')
                                    ->label('Heroicon Name')
                                    ->placeholder('heroicon-o-check-badge'),

                                TextInput::make('subtext')
                                    ->label('Supporting Detail')
                                    ->placeholder('e.g. Across residential and commercial sectors')
                                    ->columnSpanFull(),
                            ]),
                        ]),
                ]),
        ];
    }
}
