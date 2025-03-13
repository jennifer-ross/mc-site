<form class="max-w-md mx-auto">
	<label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
	<div class="relative">
		<div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-white">
			<x-icon name="bx-search" class="size-5 mr-0" />
		</div>
		<input type="search" id="default-search" class="block w-full bg-primary-100 p-4 ps-10 text-xs text-white rounded-xl border-0 focus:ring-primary-100 placeholder-gray-400" placeholder="{{ __('sidebar.search') }}" required />
	</div>
</form>
