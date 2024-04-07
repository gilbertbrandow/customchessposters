<template>
    <nav class="is--scrolled">
        <div class="container">
            <Logotype />
            <div class="nav__wrp">
                <Link class="text__link" :href="route('game.index')"
                    >Game collection</Link
                >
                <Link class="text__link" :href="route('poster.index')"
                    >Create your poster</Link
                >
                <Link
                    @mouseover="resetFlash()"
                    :href="route('user.index')"
                    v-if="$page.props.auth"
                    class="nav__button"
                >
                    <div
                        class="info"
                        :class="[
                            $page.props.flash.account.success &&
                            !$page.props.flash.saved.success
                                ? 'active'
                                : '',
                        ]"
                    >
                        <div></div>
                        {{
                            $page.props.flash.account.success
                                ? $page.props.flash.account.success
                                : "Your Account (" +
                                  $page.props.auth.user.name +
                                  ")"
                        }}
                    </div>
                    <Icon name="user" />
                </Link>
                <Link
                    @mouseover="resetFlash()"
                    :href="route('login.index')"
                    v-else
                    class="nav__button"
                    preserve-scroll
                    preserve-state
                >
                    <div class="info">
                        <div></div>
                        Sign in
                    </div>
                    <Icon name="user" />
                </Link>
                <Link
                    @mouseover="resetFlash()"
                    :href="route('savedPoster.index')"
                    class="nav__button"
                    :preserve-scroll="!$page.props.auth"
                    :preserve-state="!$page.props.auth"
                >
                    <div
                        class="info"
                        :class="{ active: $page.props.flash.saved.success }"
                    >
                        <div></div>
                        {{
                            $page.props.flash.saved.success
                                ? $page.props.flash.saved.success
                                : "Your saved designs"
                        }}
                    </div>
                    <Icon name="bookmark" />
                </Link>
                <button
                    class="nav__button"
                    @mouseover="resetFlash()"
                    @click="this.$page.props.overlay = 'cart'"
                >
                    <div
                        class="info"
                        :class="{ active: $page.props.flash.cart.success }"
                    >
                        <div></div>
                        {{
                            $page.props.flash.cart.success
                                ? $page.props.flash.cart.success
                                : "Your cart"
                        }}
                    </div>
                    <Icon name="cart" />
                    <div
                        v-if="$page.props.cart?.count"
                        v-text="$page.props.cart.count"
                        class="notification"
                    ></div>
                </button>
            </div>
        </div>
    </nav>
    <Overlay></Overlay>
    <main>
        <slot> </slot>
    </main>
    <footer>
        <div class="container">
            <div class="footer__top">
                <div class="footer__info">
                    <Logotype />
                    <p>
                        Put your favorite game on display. You get complete
                        freedom to design and create your very own poster or
                        choose a design from our game collection.
                    </p>
                    <PaymentMethods />
                </div>
                <div>
                    <h4>Links</h4>
                    <ul>
                        <li>
                            <Link :href="route('faq.index')"
                                >Frequently Asked Questions</Link
                            >
                        </li>
                        <li>
                            <Link :href="route('poster.index')"
                                >Create your own poster</Link
                            >
                        </li>
                        <li>
                            <Link :href="route('game.index')"
                                >Game collection</Link
                            >
                        </li>
                        <li>
                            <Link :href="route('user.index')" preserve-scroll
                                >My Account</Link
                            >
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
                            <Link :href="route('home.shipping')"
                                >Shipping policy</Link
                            >
                        </li>
                        <li>
                            <Link :href="route('home.return')"
                                >Return policy</Link
                            >
                        </li>
                        <li>
                            <Link :href="route('home.privacy')"
                                >Privacy policy</Link
                            >
                        </li>
                    </ul>
                </div>
                <div>
                    <h4>Contact information</h4>
                    <ul>
                        <li>
                            Simon Gustafssson
                            <a
                                target="_blank"
                                href="https://github.com/gilbertbrandow"
                                >(@gilbertbrandow)</a
                            >
                        </li>
                        <li>
                            <a href="mailto:hej@0100.se">simon@0100.se</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer__bottom">
                <span
                    >All rights reserved © {{ new Date().getFullYear() }} Custom
                    Chess Poster
                </span>
                <span
                    >Powered by
                    <a target="_blank" href="https://0100.se">0100</a></span
                >
            </div>
        </div>
    </footer>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import Newsletter from "../Pages/Components/Newsletter.vue";
import Overlay from "../Pages/Components/Overlay.vue";
import Logotype from "../Pages/Components/Logotype.vue";
import PaymentMethods from "../Pages/Components/PaymentMethods.vue";

export default {
    components: {
        Link,
        Newsletter,
        Overlay,
        Logotype,
        PaymentMethods,
    },

    methods: {
        resetFlash() {
            this.$page.props.flash.account.success = "";
            this.$page.props.flash.saved.success = "";
            this.$page.props.flash.cart.success = "";
        },
    },
};
</script>
