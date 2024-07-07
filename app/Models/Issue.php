<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_id',
        'id_within_space',
        'rank',
        'title',
        'status',
        'deadline_at',
        'done_at',
        'description',
    ];

    protected $appends = [
        'code'
    ];

    public function getRouteKeyName(): string
    {
        return 'code';
    }

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }

    public function getCodeAttribute(): string
    {
        return $this->space->code . "-" . $this->id_within_space;
    }
}
