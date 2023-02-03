<template>
<nav class="">
    <div class="container">
      <Link class ="logo" :href="route('home.index')">
        <img src="../../../public/images/ccp-icn.svg" alt="">
        <div>{{ $page.props.site.title }}</div>
      </Link>
      <div class="nav__wrp">
        <div class="dropdown"><img src=""/> USA / USD $</div>
        <Link :href="route('auth.account')" v-if="$page.props.auth" class="nav__button"><div class="info"><div></div>Your Account ({{ $page.props.auth.user.name }}) </div><img src="/images/icons/profile-white.svg" alt=""></Link>
        <Link :href="route('auth.login')" v-else class="nav__button"><div class="info"><div></div>Sign in </div><img src="/images/icons/profile-white.svg" alt=""></Link>
        <Link :href="route('home.index')" class="nav__button"><div class="info"><div></div>Your saved designs</div><img src="/images/icons/bookmark-white.svg" alt=""></Link>
        <Link :href="route('home.index')" class="nav__button"><div class="info"><div></div>Cart</div> <img src="/images/icons/bag-white.svg" alt=""></Link>
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
import { Link } from "@inertiajs/vue3";
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