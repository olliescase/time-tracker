<?php

namespace App\Filament\Admin\Resources\Roles\PermissionResource\Pages;

use App\Filament\Admin\Resources\Roles\PermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;
}
