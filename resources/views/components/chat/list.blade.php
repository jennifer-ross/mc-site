@props([
	'chats' => [],
])

<div class="flex flex-col p-4 gap-2 bg-primary rounded-l-xl">
	<x-chat.list.head/>
	<x-chat.list.body :chats="$chats"/>
</div>
