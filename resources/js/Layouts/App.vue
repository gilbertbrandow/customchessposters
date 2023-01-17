<template>
<nav class="">
    <div class="container">
      <Link class ="logo" :href="route('home.index')">
        <img src="../../../public/images/ccp-icn.svg" alt="">
        <div>{{ $page.props.site.title }}</div>
      </Link>
      <div class="nav__wrp">
        <Link :href="route('home.contact')">Contact</Link>
        <Link href="">About us</Link>
        <Link v-if="$page.props.auth" class="button is--black">{{ $page.props.auth.user.name }} <img src="/images/icons/profile-white.svg" alt=""></Link>
        <Link v-else class="button is--black" :href="route('auth.login')">Sign in <img src="/images/icons/profile-white.svg" alt=""></Link>
        <Link class="button is--black">Saved designs <img src="/images/icons/bookmark-white.svg" alt=""></Link>

      </div>
    </div>
  </nav>
  <main>
<slot>
</slot>

</main>
<footer>
  <div class="container">
    <Newsletter/>
    <div class="footer__bottom">
      <div>All rättigheter reserverade © 2023 Custom Chess Poster. Powered by <a href="https://0100.se">0100</a></div>
      <Link :href="route('policy.shipping')">Shipping information</Link>
      <Link :href="route('policy.return')">Return policy</Link>
      <Link :href="route('policy.privacy')">Privacy policy</Link>
    </div>
  </div>
</footer>
</template>

<script>
import { onMounted } from 'vue';
import { Link } from "@inertiajs/inertia-vue3";
import Newsletter from "../Pages/Components/Newsletter.vue"

export default {
    components: {
        Link,
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