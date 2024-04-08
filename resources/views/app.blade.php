<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Transform your favorite chess games into stunning posters with ease using our intuitive design tool. Benefit from worldwide shipping and secure transactions, bringing your personalized chess masterpiece to life. Start creating your unique poster today and showcase your victories with pride!">
    <meta property="og:title" content="Example Company">
    <meta property="og:image" content="{{ env('APP_URL') }}/images/ccp-og.jpg" />
    <meta property="og:description" content="Create your own unique chess poster to display on your wall" />

    <script type="application/ld+json">
        {
            "@context":        "http://schema.org",
            "@type":           "Organization",
            "name":            "Custom Chess Posters",
            "url":             "{{ env('APP_URL') }}",
            "thumbnailUrl":    "{{ env('APP_URL') }}/images/ccp-og.jpg",
            "description":         "Transform your favorite chess games into stunning posters with ease using our intuitive design tool. Benefit from worldwide shipping and secure transactions, bringing your personalized chess masterpiece to life. Start creating your unique poster today and showcase your victories with pride!",
            "keywords":        "poster, chess, chess poster"
       }
    </script>

    <link rel="icon" type="image/svg+xml" href="/images/ccp-icn-white.svg" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/svg+xml" href="/images/ccp-icn-brown.svg" media="(prefers-color-scheme: light)">
    <script src="https://js.stripe.com/v3/" defer></script>
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/scss/app.scss'])
    @inertiaHead
    @routes
</head>

<body>
    @inertia
    @vite('resources/js/app.js')
</body>

</html>
