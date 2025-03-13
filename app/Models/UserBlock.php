<?php

namespace App\Models;

use App\Concerns\Cacheable;
use App\Observers\UserBlockObserver;
use Database\Factories\UserBlockFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property Carbon $from_date
 * @property Carbon|null $to_date
 * @property int $blocked_by
 * @property int $user_id
 * @property string $reason
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $blockedBy
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read User|null $user
 *
 * @method static Builder<static>|UserBlock newModelQuery()
 * @method static Builder<static>|UserBlock newQuery()
 * @method static Builder<static>|UserBlock query()
 * @method static Builder<static>|UserBlock whereBlockedBy($value)
 * @method static Builder<static>|UserBlock whereCreatedAt($value)
 * @method static Builder<static>|UserBlock whereFromDate($value)
 * @method static Builder<static>|UserBlock whereId($value)
 * @method static Builder<static>|UserBlock whereReason($value)
 * @method static Builder<static>|UserBlock whereToDate($value)
 * @method static Builder<static>|UserBlock whereUpdatedAt($value)
 * @method static Builder<static>|UserBlock whereUserId($value)
 * @method static UserBlockFactory factory($count = null, $state = [])
 *
 * @mixin Eloquent
 */
#[ObservedBy([UserBlockObserver::class])]
class UserBlock extends Model
{
    use Cacheable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'from_date',
        'to_date',
        'blocked_by',
        'reason',
        'user_id',
    ];

    /**
     * Get the user that owns the block.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user that owns the block. Who block user
     */
    public function blockedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'blocked_by');
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
            'from_date' => 'datetime',
            'to_date' => 'datetime',
        ];
    }
}
