<?php

declare(strict_types=1);

namespace App\Support\SectionTypes;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class BlogSectionType extends BaseSectionType
{
    public static function getKey(): string
    {
        return 'blog';
    }

    public static function getLabel(): string
    {
        return 'Recent News & Articles';
    }

    public static function getIcon(): string
    {
        return 'heroicon-o-newspaper';
    }

    public static function getDefaultContent(): array
    {
        return [
            'intro' => 'Recent thinking, construction tips, code compliance, and company updates.',
            'items_count' => 3,
            'view_all_label' => 'Read all posts →',
            'buttons' => [
                ['label' => 'Visit Construction Blog', 'link_type' => 'url', 'target' => null, 'url' => '/blog', 'style' => 'primary'],
            ],
        ];
    }

    public static function formSchema(): array
    {
        return [
            Section::make('Articles Display Configuration')
                ->schema([
                    Textarea::make('content.intro')
                        ->label('Section Intro Copy')
                        ->rows(2)
                        ->placeholder('Introductory copy describing news and guides...'),

                    Grid::make(2)->schema([
                        TextInput::make('content.items_count')
                            ->label('Max Articles to Show')
                            ->numeric()
                            ->default(3)
                            ->helperText('Number of published blog posts shown on the home page.'),

                        TextInput::make('content.view_all_label')
                            ->label('View All Link Text')
                            ->default('Read all posts →'),
                    ]),

                    static::buttonRepeater('content.buttons', 'Blog Action Buttons'),

                    Placeholder::make('management_note')
                        ->label('Article Management')
                        ->content('Articles, cover images, slugs, and publishing statuses are managed in Content > Blog Posts.'),
                ]),
        ];
    }
}
