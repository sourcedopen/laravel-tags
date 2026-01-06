<?php

use SourcedOpen\Tags\Models\Tag;
use SourcedOpen\Tags\Tests\Post;

it('can attach tags to a model', function () {
    $post = Post::create(['title' => 'Test Post']);
    $tag = Tag::create(['name' => 'Laravel', 'color' => '#FF2D20']);

    $post->attachTags($tag->id);

    expect($post->tags)->toHaveCount(1)
        ->and($post->tags->first()->name)->toBe('Laravel');
});

it('can attach multiple tags to a model', function () {
    $post = Post::create(['title' => 'Test Post']);
    $tag1 = Tag::create(['name' => 'Laravel', 'color' => '#FF2D20']);
    $tag2 = Tag::create(['name' => 'PHP', 'color' => '#777BB4']);

    $post->attachTags([$tag1->id, $tag2->id]);

    expect($post->tags)->toHaveCount(2);
});

it('can detach tags from a model', function () {
    $post = Post::create(['title' => 'Test Post']);
    $tag1 = Tag::create(['name' => 'Laravel', 'color' => '#FF2D20']);
    $tag2 = Tag::create(['name' => 'PHP', 'color' => '#777BB4']);

    $post->attachTags([$tag1->id, $tag2->id]);
    $post->detachTags($tag1->id);

    expect($post->fresh()->tags)->toHaveCount(1)
        ->and($post->fresh()->tags->first()->name)->toBe('PHP');
});

it('can sync tags for a model', function () {
    $post = Post::create(['title' => 'Test Post']);
    $tag1 = Tag::create(['name' => 'Laravel', 'color' => '#FF2D20']);
    $tag2 = Tag::create(['name' => 'PHP', 'color' => '#777BB4']);
    $tag3 = Tag::create(['name' => 'Vue', 'color' => '#42B883']);

    $post->attachTags([$tag1->id, $tag2->id]);
    $post->syncTags([$tag2->id, $tag3->id]);

    $tagNames = $post->fresh()->tags->pluck('name')->toArray();

    expect($tagNames)->toContain('PHP')
        ->and($tagNames)->toContain('Vue')
        ->and($tagNames)->not->toContain('Laravel');
});

it('can get tags relationship', function () {
    $post = Post::create(['title' => 'Test Post']);

    expect($post->tags())->toBeInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class);
});

it('deleting tag removes pivot entries', function () {
    $post = Post::create(['title' => 'Test Post']);
    $tag = Tag::create(['name' => 'Laravel', 'color' => '#FF2D20']);

    $post->attachTags($tag->id);

    expect($post->tags)->toHaveCount(1);

    $tag->delete();

    expect($post->fresh()->tags)->toHaveCount(0);
});
