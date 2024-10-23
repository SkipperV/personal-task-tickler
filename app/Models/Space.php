<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Response;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'code',
        'slug',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        try {
            return $this->where('user_id', request()->user()->id)
                ->where('slug', $value)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return response()->abort(Response::HTTP_NOT_FOUND, 'Space not found.');
        }
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function settings(): HasOne
    {
        return $this->hasOne(SpaceSetting::class, 'id');
    }

    public function taskStatuses(): HasMany
    {
        return $this->hasMany(TaskStatus::class);
    }

    public function taskRelationTypes(): HasMany
    {
        return $this->hasMany(TaskRelationType::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function latestTaskCode(): string
    {
        return $this->hasOne(Task::class)->latestOfMany('code')->first()->code;
    }
}
