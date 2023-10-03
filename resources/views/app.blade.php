<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Design your own unique poster featuring your favorite chessgame.">
    <link rel="icon" type="image/svg+xml" href="/images/ccp-icn-white.svg" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/svg+xml" href="/images/ccp-icn-brown.svg" media="(prefers-color-scheme: light)">
    <script src="https://js.stripe.com/v3/" defer></script>
    <title>{{ env('APP_NAME') }}</title>
    <meta property="og:image" content="{{ env('APP_URL') }}/images/ccp-og.jpg" />
    <meta property="og:description" content="Create your own unique chess poster to display on your wall" />
    @vite(['resources/scss/app.scss'])
    @inertiaHead
    @routes
</head>

<body>
    @inertia
    @vite('resources/js/app.js')
</body>

</html>
