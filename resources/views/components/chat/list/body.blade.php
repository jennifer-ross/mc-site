@props([
	'chats' => [],
])

@foreach ($chats as $chat)
	<x-chat.tiny
		url="/chat/{{ $chat['chat']->id }}"
		:user="$chat['message']?->sender"
		:message="$chat['message']"
	/>
@endforeach
