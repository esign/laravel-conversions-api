@props(['arguments'])

<script {{ $attributes }}>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push(@json((object) $arguments));
</script>