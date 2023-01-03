<template>
<nav class="">
    <div class="container">
      <Link class ="logo" href="/">
        <img src="../../../public/images/ccp-icn.svg" alt="">
        <div>{{ $page.props.site.title }}</div>
      </Link>
      <div class="nav__wrp">
        <Link href="/contact">Contact</Link>
        <Link href="">About us</Link>
        <Link class="button is--black">Sign in <img src="/images/icons/profile-white.svg" alt=""></Link>
        <Link class="button is--black">Saved designs <img src="/images/icons/bookmark-white.svg" alt=""></Link>

      </div>
    </div>
  </nav>
<slot>
</slot>
</template>

<script>
import { onMounted } from 'vue';
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link
    }
}
</script>

<script setup>

onMounted (() => {

const nav = document.querySelector('nav');
const heroSection = document.querySelector('section');

const options = {
root: null, 
threshold: 1, 
rootMargin: "3% 0px 100% 0px",
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

observer.observe(heroSection);

});

</script>