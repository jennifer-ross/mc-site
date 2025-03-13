@props([
	'url' => null,
	'user' => null,
	'message' => null,
])

@if($url && $user && $user->hasVerification())
	<x-ui.button
		:url="$url"
		wire:navigate
		color="none"
		class="
		bg-transparent text-white hover:bg-primary-100 hover:text-white max-w-xs w-full relative flex-shrink rounded-2xl
		after:h-[1px] after:rounded-xl after:w-full after:absolute after:bg-primary-400 after:-bottom-1 after:left-0 last:after:bg-transparent"
	>
		<x-chat.message :user-name="$message->sender->name" :created_at="$message->created_at" :is_deleted="$message->is_deleted" :is_edited="$message->is_edited" :text="$message->excerpt"/>
	</x-ui.button>
@endif

