<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject', 'isPublic', 'isCommentable',
    ];

    public function owner(): BelongsTo //TODO: This should probably be concern, owner needs to be a user.
    {
        return $this->belongsTo(Concern::class);
    }
}
