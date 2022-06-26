<script>
    fbq('{{ $command }}', '{{ $eventName }}', @json($data, JSON_FORCE_OBJECT), @json($parameters, JSON_FORCE_OBJECT));
</script>