<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'isPublic',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function publicStatus(): HasMany
    {
        return $this->hasMany(Concern::class);
    }

    public function privateStatus(): HasMany
    {
        return $this->hasMany(Concern::class);
    }
}
