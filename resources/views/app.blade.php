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
    <script>

    const nav = document.querySelector("nav");
    const body = document.querySelector("body");

    let heroOptions = {
    root: document.querySelector('.hero'),
    rootMargin: '0px',
    threshold: 0.1
    }

    const bodyObserver = new IntersectionObserver(function () {
      console.log("test");
    }, heroOptions);

    //heroObserver.observe(body);

</script> 
  </body>
</html>