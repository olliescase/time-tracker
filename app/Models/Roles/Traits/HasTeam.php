<?php

namespace App\Models\Roles\Traits;

use App\Models\Roles\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTeam
{
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function scopeTeam(Builder $query, Team $team): Builder
    {
        return $query->whereHas('teams', fn (Builder $teamQuery) => $teamQuery->where('id', $team->id));
    }

    public function scopeTeams(Builder $query, Collection $teams): Builder
    {
        return $query->whereHas('teams', fn (Builder $teamQuery) => $teamQuery->whereIn('id', $teams->pluck('id')));
    }
}
