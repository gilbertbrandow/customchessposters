<template>
  <nav class="is--scrolled">
    <div class="container">
      <Link class="logo" :href="route('home.index')">
      <img src="../../../public/images/ccp-icn.svg" alt="">
      <div>{{ $page.props.site.title }}</div>
      </Link>
      <div class="nav__wrp">
        <div class="dropdown"><img src="" /> USA / USD $</div>
        <Link :href="route('auth.account')" v-if="$page.props.auth" class="nav__button">
        <div class="info" :class="{active: $page.props.flash.account.success}">
          <div></div> {{ $page.props.flash.account.success ? $page.props.flash.account.success : 'Your Account (' + $page.props.auth.user.name + ')'}}
        </div>
        <Icon name="user" />
        </Link>
        <Link :href="route('auth.login')" v-else class="nav__button" preserve-scroll>
        <div class="info">
          <div></div>Sign in
        </div>
        <Icon name="user" />
        </Link>
        <Link :href="route('auth.saved')" class="nav__button" preserve-scroll>
        <div class="info" :class="{active: $page.props.flash.saved.success}">
          <div></div> {{ $page.props.flash.saved.success ? $page.props.flash.saved.success : 'Your saved designs' }}
        </div>
        <Icon name="bookmark" />
        </Link>
        <Link :href="route('home.index')" class="nav__button">
        <div class="info">
          <div></div>Cart
        </div>
        <Icon name="cart" />
        </Link>
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
      <Newsletter />
      <div class="footer__bottom">
        <div>All rättigheter reserverade © {{ new Date().getFullYear() }} Custom Chess Poster. Powered by <a
            href="https://0100.se">0100</a></div>
        <Link :href="route('policy.shipping')">Shipping information</Link>
        <Link :href="route('policy.return')">Return policy</Link>
        <Link :href="route('policy.privacy')">Privacy policy</Link>
      </div>
    </div>
  </footer>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import Newsletter from "../Pages/Components/Newsletter.vue"
import Overlay from "../Pages/Components/Overlay.vue"

export default {
  components: {
    Link,
    Newsletter,
    Overlay,
},
}
</script>