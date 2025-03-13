<?php

namespace App\Models;

use App\Concerns\Cacheable;
use App\Enums\MessageType;
use App\Observers\MessageObserver;
use Database\Factories\MessageFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int $chat_id
 * @property int $sender_id
 * @property string $type
 * @property array<array-key, mixed>|null $content
 * @property int|null $attachment_id
 * @property bool $is_hidden
 * @property bool $is_deleted
 * @property bool $is_edited
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Chat $chat
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read MessageAttachment|null $messageAttachment
 * @property-read User $sender
 *
 * @method static Builder<static>|Message newModelQuery()
 * @method static Builder<static>|Message newQuery()
 * @method static Builder<static>|Message query()
 * @method static Builder<static>|Message whereAttachmentId($value)
 * @method static Builder<static>|Message whereChatId($value)
 * @method static Builder<static>|Message whereContent($value)
 * @method static Builder<static>|Message whereCreatedAt($value)
 * @method static Builder<static>|Message whereId($value)
 * @method static Builder<static>|Message whereIsDeleted($value)
 * @method static Builder<static>|Message whereIsEdited($value)
 * @method static Builder<static>|Message whereIsHidden($value)
 * @method static Builder<static>|Message whereSenderId($value)
 * @method static Builder<static>|Message whereType($value)
 * @method static Builder<static>|Message whereUpdatedAt($value)
 * @method static MessageFactory factory($count = null, $state = [])
 *
 * @property-read array $blocks
 * @property-read string $excerpt
 *
 * @mixin \Eloquent
 */
#[ObservedBy([MessageObserver::class])]
class Message extends Model
{
    use Cacheable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_id',
        'sender_id',
        'type',
        'content',
        'attachment_id',
        'is_deleted',
        'is_edited',
        'is_hidden',
    ];

    /**
     * The chat that belong to the message.
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * The user that belong to the message.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function messageAttachment(): HasOne
    {
        return $this->hasOne(MessageAttachment::class);
    }

    /**
     * Retrieve the message content blocks as an array.
     */
    public function getBlocksAttribute(): array
    {
        return json_decode(
            collect($this->content ?? [])->toJson()
        );
    }

    /**
     * Retrieve the message excerpt.
     */
    public function getExcerptAttribute(): string
    {
        $excerpt = collect($this->content)
            ->first() ?? [];

        $excerpt = collect(
            explode("\n", Arr::get($excerpt, 'data.content', ''))
        )->first();

        return Str::limit($excerpt, 21);
    }

	/**
	 * Retrieve the message content.
	 */
	public function getTextAttribute(): string
	{
		$excerpt = collect($this->content)
			->first() ?? [];

		return collect(
			explode("\n", Arr::get($excerpt, 'data.content', ''))
		)->first();
	}

	/**
	 * Get the Sender attribute.
	 *
	 * @return User|null
	 */
	public function getSenderAttribute(): ?User
	{
		return $this->getSender();
	}

	/**
	 * Get the Chat attribute.
	 *
	 * @return Chat|null
	 */
	public function getChatAttribute(): ?Chat
	{
		return $this->getChat();
	}

	/**
	 * Get the MessageAttachment attribute.
	 *
	 * @return Chat|null
	 */
	public function getMessageAttachmentAttribute(): ?MessageAttachment
	{
		return $this->getMessageAttachment();
	}


	public function getMessageAttachment(): ?MessageAttachment
    {
        if (! $this->attachment_id) {
            return null;
        }

        return MessageAttachment::getFromCacheById($this->attachment_id);
    }

    public function getSender(): ?User
    {
        return User::getFromCacheById($this->sender_id);
    }

    public function getChat(): ?Chat
    {
        return Chat::getFromCacheById($this->chat_id);
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
            'is_deleted' => 'boolean',
            'is_edited' => 'boolean',
            'is_hidden' => 'boolean',
            'content' => 'json',
            'type' => MessageType::class,
        ];
    }
}
