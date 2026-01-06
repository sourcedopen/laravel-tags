# Tags

A Laravel package for adding tags to Eloquent models using polymorphic relationships.

## Installation

You can install the package via Composer:

```bash
composer require sourcedopen/tags
```

The package will automatically register its service provider.

## Configuration

Publish and run the migrations:

```bash
php artisan vendor:publish --tag="tags-migrations"
php artisan migrate
```

## Usage

### Adding Tags to a Model

Use the `HasTags` trait in any model you want to be taggable:

```php
use Illuminate\Database\Eloquent\Model;
use SourcedOpen\Tags\Traits\HasTags;

class Post extends Model
{
    use HasTags;
}
```

### Creating Tags

```php
use SourcedOpen\Tags\Models\Tag;

$tag = Tag::create([
    'name' => 'Laravel',
    'color' => '#FF2D20', // Optional hex color code
]);
```

### Attaching Tags

```php
// Attach a single tag
$post->attachTags($tag->id);

// Attach multiple tags
$post->attachTags([$tag1->id, $tag2->id]);
```

### Detaching Tags

```php
// Detach a single tag
$post->detachTags($tag->id);

// Detach multiple tags
$post->detachTags([$tag1->id, $tag2->id]);
```

### Syncing Tags

```php
// Sync tags (removes all existing and attaches the provided ones)
$post->syncTags([$tag1->id, $tag2->id]);
```

### Retrieving Tags

```php
// Get all tags for a model
$tags = $post->tags;

// Query with tags
$posts = Post::whereHas('tags', function ($query) {
    $query->where('name', 'Laravel');
})->get();
```

## Testing

```bash
composer test
```

Or run Pest directly:

```bash
./vendor/bin/pest
```

## Code Style

This package uses Laravel Pint for code styling:

```bash
./vendor/bin/pint
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

