@php
	$metaData = $seoMetaData ?? null;
	$seoPage = is_array($metaData) ? ($metaData['page'] ?? null) : null;
	$robots = is_array($metaData) ? ($metaData['robots'] ?? 'index, follow') : 'index, follow';
@endphp

<meta name="robots" content="{{ $robots }}">

@if ($seoPage?->meta_description)
	<meta name="description" content="{{ $seoPage->meta_description }}">
@endif

@if ($seoPage?->meta_keywords)
	<meta name="keywords" content="{{ $seoPage->meta_keywords }}">
@endif

@if ($seoPage?->canonical_url)
	<link rel="canonical" href="{{ $seoPage->canonical_url }}">
@endif

@if ($seoPage?->og_title || $seoPage?->meta_title)
	<meta property="og:title" content="{{ $seoPage->og_title ?: $seoPage->meta_title }}">
@endif

@if ($seoPage?->og_description || $seoPage?->meta_description)
	<meta property="og:description" content="{{ $seoPage->og_description ?: $seoPage->meta_description }}">
@endif

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">

@if ($seoPage?->og_image_path)
	<meta property="og:image" content="{{ asset('storage/' . $seoPage->og_image_path) }}">
	@if ($seoPage?->og_image_alt)
		<meta property="og:image:alt" content="{{ $seoPage->og_image_alt }}">
	@endif
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:image" content="{{ asset('storage/' . $seoPage->og_image_path) }}">
@else
	<meta name="twitter:card" content="summary">
@endif

@if ($seoPage?->og_title || $seoPage?->meta_title)
	<meta name="twitter:title" content="{{ $seoPage->og_title ?: $seoPage->meta_title }}">
@endif

@if ($seoPage?->og_description || $seoPage?->meta_description)
	<meta name="twitter:description" content="{{ $seoPage->og_description ?: $seoPage->meta_description }}">
@endif
