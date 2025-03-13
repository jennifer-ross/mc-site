<div class="flex justify-between gap-4 -mx-4 px-4 pb-4 border-b border-b-primary-400">
	<spna class="text-lg font-bold text-white">Сообщения</spna>
	<div class="flex gap-1">
		<x-ui.button
			color="primary"
			class="[&]:p-1 [&]:hover:bg-primary-400 [&]:bg-transparent [&]:text-white"
			title="{{ __('chat.create_call_tooltip') }}"
			x-tooltip.raw="{{ __('chat.create_call_tooltip') }}"
		>
			<x-icon name="bx-phone" class="size-5"/>
		</x-ui.button>
		<x-ui.button
			color="primary"
			class="[&]:p-1 [&]:hover:bg-primary-400 [&]:bg-transparent [&]:text-white"
			title="{{ __('chat.create_tooltip') }}"
			x-tooltip.raw="{{ __('chat.create_tooltip') }}"
		>
			<x-icon name="bx-edit" class="size-5"/>
		</x-ui.button>
	</div>
</div>
