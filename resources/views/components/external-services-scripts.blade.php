@php
    $services = collect();

    if (\Illuminate\Support\Facades\Schema::hasTable('external_services')) {
        $services = \App\Models\ExternalService::query()
            ->where('active', true)
            ->whereNotNull('script')
            ->where('script', '!=', '')
            ->orderBy('id')
            ->get(['script']);
    }
@endphp

@foreach ($services as $service)
    @php
        $raw = (string) $service->script;
        $decoded = html_entity_decode($raw, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        preg_match_all('/<(script|noscript)\b[\s\S]*?<\/\1>/i', $decoded, $matches);
        $blocks = $matches[0] ?? [];
        $inlineJs = trim(strip_tags($decoded));
    @endphp

    @if (!empty($blocks))
        @foreach ($blocks as $block)
            {!! $block !!}
        @endforeach
    @elseif ($inlineJs !== '')
        <script>
            {!! $inlineJs !!}
        </script>
    @endif
@endforeach
