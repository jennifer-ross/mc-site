@php
    $iconClass = 'size-5 mr-4';
	$user = Auth::user();
@endphp

<div x-data="{ sidebarClose: false, currentUrl: window.location.pathname, $activeUrlClass: 'bg-lightblue text-primary' }">
	<div
		class="h-full flex flex-col bg-primary px-4 py-4 w-full max-w-64 relative transition-all ease duration-400"
		:class="{ 'max-w-24': sidebarClose }"
	>
		<div class="text-white text-center justify-between flex gap-2">
			<div x-show="!sidebarClose" x-transition>
				<x-logo/>
			</div>
			<x-ui.button @click="sidebarClose = !sidebarClose" class="bg-primary-100">
				<template x-if="sidebarClose">
					<x-icon name="bx-menu" class="{{ $iconClass }} mr-0" />
				</template>
				<template x-if="!sidebarClose">
					<x-icon name="bx-menu-alt-right" class="{{ $iconClass }} mr-0" />
				</template>
			</x-ui.button>
		</div>
		<div class="py-6">
			<div x-show="!sidebarClose" x-transition>
				<x-ui.search/>
			</div>
		</div>
		<nav class="flex flex-1 w-full mb-6">
			<ul class="flex flex-col gap-2 w-full h-full">
				<x-ui.menu.item x-bind:class="currentUrl === '/' ? $activeUrlClass : ''">
					<a
						wire:navigate
						href="/"
						class="p-3 inline-flex items-center justify-start w-full"
						x-bind:class="sidebarClose ? 'justify-center' : ''"
					>
						<x-icon name="bx-grid-alt" class="{{ $iconClass }}" x-bind:class="sidebarClose ? 'mr-0' : ''" />
						<span x-show="!sidebarClose" x-transition>{{ __('sidebar.home') }}</span>
					</a>
				</x-ui.menu.item>

				<x-ui.menu.item x-bind:class="currentUrl === '/dashboard' ? $activeUrlClass : ''">
					<a class="p-3 inline-flex items-center justify-start w-full" href="#" x-bind:class="sidebarClose ? 'justify-center' : ''">
						<x-icon name="bx-user" class="{{ $iconClass }}" x-bind:class="sidebarClose ? 'mr-0' : ''" />
						<span x-show="!sidebarClose" x-transition>{{ __('sidebar.personal') }}</span>
					</a>
				</x-ui.menu.item>

				@can('view_any_chat')
					<x-ui.menu.item x-bind:class="currentUrl === '/chats' ? $activeUrlClass : ''">
						<a
							wire:navigate
							href="/chats"
						    class="p-3 inline-flex items-center justify-start w-full"
							x-bind:class="sidebarClose ? 'justify-center' : ''"
						>
							<x-icon name="bx-chat" class="{{ $iconClass }}" x-bind:class="sidebarClose ? 'mr-0' : ''" />
							<span x-show="!sidebarClose" x-transition>{{ __('sidebar.messages') }}</span>
						</a>
					</x-ui.menu.item>
				@endcan

				<x-ui.menu.item x-bind:class="currentUrl === '/courts' ? $activeUrlClass : ''">
					<a class="p-3 inline-flex items-center justify-start w-full" href="#" x-bind:class="sidebarClose ? 'justify-center' : ''">
						<x-icon name="bx-pie-chart-alt-2" class="{{ $iconClass }}" x-bind:class="sidebarClose ? 'mr-0' : ''" />
						<span x-show="!sidebarClose" x-transition>{{ __('sidebar.court') }}</span>
					</a>
				</x-ui.menu.item>

				<x-ui.menu.item x-bind:class="currentUrl === '/cards' ? $activeUrlClass : ''">
					<a class="p-3 inline-flex items-center justify-start w-full" href="#" x-bind:class="sidebarClose ? 'justify-center' : ''">
						<x-icon name="bx-credit-card" class="{{ $iconClass }}" x-bind:class="sidebarClose ? 'mr-0' : ''" />
						<span x-show="!sidebarClose" x-transition>{{ __('sidebar.cards') }}</span>
					</a>
				</x-ui.menu.item>

				<x-ui.menu.item x-bind:class="currentUrl === '/subscribe' ? $activeUrlClass : ''">
					<a class="p-3 inline-flex items-center justify-start w-full" href="#" x-bind:class="sidebarClose ? 'justify-center' : ''">
						<x-icon name="bx-cart-alt" class="{{ $iconClass }}" x-bind:class="sidebarClose ? 'mr-0' : ''" />
						<span x-show="!sidebarClose" x-transition>{{ __('sidebar.subscribe') }}</span>
					</a>
				</x-ui.menu.item>

				@can('view_any_user')
					<x-ui.menu.item x-bind:class="currentUrl === '/players' ? $activeUrlClass : ''">
						<a class="p-3 inline-flex items-center justify-start w-full" href="#" x-bind:class="sidebarClose ? 'justify-center' : ''">
							<x-icon name="bx-heart" class="{{ $iconClass }}" x-bind:class="sidebarClose ? 'mr-0' : ''" />
							<span x-show="!sidebarClose" x-transition>{{ __('sidebar.players') }}</span>
						</a>
					</x-ui.menu.item>
				@endcan

				@can('update_user', $user)
					<x-ui.menu.item x-bind:class="currentUrl === '/settings' ? $activeUrlClass : ''">
						<a class="p-3 inline-flex items-center justify-start w-full" href="#" x-bind:class="sidebarClose ? 'justify-center' : ''">
							<x-icon name="bx-cog" class="{{ $iconClass }}" x-bind:class="sidebarClose ? 'mr-0' : ''" />
							<span x-show="!sidebarClose" x-transition>{{ __('sidebar.settings') }}</span>
						</a>
					</x-ui.menu.item>
				@endcan
			</ul>
		</nav>
		<div class="flex w-full justify-between gap-2 mt-auto">
			<div class="text-white" x-show="!sidebarClose" x-transition>
				@if($user && $user->avatarUrl())
				@else
					<x-icon name="bx-landscape" class="w-[36px] h-[36px] cursor-help" x-tooltip.raw="{{ __('sidebar.avatar_help') }}" />
				@endif
			</div>

			@if(Auth::check())
				<div class="inline-flex justify-center flex-col items-center gap-1 text-xs" x-show="!sidebarClose" x-transition>
					<span class="text-white">{{ $user->name }}</span>
					<span class="text-white">{{ $user->roles->first()->name }}</span>
				</div>
				<x-ui.button class="bg-primary-100" url="/logout">
					<x-icon name="bx-log-out" class="{{ $iconClass }} mr-0" />
				</x-ui.button>
			@endif
		</div>
	</div>

</div>
