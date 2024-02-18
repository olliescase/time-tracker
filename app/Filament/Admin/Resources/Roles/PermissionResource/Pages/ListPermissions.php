<?php

namespace App\Filament\Admin\Resources\Roles\PermissionResource\Pages;

use App\Filament\Admin\Resources\Roles\PermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermissions extends ListRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
