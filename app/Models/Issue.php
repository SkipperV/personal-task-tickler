<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_id',
        'id_within_space',
        'rank',
        'title',
        'status_id',
        'deadline_at',
        'done_at',
        'description',
    ];

    protected $hidden = [
        'status_id'
    ];

    protected $appends = [
        'code',
        'status'
    ];

    public function getRouteKeyName(): string
    {
        return 'code';
    }

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(IssueStatus::class);
    }

    public function getCodeAttribute(): string
    {
        return $this->space->code . "-" . $this->id_within_space;
    }

    public function getStatusAttribute(): string
    {
        return $this->status->name;
    }

    public function blockedBy(): BelongsToMany|bool
    {
        return $this->belongsToMany(Issue::class, 'issue_relations', 'child_issue_id', 'parent_issue_id')
            ->withPivot('relationship_type')
            ->wherePivot('relationship_type', 'Blocked by')
            ?? false;
    }

    public function isBlocking(): BelongsToMany|bool
    {
        return $this->belongsToMany(Issue::class, 'issue_relations', 'parent_issue_id', 'child_issue_id')
            ->withPivot('relationship_type')
            ->wherePivot('relationship_type', 'Blocked by')
            ?? false;
    }

    public function segmentedBy(): BelongsToMany|bool
    {
        return $this->belongsToMany(Issue::class, 'issue_relations', 'child_issue_id', 'parent_issue_id')
            ->withPivot('relationship_type')
            ->wherePivot('relationship_type', 'Segmented by')
            ?? false;
    }

    public function segmentOf(): BelongsToMany|bool
    {
        return $this->belongsToMany(Issue::class, 'issue_relations', 'parent_issue_id', 'child_issue_id')
            ->withPivot('relationship_type')
            ->wherePivot('relationship_type', 'Segment of')
            ?? false;
    }
}
