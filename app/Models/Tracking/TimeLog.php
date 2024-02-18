<?php

namespace App\Models\Tracking;

use App\Models\Roles\Contracts\Teamable;
use App\Models\Roles\Traits\HasTeam;
use App\Models\Tracking\Traits\Assignable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Time Log
 */
class TimeLog extends Model implements Teamable
{
    use HasFactory;
    use HasUuids;
    use HasTeam;
    use Assignable;

    protected $fillable = [
        'starts_at',
        'ends_at',
        'time'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    /**
     * Generate the name attribute
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn () => sprintf(
                '[%s] %s %s - %s',
                $this->task->name,
                $this->assignedTo->name,
                $this->starts_at->format('Y-m-d H:i:s'),
                $this->ends_at->format('Y-m-d H:i:s')
            )
        );
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
