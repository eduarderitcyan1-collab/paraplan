@php
	$faviconPath = \App\Models\SeoSetting::query()->value('favicon_path');
	$faviconUrl = $faviconPath ? asset('storage/' . ltrim($faviconPath, '/')) : asset('images/svg/favicon.svg');
@endphp

<link rel="icon" href="{{ $faviconUrl }}">
