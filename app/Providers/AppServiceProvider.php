<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Laravel\Passport\Passport;
use SocialiteProviders\Discord\Provider;
use SocialiteProviders\Manager\SocialiteWasCalled;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::HEAD_START,
            fn (): string => '<meta name="robots" content="noindex,nofollow">'
        );

        FilamentView::registerRenderHook(
            PanelsRenderHook::BODY_END,
            fn (): View => view('components.scripts')
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->bootPassport();
        $this->bootSocialite();
        $this->bootGates();
    }

    private function bootPassport(): void
    {
        Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }

	private function bootSocialite(): void
    {
        Event::listen(function (SocialiteWasCalled $event) {
            $event->extendSocialite('discord', Provider::class);
        });
    }

    private function bootGates(): void
    {
		Gate::guessPolicyNamesUsing(function (string $modelClass) {
			return str_replace('Models', 'Policies', $modelClass) . 'Policy';
		});
    }
}
