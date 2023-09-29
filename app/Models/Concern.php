<?php

namespace App\Models;

use App\Models\User;
use App\Models\JournalEntry;
use App\Events\ConcernCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Concern extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'message',
        'recipient_email',
    ];

    protected $dispatchesEvents = [
        'created' => ConcernCreated::class,
    ];

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function journalEntry(): HasMany
    {
        return $this->hasMany(JournalEntry::class);
    }
}
