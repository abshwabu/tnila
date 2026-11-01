<?php

declare(strict_types=1);

namespace App\Support\SectionTypes;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ProjectsSectionType extends BaseSectionType
{
    public static function getKey(): string
    {
        return 'projects';
    }

    public static function getLabel(): string
    {
        return 'Featured Projects Portfolio';
    }

    public static function getIcon(): string
    {
        return 'heroicon-o-rectangle-stack';
    }

    public static function getDefaultContent(): array
    {
        return [
            'intro' => 'Selected work that speaks for itself. Explore builds delivered on schedule, within budget, and to exacting specifications.',
            'items_count' => 4,
            'show_filter_tabs' => true,
            'view_all_label' => 'All projects →',
            'buttons' => [
                ['label' => 'View Full Portfolio', 'link_type' => 'url', 'target' => null, 'url' => '/projects', 'style' => 'primary'],
            ],
        ];
    }

    public static function formSchema(): array
    {
        return [
            Section::make('Portfolio Configuration')
                ->schema([
                    Textarea::make('content.intro')
                        ->label('Section Intro Copy')
                        ->rows(2)
                        ->placeholder('Introductory copy describing project standards...'),

                    Grid::make(3)->schema([
                        TextInput::make('content.items_count')
                            ->label('Max Featured Projects to Show')
                            ->numeric()
                            ->default(4)
                            ->helperText('Number of featured projects shown on the page.'),

                        Toggle::make('content.show_filter_tabs')
                            ->label('Show Sector Filter Tabs')
                            ->default(true),

                        TextInput::make('content.view_all_label')
                            ->label('View All Link Text')
                            ->default('All projects →'),
                    ]),

                    static::buttonRepeater('content.buttons', 'Portfolio Action Buttons'),

                    Placeholder::make('management_note')
                        ->label('Projects Management')
                        ->content('Project titles, photography, customer links, statuses, and locations are managed in Content > Projects.'),
                ]),
        ];
    }
}
