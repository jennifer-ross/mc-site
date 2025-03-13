<div class="py-2 px-4 flex flex-col gap-2 max-h-[55vh] h-full overflow-y-auto border-b border-b-primary scroll-primary"
	 x-data="{
	 	loaded: false,
		init: async function() {
			const container = this.$refs.container;
			container.scrollTop =container.scrollHeight;
			await sleep(250);
			this.loaded = true;
		}
	}"
	x-ref="container"
>
	@foreach($messages as $message)
		<x-chat.message class="invisible" x-bind:class="loaded ? '[&]:visible' : ''" :user-name="$message->sender->name" :created_at="$message->created_at" :is_deleted="$message->is_deleted" :is_edited="$message->is_edited" :text="$message->text"/>
	@endforeach
</div>
