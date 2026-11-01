<?php

declare(strict_types=1);

namespace App\Support\SectionTypes;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class AboutSectionType extends BaseSectionType
{
    public static function getKey(): string
    {
        return 'about';
    }

    public static function getLabel(): string
    {
        return 'About the Company';
    }

    public static function getIcon(): string
    {
        return 'heroicon-o-information-circle';
    }

    public static function getDefaultContent(): array
    {
        return [
            'story_intro' => 'Tnila began with a simple idea: clients deserve construction partners who are as organized as they are capable.',
            'mission' => 'To deliver residential, commercial, industrial, and infrastructure builds with disciplined craftsmanship, transparent scheduling, and zero guesswork.',
            'vision' => 'To be the most trusted construction delivery firm in East Africa, setting benchmarks for structural integrity and client clarity.',
            'story' => '<p>Tnila was established to eliminate construction uncertainty. By combining experienced field engineers with modern project coordination, we ensure that every milestone is documented, every procurement step is transparent, and every site handover meets uncompromising standards.</p>',
            'images' => [],
            'values' => [
                ['icon' => 'heroicon-o-shield-check', 'title' => 'Structural Integrity', 'text' => 'We adhere to the strictest engineering tolerances, quality testing, and safety protocols.'],
                ['icon' => 'heroicon-o-clock', 'title' => 'On-Schedule Delivery', 'text' => 'Rigorous milestone tracking keeps trades aligned and handovers on time.'],
                ['icon' => 'heroicon-o-chat-bubble-left-right', 'title' => 'Calm Communication', 'text' => 'Weekly progress photos, transparent cost accounting, and dedicated project managers.'],
            ],
            'buttons' => [
                ['label' => 'Explore Our Story', 'link_type' => 'url', 'target' => null, 'url' => '/about', 'style' => 'primary'],
            ],
        ];
    }

    public static function formSchema(): array
    {
        return [
            Section::make('Company Identity & Narrative')
                ->description('Describe the company origin, story, and execution standards.')
                ->schema([
                    Textarea::make('content.story_intro')
                        ->label('Story Intro Blurb')
                        ->rows(2)
                        ->placeholder('Introductory summary of the company vision...'),

                    RichEditor::make('content.story')
                        ->label('Full Company Story')
                        ->helperText('Detailed background on company foundation, growth, and methodology.'),

                    FileUpload::make('content.images')
                        ->label('Showcase Photos')
                        ->disk('public')
                        ->directory('sections/about')
                        ->image()
                        ->imageEditor()
                        ->multiple()
                        ->maxFiles(6)
                        ->maxSize(5120)
                        ->helperText('Photography showcasing project teams, blueprints, and completed spaces.'),
                ]),

            Section::make('Mission & Vision')
                ->schema([
                    Grid::make(2)->schema([
                        Textarea::make('content.mission')
                            ->label('Mission Statement')
                            ->rows(3)
                            ->placeholder('Our mission is to...')
                            ->helperText('Guiding operational mission.'),

                        Textarea::make('content.vision')
                            ->label('Vision Statement')
                            ->rows(3)
                            ->placeholder('Our vision is...')
                            ->helperText('Long-term company aspiration.'),
                    ]),
                ]),

            Section::make('Core Values')
                ->description('List the core principles that define company craftsmanship.')
                ->schema([
                    Repeater::make('content.values')
                        ->label('Core Values')
                        ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                        ->reorderable()
                        ->collapsible()
                        ->schema([
                            Grid::make(3)->schema([
                                TextInput::make('icon')
                                    ->label('Heroicon Name')
                                    ->placeholder('heroicon-o-shield-check'),

                                TextInput::make('title')
                                    ->label('Value Title')
                                    ->placeholder('e.g. Structural Integrity')
                                    ->required(),

                                TextInput::make('text')
                                    ->label('Explanation')
                                    ->placeholder('Short description of this value...')
                                    ->columnSpan(2),
                            ]),
                        ]),
                ]),

            static::buttonRepeater('content.buttons', 'About Section Buttons'),
        ];
    }
}
