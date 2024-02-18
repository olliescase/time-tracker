<?php

namespace App\Filament\Admin\Resources\Roles\PermissionResource\Pages;

use App\Filament\Admin\Resources\Roles\PermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermission extends EditRecord
{
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
