<?php

namespace App\Models\Roles\Contracts;

use App\Models\Roles\Team;

/**
 * Contract for permissionable objects
 */
interface AuthorizesTeams
{
    public function hasTeam(Team $team): bool;
}
