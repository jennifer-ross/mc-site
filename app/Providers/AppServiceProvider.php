<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		FilamentView::registerRenderHook(
			'panels::head.start',
			fn(): string => '<meta name="robots" content="noindex,nofollow">'
		);
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		Passport::loadKeysFrom(__DIR__ . '/../secrets/oauth');
		Passport::tokensExpireIn(now()->addDays(15));
		Passport::refreshTokensExpireIn(now()->addDays(30));
		Passport::personalAccessTokensExpireIn(now()->addMonths(6));

		Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
			$event->extendSocialite('discord', \SocialiteProviders\Discord\Provider::class);
		});
	}
}
