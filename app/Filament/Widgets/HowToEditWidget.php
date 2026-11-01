<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class HowToEditWidget extends Widget
{
    protected static ?int $sort = 2;

    protected static bool $isLazy = false;

    protected static string $view = 'filament.widgets.how-to-edit-widget';

    protected int|string|array $columnSpan = 'full';
}
