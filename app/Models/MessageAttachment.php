<?php

namespace App\Models;

use App\Concerns\Cacheable;
use App\Observers\MessageAttachmentObserver;
use Database\Factories\MessageAttachmentFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $image_id
 * @property int $uploaded_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read User $uploaded
 *
 * @method static Builder<static>|MessageAttachment newModelQuery()
 * @method static Builder<static>|MessageAttachment newQuery()
 * @method static Builder<static>|MessageAttachment query()
 * @method static Builder<static>|MessageAttachment whereCreatedAt($value)
 * @method static Builder<static>|MessageAttachment whereId($value)
 * @method static Builder<static>|MessageAttachment whereImageId($value)
 * @method static Builder<static>|MessageAttachment whereUpdatedAt($value)
 * @method static Builder<static>|MessageAttachment whereUploadedBy($value)
 * @method static MessageAttachmentFactory factory($count = null, $state = [])
 *
 * @mixin \Eloquent
 */
#[ObservedBy([MessageAttachmentObserver::class])]
class MessageAttachment extends Model
{
    use Cacheable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image_id',
        'uploaded_by',
    ];

    /**
     * Get the image that owns the attachment.
     */
    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id');
    }

    /**
     * Get the user that owns the attachment.
     */
    public function uploaded(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
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
