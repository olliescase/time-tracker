<?php

namespace App\Models\Roles;

use App\Models\Roles\Contracts\NotPermissable;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Permission extends Model implements NotPermissable
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name',
        'node'
    ];

    /**
     * The roles that this permission relates to
     *
     * @return BelongsToMany<Role>
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
