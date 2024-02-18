<?php

namespace App\Models\Tracking;

use App\Models\Roles\Contracts\Teamable;
use App\Models\Roles\Traits\HasTeam;
use App\Models\Tracking\Traits\Assignable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model implements Teamable
{
    use HasFactory;
    use HasUuids;
    use HasTeam;
    use Assignable;

    protected $fillable = [
        'name',
        'description',
        'estimate',
        'start_date',
        'end_date',
        'team_id',
        'assigned_to_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'estimate' => 'float'
    ];

    /**
     * Time Logs
     */
    public function timeLogs(): HasMany
    {
        return $this->hasMany(TimeLog::class);
    }
}
