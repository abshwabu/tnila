<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\PageSection;
use Filament\Widgets\Widget;

class QuickLinksWidget extends Widget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected static string $view = 'filament.widgets.quick-links-widget';

    protected int|string|array $columnSpan = 'full';

    /**
     * Resolve the edit URL for the hero section.
     */
    public function getHeroEditUrl(): string
    {
        $hero = PageSection::query()->where('key', 'hero')->first();

        return $hero !== null
            ? route('filament.admin.resources.page-sections.edit', ['record' => $hero->id])
            : route('filament.admin.resources.page-sections.index');
    }

    /**
     * Resolve the site settings URL.
     */
    public function getSiteSettingsUrl(): string
    {
        return route('filament.admin.pages.site-settings');
    }

    /**
     * Resolve the page sections manager URL.
     */
    public function getPageSectionsUrl(): string
    {
        return route('filament.admin.resources.page-sections.index');
    }

    /**
     * Resolve the projects resource URL.
     */
    public function getProjectsUrl(): string
    {
        return route('filament.admin.resources.projects.index');
    }

    /**
     * Resolve the services resource URL.
     */
    public function getServicesUrl(): string
    {
        return route('filament.admin.resources.services.index');
    }
}
