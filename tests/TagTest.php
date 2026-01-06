<?php

use SourcedOpen\Tags\Models\Tag;

it('can create a tag', function () {
    $tag = Tag::create([
        'name' => 'Laravel',
        'color' => '#FF2D20',
    ]);

    expect($tag->name)->toBe('Laravel')
        ->and($tag->color)->toBe('#FF2D20');
});

it('can create a tag with only name', function () {
    $tag = Tag::create([
        'name' => 'PHP',
    ]);

    expect($tag->name)->toBe('PHP')
        ->and($tag->color)->toBeNull();
});

it('can update a tag', function () {
    $tag = Tag::create([
        'name' => 'Old Name',
        'color' => '#000000',
    ]);

    $tag->update([
        'name' => 'New Name',
        'color' => '#FFFFFF',
    ]);

    expect($tag->fresh()->name)->toBe('New Name')
        ->and($tag->fresh()->color)->toBe('#FFFFFF');
});

it('can delete a tag', function () {
    $tag = Tag::create([
        'name' => 'Deletable',
        'color' => '#123456',
    ]);

    $tagId = $tag->id;
    $tag->delete();

    expect(Tag::find($tagId))->toBeNull();
});

it('has fillable attributes', function () {
    $tag = new Tag;

    expect($tag->getFillable())->toBe(['name', 'color']);
});
