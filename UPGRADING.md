## From v1 to v2
This package now supports to send multiple events at once to the Conversions API, instead of sending them one by one. While the previous version was mainly focused on sending `PageView` events, v2 now supports all kinds of events.

### Method changes
- The `setEvent` method has been replaced by `addEvent`, `addEvents` and `setEvents` methods.
- The `getEvent` method has been removed in favor of `getEvents`.
- The `execute` method has been replaced by `sendEvents`.
- The `setEventByName` method has been removed, it's recommended to create [dedicated event classes](README.MD#creating-event-classes) for this.
- The `executePageViewEvent` has been removed and is now handled in dedicated view components, see [PageView Events](README.md#pageview-events)
- The `getEventId` and `setEventId` methods have been removed, since this package now supports multiple events, that each have their own unique event id.
You may use Laravel's built-in `Str::uuid()` helper to create unique event id's.
See the [docs](README.md#creating-event-classes) for an example on this.

### Directive changes
- The `@conversionsApiPageView` directive has been replaced by 2 view components, depending on your deduplication preference.
In case you're using the Facebook Pixel directly, use `<x-conversions-api-facebook-pixel-page-view />`.
If you're sending them through Google Tag Manager, use `<x-conversions-api-data-layer-page-view />`.
Note that the dataLayer variable name has been changed from `conversionsApiEventId` to `conversionsApiPageViewEventId`.
- The `@conversionsApiFacebookPixelScript` directive has been replaced with `<x-conversions-api-facebook-pixel-script />`.
- The `@conversionsApiDataLayer` has been removed. Support for dataLayer events is possible through `<x-conversions-api-data-layer-variable :event="$event" />` or `<x-conversions-api::data-layer-variable :arguments="[]" />`. See the [docs](README.md#google-tag-manager) for an example on this.