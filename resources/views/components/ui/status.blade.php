@props([
	'class' => ''
])

<div {{ $attributes->merge(['class' => "rounded-3xl border border-gray-400 py-1.5 px-6 inline-flex flex-col justify-center items-center bg-black bg-opacity-20 shadow-sm {$class}"]) }}>
	{{ $slot }}
</div>
