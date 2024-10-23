<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskRelationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'inward_name',
        'outward_name',
    ];

    private function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }
}
