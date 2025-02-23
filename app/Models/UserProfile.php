<?php

namespace App\Models;

use Database\Factories\UserProfileFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string $discord_id
 * @property string|null $minecraft_id
 * @property string|null $minecraft_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read User|null $user
 * @method static Builder<static>|UserProfile newModelQuery()
 * @method static Builder<static>|UserProfile newQuery()
 * @method static Builder<static>|UserProfile query()
 * @method static Builder<static>|UserProfile whereCreatedAt($value)
 * @method static Builder<static>|UserProfile whereDiscordId($value)
 * @method static Builder<static>|UserProfile whereId($value)
 * @method static Builder<static>|UserProfile whereMinecraftId($value)
 * @method static Builder<static>|UserProfile whereMinecraftName($value)
 * @method static Builder<static>|UserProfile whereUpdatedAt($value)
 * @method static Builder<static>|UserProfile whereUserId($value)
 * @method static UserProfileFactory factory($count = null, $state = [])
 * @mixin Eloquent
 */
class UserProfile extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'discord_id',
		'minecraft_id',
		'minecraft_name',
	];

	/**
	 * Get the user that owns the profile.
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'created_at' => 'datetime',
			'updated_at' => 'datetime',
		];
	}
}
