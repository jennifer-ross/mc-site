<?php

namespace App\Models;

use App\Concerns\Cacheable;
use App\Enums\ChatUserRole;
use App\Observers\ChatParticipantObserver;
use Database\Factories\ChatParticipantFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $chat_id
 * @property int $user_id
 * @property string $role
 * @property string $joined_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 *
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
 * @method static ChatParticipantFactory factory($count = null, $state = [])
 *
 * @property-read Chat $chat
 * @property-read User $user
 *
 * @mixin Eloquent
 */
#[ObservedBy([ChatParticipantObserver::class])]
class ChatParticipant extends Model
{
    use Cacheable, HasFactory;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
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
            'joined_at' => 'datetime',
            'role' => ChatUserRole::class,
        ];
    }
}
