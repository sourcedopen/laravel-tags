<?php

namespace Sourcedopen\Tags\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'color',
    ];

    /**
     * Get all of the models that are assigned this tag.
     */
    public function taggables(string $model): MorphToMany
    {
        return $this->morphedByMany($model, 'taggable');
    }
}
