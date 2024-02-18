<?php

namespace App\Models\Roles\Contracts;

use App\Models\Roles\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Contract for permissionable objects
 */
interface Teamable
{
    /**
     * The team the entity belongs to
     *
     * @return BelongsTo<Team>
     */
    public function team(): BelongsTo;
}
