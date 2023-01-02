<template>
<nav class="">
    <div class="container">
      <a class ="logo" href="/">
        <img src="../../../public/images/ccp-icn.svg" alt="">
        <div>{{ $page.props.site.title }}</div>
      </a>
      <div class="nav__wrp">
        <a href="">Contact</a>
        <a href="">About us</a>
        <button class="is--black">Sign in <img src="/images/icons/profile-white.svg" alt=""></button>
        <button class="is--black">Saved designs <img src="/images/icons/bookmark-white.svg" alt=""></button>

      </div>
    </div>
  </nav>
<slot>
</slot>
</template>

<script setup>
import { onMounted } from 'vue';

onMounted (() => {

  const nav = document.querySelector('nav');
  const firstHeading = document.querySelector('h1');

  const options = {
  root: null, 
  threshold: 1, 
  rootMargin: "-15% 0px 0px 0px",
  }

  const observer = new IntersectionObserver (function(entries, observer){
    entries.forEach(entry => {
      if(!nav.classList.length && !entry.isIntersecting){
        nav.classList.add('is--scrolled');
      } else {
        nav.classList.remove('is--scrolled');
      }
    })
  }, options); 

  observer.observe(firstHeading);

});

</script>