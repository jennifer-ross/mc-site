<?php

namespace App\Http\Controllers;

use AllowDynamicProperties;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            'guild_id' => config('services.discord.server_id'),
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
            $userProfile = UserProfile::where('discord_id', $discordUser->id)->first();

            if ($userProfile) {
                $user = $userProfile->user;
                $user->updated_at = Carbon::now();
                $user->name = $discordUser->name;
                $user->update();

                Auth::login($user);
            } else {
                $user = User::create([
                    'name' => $discordUser->name,
                    'email' => $discordUser->email,
                    'email_verified_at' => Carbon::now(),
                    'password' => Hash::make(Str::random(32)),
                ]);
                $user->profile()->create([
                    'user_id' => $user->id,
                    'discord_id' => $discordUser->id,
                ]);

                Auth::login($user);
            }
        } catch (\Exception $e) {
            return redirect('/')->withErrors(['error' => $e->getMessage()]);
        }

        return redirect('/');
    }
}
