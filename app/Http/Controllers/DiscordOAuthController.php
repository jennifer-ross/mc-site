<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Discord\Provider;

#[AllowDynamicProperties] class DiscordOAuthController extends Controller
{
	private Provider $provider;

	public function __construct()
	{
		$this->provider = Socialite::driver('discord');
		$this->provider->scopes([
			'identify',
			'email',
			'guilds',
			'guilds.join',
			'guilds.members.read',
		])->with([
			'guild_id' => config('services.discord.server_id')
		]);
	}

	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return $this->provider->redirect();
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		try {
			$discordUser = $this->provider->user();
			$user = User::where('discord_id', $discordUser->id)->first();

			if ($user) {
//				Auth::login($user);
			} else {
//				$user = User::create([
//					'name' => $discordUser->name,
//					'email' => $discordUser->email,
//					'discord_id' => $discordUser->id,
//					'avatar' => $discordUser->avatar,
//				]);
//
//				Auth::login($user);
			}
		} catch (\Exception $e) {

		}

		return redirect('/');
	}
}
