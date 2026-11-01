<?php

declare(strict_types=1);

namespace App\Filament\Resources\PageSectionResource\Pages;

use App\Filament\Resources\PageSectionResource;
use App\Models\PageSection;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageSection extends EditRecord
{
    protected static string $resource = PageSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->hidden(fn (PageSection $record): bool => in_array($record->key, PageSectionResource::CORE_KEYS, true)),
        ];
    }
}
