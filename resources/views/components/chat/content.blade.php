@props([
	'chat'
])

<div class="h-full w-full text-white border-t border-t-primary relative"
{{--	 x-data="{--}}
{{--        messages: @js($messages),--}}
{{--        visibleMessages: [],--}}
{{--        containerHeight: 0,--}}
{{--        itemHeight: 60,--}}
{{--        scrollTop: 0,--}}

{{--        init() {--}}
{{--        	this.containerHeight = this.$refs.container.clientHeight--}}
{{--            this.calculateVisibleMessages()--}}
{{--            this.$watch('scrollTop', () => this.calculateVisibleMessages())--}}
{{--        },--}}

{{--        calculateVisibleMessages() {--}}
{{--            const startIndex = Math.floor(this.scrollTop / this.itemHeight)--}}
{{--            const endIndex = Math.min(--}}
{{--                startIndex + Math.ceil(this.containerHeight / this.itemHeight),--}}
{{--                this.messages.length--}}
{{--            )--}}

{{--            this.visibleMessages = this.messages.slice(startIndex, endIndex)--}}
{{--        }--}}
{{--    }"--}}
{{--	 x-init="containerHeight = $refs.container.clientHeight"--}}
{{--	 @scroll="scrollTop = $refs.container.scrollTop"--}}
{{--	 style="height: 500px; overflow-y: auto;"--}}
{{--	 x-ref="container"--}}
>
	<!-- Пустое пространство перед видимыми сообщениями -->
{{--	<div :style="`height: ${scrollTop}px;`"></div>--}}

{{--	<!-- Видимые сообщения -->--}}
{{--	<template x-for="message in visibleMessages" :key="message.id">--}}
{{--		<div class="flex gap-3 w-full justify-between py-1" :style="`height: ${itemHeight}px;`">--}}
{{--			<div class="flex gap-3">--}}
{{--				<div class="relative">--}}
{{--					<x-img--}}
{{--						class="size-10"--}}
{{--						:media=1--}}
{{--						format="webp"--}}
{{--						quality="80"--}}
{{--					/>--}}
{{--				</div>--}}
{{--				<div class="flex flex-col gap-1">--}}
{{--					<span class="font-bold" x-text="message.userName"></span>--}}
{{--					<span class="text-xs" x-text="!message.isDeleted ? message.text['0'].data.content : message.textDeleted">--}}
{{--						@if($message->is_edited)--}}
{{--							<small class="lowercase italic text-gray-400">({{ __('message.edited') }})</small>--}}
{{--						@endif--}}
{{--					</span>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--			<time--}}
{{--				x-tooltip="message.timeTooltip"--}}
{{--				:datetime="message.datetime"--}}
{{--				class="text-gray-400 self-start"--}}
{{--				x-text="message.time"--}}
{{--			>--}}
{{--			</time>--}}
{{--		</div>--}}
{{--	</template>--}}

{{--	<!-- Пустое пространство после видимыx сообщений -->--}}
{{--	<div :style="`height: ${((messages.length) * itemHeight) - (scrollTop + containerHeight)}px;`"></div>--}}
	<livewire:components.message-list :chat-id="$chat->id"/>
</div>
