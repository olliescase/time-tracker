<?php

namespace App\Models\Tracking\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Assignable
{
    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
