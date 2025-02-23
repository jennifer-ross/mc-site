<?php

namespace App\Models;

use App\Enums\ChatType;
use App\Enums\ChatUserRole;
use App\Enums\ChatVisibility;
use App\Observers\ChatObserver;
use Database\Factories\ChatFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $type
 * @property string $visibility
 * @property string|null $name
 * @property int $owner_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read Collection<int, Message> $messages
 * @property-read int|null $messages_count
 * @property-read Collection<int, ChatParticipant> $participants
 * @property-read int|null $participants_count
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 *
 * @method static Builder<static>|Chat newModelQuery()
 * @method static Builder<static>|Chat newQuery()
 * @method static Builder<static>|Chat query()
 * @method static Builder<static>|Chat whereCreatedAt($value)
 * @method static Builder<static>|Chat whereId($value)
 * @method static Builder<static>|Chat whereName($value)
 * @method static Builder<static>|Chat whereOwnerId($value)
 * @method static Builder<static>|Chat whereType($value)
 * @method static Builder<static>|Chat whereUpdatedAt($value)
 * @method static Builder<static>|Chat whereVisibility($value)
 *
 * @property-read User|null $owner
 *
 * @method static ChatFactory factory($count = null, $state = [])
 *
 * @mixin Eloquent
 */
#[ObservedBy([ChatObserver::class])]
class Chat extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'type',
		'visibility',
		'name',
		'owner_id',
	];

	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class, 'chat_participants')->withPivot('role', 'joined_at');
	}

	/**
	 * Get the messages of the chat.
	 *
	 * This method returns all messages that belong to the chat.
	 */
	public function messages(): HasMany
	{
		return $this->hasMany(Message::class);
	}

	public function owner()
	{
		return $this->belongsTo(User::class, 'owner_id');
	}

	public function addUser(User|int $user, ChatUserRole $role)
	{
		return $this->participants()->create([
			'chat_id' => $this->id,
			'user_id' => is_int($user) ? $user : $user->id,
			'role' => $role->value,
		]);
	}

	public function participants(): HasManyThrough
	{
		return $this->hasManyThrough(ChatParticipant::class, User::class, 'user_id', 'chat_id', 'id', 'chat_id');
		//		return $this->hasMany(ChatParticipant::class);
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
			'type' => ChatType::class,
			'visibility' => ChatVisibility::class,
		];
	}
}
