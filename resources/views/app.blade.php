<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/scss/app.scss','resources/css/app.css']) 
    @inertiaHead
  </head>
  <body>
    @inertia
    @vite('resources/js/app.js') 
  </body>
</html>