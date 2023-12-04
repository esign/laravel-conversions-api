@props([
    'eventType',
    'eventName',
    'customData',
    'eventData',
])

<script {{ $attributes }}>
    fbq('{{ $eventType }}', '{{ $eventName }}', @json((object) $customData), @json((object) $eventData));
</script>