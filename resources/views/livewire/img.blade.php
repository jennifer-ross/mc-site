@props([
	'class' => '',
	'alt' => null,
	'id' => null,
])

{{--<x-curator-glider--}}
{{--	{{ $attributes->merge(['class' => "lazy shadow rounded-lg object-cover w-auto {$class}"]) }}--}}
{{--	:media="10"--}}
{{--	:srcset="$srcset"--}}
{{--	sizes="(max-width: 1200px) 100vw, 1024px"--}}
{{--	@if($sizes) sizes="{{ $sizes }}" @endif--}}
{{--	format="webp"--}}
{{--	quality="80"--}}
{{--	force="true"--}}
{{--	@if($alt) alt="{{ $alt }}" @endif--}}
{{--	@if($alt) title="{{ $alt }}" @endif--}}
{{--	@if($id) id="{{ $id }}" @endif--}}
{{--/>--}}

@if ($media)
	@if (str($media->type)->contains('image'))
		<img
			{{ $attributes->merge(['class' => "lazy shadow rounded-xl object-cover w-auto {$class}"]) }}
			src="{{ asset('img/blank.webp') }}"
			data-src="{{ $source }}"
			@if($alt) alt="{{ $alt }}" @endif
			@if($alt) title="{{ $alt }}" @endif
			@if($id) id="{{ $id }}" @endif
			@if ($width && $height)
				width="{{ $width }}"
			height="{{ $height }}"
			@else
				width="{{ $media->width }}"
			height="{{ $media->height }}"
			@endif
			@if ($sourceSet)
				data-srcset="{{ $sourceSet }}"
			sizes="{{ $sizes }}"
			@endif
			{{ $attributes->filter(fn ($attr) => $attr !== '') }}
			draggable="false"
			loading="lazy"
		/>
	@else
		<x-curator::document-image
			label="{{ $media->name }}"
			icon-size="xl"
			{{ $attributes->merge(['class' => 'p-4']) }}
		/>
	@endif
@endif
