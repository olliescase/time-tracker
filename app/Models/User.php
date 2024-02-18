<?php

namespace App\Models;

use App\Models\Roles\Contracts\AuthorizesPermissions;
use App\Models\Roles\Contracts\AuthorizesTeams;
use App\Models\Roles\Permission;
use App\Models\Roles\Role;
use App\Models\Roles\Team;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements AuthorizesTeams, AuthorizesPermissions, FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasUuids;
    use MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_super_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'verified_email'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Check if the user is a super admin
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin;
    }
    /**
     * Roles the entity has
     *
     * @return BelongsToMany<Role>
     */
    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    /**
     * Roles the entity has
     *
     * @return BelongsToMany<Role>
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Check if the entity has the given permission node
     *
     * @param string $node
     *
     * @return bool
     */
    public function hasPermission(Permission $permission): bool
    {
        return $this->roles()->whereHas('permissions', fn (Builder $subQuery) => $subQuery->where('node', $permission->node))->exists();
    }

    /**
     * Check if the entity has the given permission node
     *
     * @param Team $team
     *
     * @return bool
     */
    public function hasTeam(Team $team): bool
    {
        return !empty($this->teams()->find($team->id));
    }

    public function verifiedEmail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->hasVerifiedEmail(),
            set: fn (bool $value) => ['email_verified_at' => $value ? now() : null]
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->isSuperAdmin(),
            default => $this->hasVerifiedEmail(),
        };
    }
}
