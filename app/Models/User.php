<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'organization_id',
        'personalID'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->BelongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->BelongsToMany(Permission::class);
    }

    public function logs()
    {
        return $this->BelongsToMany(Log::class);
    }

    public function histories()
    {
        return $this->BelongsToMany(History::class);
    }

    public function organization()
    {
        return $this->BelongsTo(Organization::class);
    }

    public function hasPermission($permission)
    {
        return $this->permissions->contains('title',$permission->title) || $this->hasRole($permission->roles);
    }

    public function hasRole($roles)
    {
        return !! $roles->intersect($this->roles)->all();
    }
}
