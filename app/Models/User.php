<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'password_set_by_user',
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
        'password' => 'hashed',
    ];

    public function concernReported(): HasMany
    {
        return $this->hasMany(Concern::class, 'reporter_id');
    }

    public function concernOwned(): HasMany
    {
        return $this->hasMany(Concern::class, 'owner_id');
    }

    public function tagOwned(): HasMany
    {
        return $this->hasMany(Concern::class, 'owner_id');
    }

    public function statusOwned(): HasMany
    {
        return $this->hasMany(Concern::class, 'owner_id');
    }
}
