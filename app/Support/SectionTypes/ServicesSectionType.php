<?php

declare(strict_types=1);

namespace App\Support\SectionTypes;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ServicesSectionType extends BaseSectionType
{
    public static function getKey(): string
    {
        return 'services';
    }

    public static function getLabel(): string
    {
        return 'Services Showcase';
    }

    public static function getIcon(): string
    {
        return 'heroicon-o-briefcase';
    }

    public static function getDefaultContent(): array
    {
        return [
            'intro' => 'End-to-end contracting for modern spaces. Structured delivery across architecture, structural engineering, fit-outs, and construction.',
            'layout' => 'grid_3',
            'items_count' => 6,
            'view_all_label' => 'View all services →',
            'buttons' => [
                ['label' => 'Explore All Services', 'link_type' => 'url', 'target' => null, 'url' => '/services', 'style' => 'primary'],
            ],
        ];
    }

    public static function formSchema(): array
    {
        return [
            Section::make('Services Display Configuration')
                ->schema([
                    Textarea::make('content.intro')
                        ->label('Section Intro Copy')
                        ->rows(2)
                        ->placeholder('Introductory summary of service capabilities...'),

                    Grid::make(3)->schema([
                        Select::make('content.layout')
                            ->label('Grid Layout Style')
                            ->options([
                                'grid_2' => '2 Columns (Spacious Cards)',
                                'grid_3' => '3 Columns (Balanced Grid)',
                                'grid_4' => '4 Columns (Compact Grid)',
                            ])
                            ->default('grid_3'),

                        TextInput::make('content.items_count')
                            ->label('Max Services to Show')
                            ->numeric()
                            ->default(6)
                            ->helperText('Number of services displayed on the home page.'),

                        TextInput::make('content.view_all_label')
                            ->label('View All Link Text')
                            ->default('View all services →'),
                    ]),

                    static::buttonRepeater('content.buttons', 'Section Action Buttons'),

                    Placeholder::make('management_note')
                        ->label('Catalog Management')
                        ->content('Individual services, rich descriptions, icons, and order are managed in Content > Services.'),
                ]),
        ];
    }
}
