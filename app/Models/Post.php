<?php

namespace App\Models;

use App\Filament\Resources\PostResource;
use Database\Factories\PostFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 *
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property array<array-key, mixed>|null $content
 * @property int|null $image_id
 * @property int $user_id
 * @property bool $is_published
 * @property Carbon|null $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read object $blocks
 * @property-read string $edit_url
 * @property-read string $excerpt
 * @property-read string $url
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read Media|null $image
 * @property-read User $user
 * @method static Builder<static>|Post drafts()
 * @method static PostFactory factory($count = null, $state = [])
 * @method static Builder<static>|Post newModelQuery()
 * @method static Builder<static>|Post newQuery()
 * @method static Builder<static>|Post published()
 * @method static Builder<static>|Post query()
 * @method static Builder<static>|Post whereContent($value)
 * @method static Builder<static>|Post whereCreatedAt($value)
 * @method static Builder<static>|Post whereId($value)
 * @method static Builder<static>|Post whereImageId($value)
 * @method static Builder<static>|Post whereIsPublished($value)
 * @method static Builder<static>|Post wherePublishedAt($value)
 * @method static Builder<static>|Post whereSlug($value)
 * @method static Builder<static>|Post whereTitle($value)
 * @method static Builder<static>|Post whereUpdatedAt($value)
 * @method static Builder<static>|Post whereUserId($value)
 * @mixin Eloquent
 */
class Post extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'slug',
		'content',
		'image_id',
		'user_id',
		'is_published',
		'published_at',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array
	 */
	protected $casts = [
		'content' => 'array',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
		'is_published' => 'boolean',
		'published_at' => 'datetime',
	];

	/**
	 * Get the user that owns the post.
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Get the featured image for the post.
	 */
	public function image(): BelongsTo
	{
		return $this->belongsTo(Media::class);
	}

	/**
	 * Retrieve the post URL.
	 */
	public function getUrlAttribute(): string
	{
		return route('post.show', $this);
	}

	/**
	 * Retrieve the post edit URL.
	 */
	public function getEditUrlAttribute(): string
	{
		return PostResource::getUrl('edit', ['record' => $this]);
	}

	/**
	 * Retrieve the post content blocks as an object.
	 */
	public function getBlocksAttribute(): object
	{
		return json_decode(
			collect($this->content ?? [])->toJson()
		);
	}

	/**
	 * Retrieve the post excerpt.
	 */
	public function getExcerptAttribute(): string
	{
		$excerpt = collect($this->content)
			->firstWhere('type', 'markdown') ?? [];

		$excerpt = collect(
			explode("\n", Arr::get($excerpt, 'data.content', ''))
		)->first();

		return Str::limit($excerpt, 160);
	}

	/**
	 * Retrieve the published posts.
	 */
	public function scopePublished(Builder $query): Builder
	{
		return $query->where('is_published', true);
	}

	/**
	 * Retrieve the draft posts.
	 */
	public function scopeDrafts(Builder $query): Builder
	{
		return $query->where('is_published', false);
	}

	/**
	 * Mark the post as published.
	 */
	public function publish(): bool
	{
		return $this->update([
			'is_published' => true,
			'published_at' => now(),
		]);
	}

	/**
	 * Mark the post as unpublished.
	 */
	public function unpublish(): bool
	{
		return $this->update([
			'is_published' => false,
			'published_at' => null,
		]);
	}
}
