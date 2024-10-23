<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpaceSetting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'archive_delay',
        'show_open_tasks_on_top',
        'show_closed_tasks_on_bottom',
        'collapse_subtasks',
        'hide_from_global_search',
    ];

    protected $casts = [
        'show_open_tasks_on_top' => 'boolean',
        'show_closed_tasks_on_bottom' => 'boolean',
        'collapse_subtasks' => 'boolean',
    ];

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class, 'id');
    }
}
