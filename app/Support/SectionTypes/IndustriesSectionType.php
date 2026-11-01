<?php

declare(strict_types=1);

namespace App\Support\SectionTypes;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class IndustriesSectionType extends BaseSectionType
{
    public static function getKey(): string
    {
        return 'industries';
    }

    public static function getLabel(): string
    {
        return 'Industries & Sectors';
    }

    public static function getIcon(): string
    {
        return 'heroicon-o-building-office-2';
    }

    public static function getDefaultContent(): array
    {
        return [
            'intro' => 'Four sectors, one dependable process across residential, commercial, industrial, and infrastructure work.',
            'show_project_count' => true,
            'view_all_label' => 'Explore industries →',
            'buttons' => [],
        ];
    }

    public static function formSchema(): array
    {
        return [
            Section::make('Industries Configuration')
                ->schema([
                    Textarea::make('content.intro')
                        ->label('Section Intro Copy')
                        ->rows(2)
                        ->placeholder('Introductory copy on sector specialization...'),

                    Grid::make(2)->schema([
                        Toggle::make('content.show_project_count')
                            ->label('Show Delivered Project Count Badge')
                            ->default(true)
                            ->helperText('Displays the number of completed projects per sector card.'),

                        TextInput::make('content.view_all_label')
                            ->label('Link Label')
                            ->default('Explore industries →'),
                    ]),

                    static::buttonRepeater('content.buttons', 'Section Action Buttons'),

                    Placeholder::make('management_note')
                        ->label('Sector Management')
                        ->content('Industry titles, icons, and descriptions are managed in Content > Industries.'),
                ]),
        ];
    }
}
