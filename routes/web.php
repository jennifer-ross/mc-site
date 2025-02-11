<?php

use App\Http\Controllers\DiscordOAuthController;
use App\Livewire\Home;
use App\Livewire\Post\Show as PostShow;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/article/{post:slug}', PostShow::class)->name('post.show');

Route::get('auth/discord', [DiscordOAuthController::class, 'index']);
Route::get('auth/discord/callback', [DiscordOAuthController::class, 'store']);
