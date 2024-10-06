<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'position',
        'code',
        'slug',
    ];

    protected $with = [
        'settings',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        try {
            return $this->where('user_id', request()->user()->id)
                ->where('slug', $value)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return abort(404, 'Space not found.');
        }
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function settings(): HasOne
    {
        return $this->hasOne(SpaceSetting::class);
    }

    public function allTasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function tasks(): HasMany
    {
        return $this->allTasks()->where('is_archived', false);
    }

    public function archivedTasks(): HasMany
    {
        return $this->allTasks()->where('is_archived', true);
    }

    public function latestTaskCode(): string
    {
        return $this->hasOne(Task::class)->latestOfMany('code')->first()->code;
    }
}
