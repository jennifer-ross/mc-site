<?php

namespace App\Models;

use App\Concerns\Cacheable;
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
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

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
    use Cacheable, HasFactory;

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

    /**
     * Get the messages attribute.
     *
     * @return Collection<Message>
     */
    public function getMessagesAttribute(): Collection
    {
        return $this->getMessages();
    }

    public function getMessages(): Collection
    {
        $messagesCacheKey = $this->getCacheKey().':messages';

        return Cache::rememberForever($messagesCacheKey, function () {
            return Message::where(['chat_id' => $this->id, 'is_hidden' => false, 'is_deleted' => false])->get();
        });
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the owner attribute.
     */
    public function getOwnerAttribute(): ?User
    {
        return $this->getOwner();
    }

    public function getOwner(): ?User
    {
        return User::getFromCacheById($this->owner_id);
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
     * Get the last message attribute.
     */
    public function getLastMessageAttribute(): ?Message
    {
        return $this->getLastMessage();
    }

    public function getLastMessage(): ?Message
    {
        $lastMessageCacheKey = $this->getCacheKey().':last_message';

        return Cache::rememberForever($lastMessageCacheKey, function () {
            return Message::where([
                'chat_id' => $this->id,
                'is_hidden' => false,
                'is_deleted' => false,
            ])->latest()->get()->first();
        });
    }

    /**
     * @throws InvalidArgumentException
     */
    public function setLastMessage(?Message $message = null): bool
    {
        $lastMessageCacheKey = $this->getCacheKey().':last_message';

        if (! $message && Cache::has($lastMessageCacheKey)) {
            return Cache::delete($lastMessageCacheKey);
        }

        return Cache::put($lastMessageCacheKey, $message);
    }

	public function getIsPrivateChatAttribute(): bool
	{
		return $this->isPrivateChat();
	}

	public function isPrivateChat(): bool
	{
		return $this->visibility === ChatVisibility::Private;
	}

	public function getIsPublicChatAttribute(): bool
	{
		return $this->isPublicChat();
	}

	public function isPublicChat(): bool
	{
		return $this->visibility === ChatVisibility::Public;
	}

	public function getIsPrivateAttribute(): bool
	{
		return $this->isPrivate();
	}

	public function isPrivate(): bool
	{
		return $this->type === ChatType::Private;
	}

	public function getIsGroupAttribute(): bool
	{
		return $this->isGroup();
	}

	public function isGroup(): bool
	{
		return $this->type === ChatType::Group;
	}

	public function getIsCourtAttribute(): bool
	{
		return $this->isCourt();
	}

	public function isCourt(): bool
	{
		return $this->type === ChatType::Court;
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
