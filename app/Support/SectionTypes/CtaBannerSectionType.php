<?php

declare(strict_types=1);

namespace App\Support\SectionTypes;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class CtaBannerSectionType extends BaseSectionType
{
    public static function getKey(): string
    {
        return 'cta_banner';
    }

    public static function getLabel(): string
    {
        return 'Call-to-Action Banner (Highlight Strip)';
    }

    public static function getIcon(): string
    {
        return 'heroicon-o-megaphone';
    }

    public static function getDefaultContent(): array
    {
        return [
            'badge_text' => "Let's build",
            'heading' => 'Ready to start your project?',
            'text' => 'Tell us what you are planning and we will help shape the next step.',
            'primary_label' => 'Get a quote',
            'primary_url' => '/contact',
            'secondary_label' => 'Start your project',
            'secondary_url' => '/services',
            'buttons' => [
                ['label' => 'Get a quote', 'link_type' => 'url', 'target' => null, 'url' => '/contact', 'style' => 'primary'],
                ['label' => 'Explore services', 'link_type' => 'url', 'target' => null, 'url' => '/services', 'style' => 'ghost'],
            ],
        ];
    }

    public static function formSchema(): array
    {
        return [
            Section::make('Call-to-Action Messaging')
                ->schema([
                    TextInput::make('content.badge_text')
                        ->label('Banner Eyebrow Badge')
                        ->placeholder("e.g. Let's build")
                        ->helperText('Accent badge displayed above the main heading.'),

                    TextInput::make('content.heading')
                        ->label('Banner Headline')
                        ->placeholder('Ready to start your project?')
                        ->nullable()
                        ->helperText('Prominent title displayed in large typography.'),

                    Textarea::make('content.text')
                        ->label('Banner Subtext / Description')
                        ->rows(3)
                        ->placeholder('Tell us what you are planning and we will help shape the next step...')
                        ->helperText('Supporting sentence inspiring client action.'),

                    Grid::make(2)->schema([
                        TextInput::make('content.primary_label')
                            ->label('Primary Button Label')
                            ->default('Get a quote'),

                        TextInput::make('content.primary_url')
                            ->label('Primary Button URL')
                            ->default('/contact'),

                        TextInput::make('content.secondary_label')
                            ->label('Secondary Button Label')
                            ->default('Start your project'),

                        TextInput::make('content.secondary_url')
                            ->label('Secondary Button URL')
                            ->default('/services'),
                    ]),

                    static::buttonRepeater('content.buttons', 'Custom Banner Action Buttons'),
                ]),
        ];
    }
}
