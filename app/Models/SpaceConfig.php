<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpaceConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'archive_delay',
        'put_in_progress_to_the_beginning',
        'put_done_to_the_end',
        'show_issue_segments'
    ];

    protected $casts = [
        'put_in_progress_to_the_beginning' => 'boolean',
        'put_done_to_the_end' => 'boolean',
        'show_issue_segments' => 'boolean'
    ];

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }
}
