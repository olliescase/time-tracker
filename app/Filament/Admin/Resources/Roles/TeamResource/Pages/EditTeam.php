<?php

namespace App\Filament\Admin\Resources\Roles\TeamResource\Pages;

use App\Filament\Admin\Resources\Roles\TeamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeam extends EditRecord
{
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
