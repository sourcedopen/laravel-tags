<?php

namespace SourcedOpen\Tags\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use SourcedOpen\Tags\Models\Tag;

trait HasTags
{
    /**
     * Get all of the tags for the model.
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Attach tags to the model.
     */
    public function attachTags(array|int $tagIds): void
    {
        $this->tags()->attach($tagIds);
    }

    /**
     * Detach tags from the model.
     */
    public function detachTags(array|int $tagIds): void
    {
        $this->tags()->detach($tagIds);
    }

    /**
     * Sync tags for the model.
     */
    public function syncTags(array $tagIds): void
    {
        $this->tags()->sync($tagIds);
    }
}
