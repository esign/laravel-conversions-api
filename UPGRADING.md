## From v1 to v2
This package now supports to send multiple events at once to the Conversions API, instead of sending them one by one.
It was also focused on mainly sending `PageView` events, whereas now it supports all kinds of events.

### Method changes
- The `setEvent` method has been replaced by `addEvents` and `setEvents` methods.
- The `execute` method has been replaced by `sendEvents`.
- The `getEventId` method has been removed, since this package now supports multiple events, that each have their own unique event id.
You may use Laravel's built-in `Str::uuid()` helper to create unique event id's.
See the [docs](README.md#creating-event-classes) for an example on this.

### Directive changes
- The `@conversionsApiPageView` directive has been replaced by 2 view components, depending on your deduplication preference.
In case you're using the Facebook Pixel directly, use `<x-conversions-api-facebook-pixel-page-view />`.
If you're sending them through Google Tag Manager, use `<x-conversions-api-data-layer-page-view />`.
Note that the dataLayer variable name has been changed from `conversionsApiEventId` to `conversionsApiPageViewEventId`.
- The `@conversionsApiFacebookPixelScript` directive has been replaced with `<x-conversions-api-facebook-pixel-script />`.