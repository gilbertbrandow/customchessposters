<template>
  <nav class="is--scrolled">
    <div class="container">
      <Logotype />
      <div class="nav__wrp">
        <div class="dropdown"><img src="" /> USA / USD $</div>
        <Link @mouseover="resetFlash()" :href="route('user.index')" v-if="$page.props.auth" class="nav__button">
        <div class="info"
          :class="[($page.props.flash.account.success && !$page.props.flash.saved.success) ? 'active' : '']">
          <div></div> {{ $page.props.flash.account.success ? $page.props.flash.account.success : 'Your Account (' +
            $page.props.auth.user.name + ')' }}
        </div>
        <Icon name="user" />
        </Link>
        <Link @mouseover="resetFlash()" :href="route('login.index')" v-else class="nav__button" preserve-scroll
          preserve-state>
        <div class="info">
          <div></div>Sign in
        </div>
        <Icon name="user" />
        </Link>
        <Link @mouseover="resetFlash()" :href="route('savedPoster.index')" class="nav__button" preserve-scroll
          preserve-state>
        <div class="info" :class="{ active: $page.props.flash.saved.success }">
          <div></div> {{ $page.props.flash.saved.success ? $page.props.flash.saved.success : 'Your saved designs' }}
        </div>
        <Icon name="bookmark" />
        </Link>
        <button class="nav__button" @mouseover="resetFlash()" @click="fetchCart()">
          <div class="info" :class="{ active: $page.props.flash.cart.success }">
            <div></div> {{ $page.props.flash.cart.success ? $page.props.flash.cart.success : 'Your cart' }}
          </div>
          <Icon name="cart" />
          <div v-if="this.$page.props.cartCount" v-text="this.$page.props.cartCount" class="notification"></div>
        </button>
      </div>
    </div>
  </nav>
  <Overlay></Overlay>
  <main>
    <slot>
    </slot>

  </main>
  <footer>
    <div class="container">
      <div class="footer__top">
        <div class="footer__info">
          <Logotype />
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.
            Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat.
          </p>
          <PaymentMethods/>
        </div>
        <div>
          <h4>Links</h4>
          <ul>
            <li>
              <Link :href="route('faq.index')">Frequently Asked Questions</Link>
            </li>
            <li>
              <Link :href="route('poster.index')">Create your own poster</Link>
            </li>
            <li>
              <Link :href="route('game.index')">Game collection</Link>
            </li>
            <li>
              <Link :href="route('user.index')" preserve-scroll>My Account</Link>
            </li>
            <li>
              <Link :href="route('contact.index')">Contact</Link>
            </li>
          </ul>
        </div>
        <div>
          <h4>Terms & Conditions</h4>
          <ul>
            <li>
              <Link :href="route('home.shipping')">Shipping information</Link>
            </li>
            <li>
              <Link :href="route('home.return')">Return policy</Link>
            </li>
            <li>
              <Link :href="route('home.privacy')">Privacy policy</Link>
            </li>
          </ul>
        </div>
        <div>
          <h4>Social</h4>
          <a href="mailto:info@customchessposters.com">info@customchessposters.com</a>
        </div>
      </div>
      <div class="footer__bottom">
        <span>All rättigheter reserverade © {{ new Date().getFullYear() }} Custom Chess Poster </span>
        <span>Powered by <a href="https://0100.se">0100</a></span>
      </div>
    </div>
  </footer>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import Newsletter from "../Pages/Components/Newsletter.vue"
import Overlay from "../Pages/Components/Overlay.vue"
import Logotype from "../Pages/Components/Logotype.vue"
import PaymentMethods from "../Pages/Components/PaymentMethods.vue"
import axios from 'axios'

export default {
  components: {
    Link,
    Newsletter,
    Overlay,
    Logotype, 
    PaymentMethods
  },

  methods: {
    resetFlash() {
      this.$page.props.flash.account.success = '';
      this.$page.props.flash.saved.success = '';
      this.$page.props.flash.cart.success = '';
    },

    fetchCart() {
      axios
        .get('/cart')
        .then(response => (
          this.$page.props.overlay = 'cart',
          this.$page.props.cart = response.data
        ))
        .catch((error) => (
          console.log(error)
        ))
    },
  }
}
</script>