@props([
	'class' => '',
])

<li {{ $attributes->merge(['class' => "cursor-pointer text-white bg-primary hover:bg-white transition-all hover:text-primary rounded-xl ease duration-400 inline-flex items-center {$class}"]) }}>
	{{ $slot }}
</li>
