<script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({'{{ $dataLayerVariableName ?? 'conversionsApiEventId' }}': '{{ Esign\ConversionsApi\Facades\ConversionsApi::getEventId() }}'});
</script>