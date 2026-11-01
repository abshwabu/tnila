<?php

declare(strict_types=1);

namespace App\Support\SectionTypes;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class FaqSectionType extends BaseSectionType
{
    public static function getKey(): string
    {
        return 'faq';
    }

    public static function getLabel(): string
    {
        return 'Frequently Asked Questions';
    }

    public static function getIcon(): string
    {
        return 'heroicon-o-question-mark-circle';
    }

    public static function getDefaultContent(): array
    {
        return [
            'intro' => 'Clear answers on project estimations, permits, warranties, and construction timelines.',
            'show_contact_card' => true,
            'contact_card_text' => 'Still have questions? Our engineering desk is here to help.',
            'items_count' => 6,
            'buttons' => [
                ['label' => 'Ask a Question', 'link_type' => 'url', 'target' => null, 'url' => '/contact', 'style' => 'primary'],
            ],
        ];
    }

    public static function formSchema(): array
    {
        return [
            Section::make('FAQs Configuration')
                ->schema([
                    Textarea::make('content.intro')
                        ->label('Section Intro Copy')
                        ->rows(2)
                        ->placeholder('Introductory copy describing common questions...'),

                    Grid::make(3)->schema([
                        TextInput::make('content.items_count')
                            ->label('Max FAQs to Show')
                            ->numeric()
                            ->default(6),

                        Toggle::make('content.show_contact_card')
                            ->label('Show Still Have Questions Prompt')
                            ->default(true),

                        TextInput::make('content.contact_card_text')
                            ->label('Prompt Card Text')
                            ->default('Still have questions? Our engineering desk is here to help.'),
                    ]),

                    static::buttonRepeater('content.buttons', 'FAQ Action Buttons'),

                    Placeholder::make('management_note')
                        ->label('FAQ Management')
                        ->content('FAQ questions, detailed answers, categories, and display orders are managed in Content > FAQs.'),
                ]),
        ];
    }
}
