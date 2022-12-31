<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/scss/app.scss','resources/css/app.css']) 
    @inertiaHead
  </head>
  <body onload="test()">
    <nav>
      <div class="container">
        <a class ="logo" href="/">
          <img src="{{ $logo }}" alt="">
          <div>{{ $title }}</div>
        </a>
        <div class="nav__wrp">
          <a href="">Contact</a>
          <a href="">About us</a>
          <button class="is--black">Sign in <img src="/images/icons/profile-white.svg" alt=""></button>
          <button class="is--black">Saved designs <img src="/images/icons/bookmark-white.svg" alt=""></button>

        </div>
      </div>
    </nav>
    @inertia
    @vite('resources/js/app.js')
    <script>
      function test() {
    alert("test successful");
    }
</script> 
  </body>
</html>