<?php

declare(strict_types=1);

namespace App\Support\SectionTypes;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class HeroSectionType extends BaseSectionType
{
    public static function getKey(): string
    {
        return 'hero';
    }

    public static function getLabel(): string
    {
        return 'Hero (Main Introduction)';
    }

    public static function getIcon(): string
    {
        return 'heroicon-o-home';
    }

    public static function getDefaultContent(): array
    {
        return [
            'headline' => 'Build with a team that keeps the process calm, clear, and on schedule.',
            'subheadline' => 'From residential homes to industrial works, we help clients shape projects that feel well planned from the first conversation to handover.',
            'video_url' => null,
            'background_image' => null,
            'stat_chips' => [
                ['value' => '50+', 'label' => 'Projects Delivered', 'icon' => 'heroicon-o-check-badge'],
                ['value' => '4', 'label' => 'Core Sectors', 'icon' => 'heroicon-o-building-office-2'],
                ['value' => '24h', 'label' => 'Response Window', 'icon' => 'heroicon-o-clock'],
            ],
            'collage_images' => [],
            'buttons' => [
                ['label' => 'Get a quote', 'link_type' => 'url', 'target' => null, 'url' => '/contact', 'style' => 'primary'],
                ['label' => 'View projects', 'link_type' => 'url', 'target' => null, 'url' => '/projects', 'style' => 'ghost'],
            ],
        ];
    }

    public static function formSchema(): array
    {
        return [
            Section::make('Hero Media & Visuals')
                ->description('Configure hero background imagery, showcase photography, and video.')
                ->schema([
                    Grid::make(2)->schema([
                        FileUpload::make('content.background_image')
                            ->label('Hero Background Image')
                            ->disk('public')
                            ->directory('sections/hero')
                            ->image()
                            ->maxSize(5120)
                            ->helperText('Large hero banner image (recommended 1920x1080).'),

                        TextInput::make('content.video_url')
                            ->label('Background / Showcase Video URL')
                            ->placeholder('https://www.youtube.com/watch?v=... or direct MP4 link')
                            ->url()
                            ->helperText('Optional video embed or link shown in the hero section.'),
                    ]),

                    FileUpload::make('content.collage_images')
                        ->label('Image Collage (Up to 4 Images)')
                        ->disk('public')
                        ->directory('sections/hero/collage')
                        ->image()
                        ->multiple()
                        ->maxFiles(4)
                        ->maxSize(5120)
                        ->helperText('Visual photo collage showcasing real construction sites and delivered buildings.'),
                ]),

            Section::make('Hero Content & Headlines')
                ->schema([
                    TextInput::make('content.headline')
                        ->label('Hero Headline')
                        ->placeholder('Build with a team that keeps the process calm, clear, and on schedule.')
                        ->helperText('High-impact title displayed prominently at the very top of the page.'),

                    Textarea::make('content.subheadline')
                        ->label('Hero Subheadline')
                        ->rows(3)
                        ->placeholder('From residential homes to industrial works, we help clients shape projects...')
                        ->helperText('Clear subtitle explaining the construction approach and client guarantee.'),

                    static::buttonRepeater('content.buttons', 'Hero Action Buttons'),
                ]),

            Section::make('Floating Stat Chips')
                ->description('Highlight chips showing key metrics in the hero area.')
                ->schema([
                    Repeater::make('content.stat_chips')
                        ->label('Stat Chips')
                        ->itemLabel(fn (array $state): ?string => isset($state['value']) ? "{$state['value']} — ".($state['label'] ?? '') : null)
                        ->reorderable()
                        ->collapsible()
                        ->schema([
                            Grid::make(3)->schema([
                                TextInput::make('value')
                                    ->label('Metric / Value')
                                    ->nullable()
                                    ->placeholder('e.g. 50+'),

                                TextInput::make('label')
                                    ->label('Label')
                                    ->nullable()
                                    ->placeholder('e.g. Projects Delivered'),

                                TextInput::make('icon')
                                    ->label('Heroicon Name')
                                    ->placeholder('e.g. heroicon-o-check-badge')
                                    ->helperText('Valid Heroicon name.'),
                            ]),
                        ]),
                ]),
        ];
    }
}
