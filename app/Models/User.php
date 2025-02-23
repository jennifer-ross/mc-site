<?php

namespace App\Models;

use App\Events\UserCreated;
use App\Observers\UserObserver;
use Database\Factories\UserFactory;
use Eloquent;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @property array<Post> $posts
 * @property array<Role> $roles
 * @property-read UserBlocks|null $block
 * @property-read Collection<int, UserBlocks> $blocks
 * @property-read int|null $blocks_count
 * @property-read Collection<int, Chat> $chats
 * @property-read int|null $chats_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read Collection<int, Message> $messages
 * @property-read int|null $messages_count
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read int|null $posts_count
 * @property-read UserProfile|null $profile
 * @property-read int|null $roles_count
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder<static>|User newModelQuery()
 * @method static Builder<static>|User newQuery()
 * @method static Builder<static>|User permission($permissions, $without = false)
 * @method static Builder<static>|User query()
 * @method static Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static Builder<static>|User whereCreatedAt($value)
 * @method static Builder<static>|User whereEmail($value)
 * @method static Builder<static>|User whereEmailVerifiedAt($value)
 * @method static Builder<static>|User whereId($value)
 * @method static Builder<static>|User whereName($value)
 * @method static Builder<static>|User wherePassword($value)
 * @method static Builder<static>|User whereRememberToken($value)
 * @method static Builder<static>|User whereUpdatedAt($value)
 * @method static Builder<static>|User withoutPermission($permissions)
 * @method static Builder<static>|User withoutRole($roles, $guard = null)
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Chat> $chatsOwner
 * @property-read int|null $chats_owner_count
 * @mixin Eloquent
 */
#[ObservedBy([UserObserver::class])]
class User extends Authenticatable implements FilamentUser
{
	use HasApiTokens, HasFactory, HasRoles, Notifiable;

	const AVATAR_API_URL = 'https://starlightskins.lunareclipse.studio/';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var list<string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var list<string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The event map for the model.
	 *
	 * @var array<string, string>
	 */
	protected $dispatchesEvents = [
		'created' => UserCreated::class,
	];

	/**
	 * Determine if the user can access the Filament admin panel.
	 */
	public function canAccessPanel(Panel $panel): bool
	{
		return $this->isSuperAdmin();
	}

	public function isSuperAdmin()
	{
		return $this->hasRole('super_admin', 'web');
	}

	/**
	 * The posts that belong to the user.
	 */
	public function posts(): HasMany
	{
		return $this->hasMany(Post::class);
	}

	/**
	 * The chats that the user own.
	 */
	public function chatsOwner(): HasMany
	{
//        return $this->belongsToMany(Chat::class, 'chat_participants')->withPivot('role', 'joined_at');
		return $this->hasMany(Chat::class, 'owner_id');
	}

	/**
	 * The chats that belong to the user.
	 */
//	public function chats(): HasManyThrough
//	{
////        return $this->belongsToMany(Chat::class, 'chat_participants')->withPivot('role', 'joined_at');
////		return $this->hasManyThrough(Chat::class, 'chat_participants');
//		return $this->hasManyThrough(ChatParticipant::class, 'chat_id', 'user_id', 'id', 'id');
//	}

	public function chats(): BelongsToMany
	{
		return $this->belongsToMany(Chat::class, 'chat_participants')->withPivot('role', 'joined_at');
	}

	public function messages(): HasMany
	{
		return $this->hasMany(Message::class, 'sender_id');
	}

	public function profile(): HasOne
	{
		return $this->hasOne(UserProfile::class);
	}

	public function blocks(): HasMany
	{
		return $this->hasMany(UserBlocks::class, 'blocked_by');
	}

	public function block(): HasOne
	{
		return $this->hasOne(UserBlocks::class);
	}

	public function avatarUrl(): ?string
	{
		if ($this->hasVerification()) {
			$minecraftName = $this->profile->minecraft_name;
			return self::AVATAR_API_URL . "render/head/{$minecraftName}/full";
		}

		return null;
	}

	public function hasVerification(): bool
	{
		if ($this->profile && $this->profile->minecraft_name && $this->profile->minecraft_id) {
			return true;
		}

		return false;
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
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}
}
