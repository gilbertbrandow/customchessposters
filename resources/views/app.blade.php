<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/scss/app.scss','resources/css/app.css']) 
    @inertiaHead
  </head>
  <body>
    <nav class="is--frosted-glass">
      <div class="container">
        <a class ="logo" href="/">
          <img src="{{ $logo }}" alt="">
          <div>{{ $title }}</div>
        </a>
      </div>
    </nav>
    @inertia
    @vite('resources/js/app.js') 
  </body>
</html>