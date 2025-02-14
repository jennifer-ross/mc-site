<?php

namespace App\Models;

use App\Enums\MessageType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 *
 *
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
 * @mixin \Eloquent
 */
class Message extends Model
{
	use HasFactory;

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
		'is_hidden'
	];

	/**
	 * The chat that belong to the message.
	 *
	 * @return BelongsTo
	 */
	public function chat(): BelongsTo
	{
		return $this->belongsTo(Chat::class);
	}

	/**
	 * The user that belong to the message.
	 *
	 * @return BelongsTo
	 */
	public function sender(): BelongsTo
	{
		return $this->belongsTo(User::class, 'sender_id');
	}

	/**
	 *
	 *
	 * @return HasOne
	 */
	public function messageAttachment(): HasOne
	{
		return $this->hasOne(MessageAttachment::class);
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
