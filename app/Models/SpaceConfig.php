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
        'show_subtasks',
        'hide_all_tasks_from_global_search',
        'hide_archived_from_global_search'
    ];

    protected $casts = [
        'put_in_progress_to_the_beginning' => 'boolean',
        'put_done_to_the_end' => 'boolean',
        'show_subtasks' => 'boolean',
        'hide_all_tasks_from_global_search' => 'boolean',
        'hide_archived_from_global_search' => 'boolean'
    ];

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }
}
