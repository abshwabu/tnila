<?php

declare(strict_types=1);

namespace App\Support\SectionTypes;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class TestimonialsSectionType extends BaseSectionType
{
    public static function getKey(): string
    {
        return 'testimonials';
    }

    public static function getLabel(): string
    {
        return 'Client Reviews & Testimonials';
    }

    public static function getIcon(): string
    {
        return 'heroicon-o-chat-bubble-bottom-center-text';
    }

    public static function getDefaultContent(): array
    {
        return [
            'intro' => 'Trusted by developers, homeowners, and public leaders for calm execution and clear communication.',
            'layout' => 'carousel',
            'show_rating_stars' => true,
            'buttons' => [],
        ];
    }

    public static function formSchema(): array
    {
        return [
            Section::make('Testimonials Configuration')
                ->schema([
                    Textarea::make('content.intro')
                        ->label('Section Intro Copy')
                        ->rows(2)
                        ->placeholder('Introductory copy highlighting client trust...'),

                    Grid::make(2)->schema([
                        Select::make('content.layout')
                            ->label('Display Mode')
                            ->options([
                                'carousel' => 'Livewire Carousel / Slider',
                                'grid' => 'Static 3-Column Card Grid',
                            ])
                            ->default('carousel'),

                        Toggle::make('content.show_rating_stars')
                            ->label('Show 5-Star Rating Indicators')
                            ->default(true),
                    ]),

                    static::buttonRepeater('content.buttons', 'Section Action Buttons'),

                    Placeholder::make('management_note')
                        ->label('Review Management')
                        ->content('Individual client quotes, customer names, project affiliations, and approvals are managed in CRM > Testimonials.'),
                ]),
        ];
    }
}
