<?php

namespace App\Models;

use App\Enums\ChatUserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $chat_id
 * @property int $user_id
 * @property string $role
 * @property string $joined_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static Builder<static>|ChatParticipant newModelQuery()
 * @method static Builder<static>|ChatParticipant newQuery()
 * @method static Builder<static>|ChatParticipant query()
 * @method static Builder<static>|ChatParticipant whereChatId($value)
 * @method static Builder<static>|ChatParticipant whereCreatedAt($value)
 * @method static Builder<static>|ChatParticipant whereId($value)
 * @method static Builder<static>|ChatParticipant whereJoinedAt($value)
 * @method static Builder<static>|ChatParticipant whereRole($value)
 * @method static Builder<static>|ChatParticipant whereUpdatedAt($value)
 * @method static Builder<static>|ChatParticipant whereUserId($value)
 * @mixin \Eloquent
 */
class ChatParticipant extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'chat_id',
		'user_id',
		'role',
		'joined_at',
	];

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
			'joined_at' => 'datetime',
			'role' => ChatUserRole::class,
		];
	}

}
