<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
   <link rel="icon" type="image/svg+xml" href="/images/ccp-icn-brown.svg" media="(prefers-color-scheme: light)">
   <link rel="icon" type="image/svg+xml" href="/images/ccp-icn-white.svg" media="(prefers-color-scheme: dark)">
   @if(Route::currentRouteName() == 'payment.index')
   <script src="https://js.stripe.com/v3/"></script>
   @endif
    @vite(['resources/scss/app.scss']) 
    @inertiaHead
    @routes
  </head>
  <body>
    @inertia
    @vite('resources/js/app.js')
  </body>
</html>