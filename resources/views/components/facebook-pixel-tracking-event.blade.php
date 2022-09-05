<script>
    fbq('{{ $eventType }}', '{{ $eventName }}', @json((object) $customData), @json((object) $eventData));
</script>