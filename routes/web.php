<?php

use App\Http\Controllers\DiscordOAuthController;
use App\Http\Controllers\UserController;
use App\Livewire\Home;
use App\Livewire\Chats;
use App\Livewire\Post\Show as PostShow;
use App\Livewire\Chat\Show as ChatShow;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/article/{post:slug}', PostShow::class)->name('post.show');

Route::get('auth/discord', [DiscordOAuthController::class, 'index'])->name('auth.discord');
Route::get('auth/discord/callback', [DiscordOAuthController::class, 'store'])->name('auth.discord.callback');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/chats', Chats::class)->name('chats');
	Route::get('/chat/{chatId}', ChatShow::class)->name('chat.show');

	Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');
});
