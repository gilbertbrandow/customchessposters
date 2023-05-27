<template>
    <Overlay></Overlay>
    <header>
        <div class="container is--less-padding is--flex is--space-between">
            <Logotype />
            <div class="checkout__navigation">
                <Link :href="route('shipping.index', { orderId: this.$page.props.route.params.orderId })"
                    :class="{ 'is--active': $page.url.includes('information') }">
                <Icon v-if="!$page.url.includes('information') && this.$page.props.address" name="checked" />
                <span v-else>1. </span>
                Information
                </Link>
                <Link :href="route('shippingMethod.index', { orderId: this.$page.props.route.params.orderId })"
                    :class="{ 'is--active': $page.url.includes('shipping-methods') }">
                <Icon v-if="!$page.url.includes('shipping-method') && this.$page.props.shippingMethod" name="checked" />
                <span v-else>2. </span>
                Shipping Methods
                </Link>
                <Link :href="route('home.index')">3. Payment</Link>

            </div>
        </div>
    </header>
    <main>
        <section class="is--no-pt">
            <div class="container is--flex is--less-padding">
                <div class="content card">
                    <slot>
                    </slot>
                </div>
                <div class="order__summary">
                    <h3>Your order</h3>
                    <div class="order__recipient" v-if="this.$page.props.address">
                        <div class="is--flex is--space-between">
                            <span><strong>Contact: </strong> {{ this.$page.props.address.email }}</span>
                            <Link class="text__link"
                                :href="route('shipping.index', { orderId: this.$page.props.route.params.orderId })">Edit
                            </Link>
                        </div>
                        <div class="divider"></div>
                        <div class="is--flex is--space-between">
                            <span><strong>Send to:</strong> {{ this.$page.props.address.country + ', ' +
                                this.$page.props.address.address1 + ', ' + this.$page.props.address.zip + ' ' +
                                this.$page.props.address.city }}</span>
                            <Link class="text__link"
                                :href="route('shipping.index', { orderId: this.$page.props.route.params.orderId })">Edit
                            </Link>
                        </div>
                    </div>

                    <ul class="cart-items" style="height: auto; overflow: visible;">
                        <li v-for="item in this.$page.props.cart">
                            <template v-if="item.type == 'Poster'">
                                <h4 v-text="item.name"></h4>
                                <div class="is--flex">
                                    <span>{{ 'Size: ' + item.width + ' x ' + item.height + ' cm, ' }}
                                    </span>
                                    <span><strong v-text="'$' + item.price / 100"></strong> x {{ item.quantity }}</span>
                                    <button class="text__link"
                                        @click="this.$page.props.lightbox = item, this.$page.props.overlay = 'lightbox';">
                                        <span>See Poster Design</span>
                                        <Icon name="fullScreen" />
                                    </button>
                                </div>
                            </template>
                        </li>
                    </ul>
                    <ul>
                        <li class="is--flex is--space-between is--border-bottom">
                            <h4>Subtotal</h4><span>$ {{ (subtotal / 100).toFixed(2) }}</span>
                        </li>
                        <li v-if="this.$page.props.shippingMethod.length" class="is--flex is--no-column-gap is--border-bottom">
                            <h4>Shipping </h4>
                            <span class="is--small"
                                style="flex: 1; margin-left: 1em; text-transform: capitalize;">{{
                                    this.$page.props.shippingMethod.shipping.toLowerCase().replace(/_/g, ' ') }}</span><span>$
                                {{
                                    (this.$page.props.shippingMethod.shipping_cost / 100).toFixed(2) }}</span>
                        </li>
                        <li class="is--flex is--no-column-gap is--border-bottom">
                            <h4>Total </h4><span class="is--small" style="flex: 1; margin-left: 1em">Including $ {{ (total /
                                500).toFixed(2) }} in
                                taxes</span><span>$ {{ (total / 100).toFixed(2) }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import Logotype from '../Pages/Components/Logotype.vue'
import Poster from '../Pages/Components/Poster.vue'
import Overlay from "../Pages/Components/Overlay.vue"
import Icon from "../Icons/Icon.vue"

export default {
    components: {
        Overlay,
        Logotype,
        Poster,
        Icon,
    },

    computed: {
        subtotal() {

            if (!this.$page.props.cart) return 0;

            let subtotal = 0;

            this.$page.props.cart.forEach(element =>
                subtotal += element.price * element.quantity
            );

            return subtotal;
        },

        total() {

            return this.$page.props.shippingMethod.length ? this.subtotal + this.$page.props.shippingMethod.shipping_cost : this.subtotal;
        }
    },

    mounted() {
    }
}
</script>