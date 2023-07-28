<template>
    <Overlay></Overlay>
    <header class="checkout__header">
        <div class="container is--less-padding is--flex is--space-between">
            <Logotype />
            <div class="checkout__navigation">
                <Link :href="route('shipping.index', { orderId: $page.props.route.params.orderId })"
                    :class="{ 'is--active': $page.url.includes('information') }">
                <Icon v-if="!$page.url.includes('information') && $page.props.address" name="checked" />
                <span v-else>1. </span>
                Information
                </Link>
                <Link :href="route('shippingMethod.index', { orderId: $page.props.route.params.orderId })"
                    :class="{ 'is--active': $page.url.includes('shipping-methods') }">
                <Icon v-if="!$page.url.includes('shipping-method') && $page.props.shippingMethod" name="checked" />
                <span v-else>2. </span>
                Shipping Methods
                </Link>
                <Link :href="route('payment.index', { orderId: $page.props.route.params.orderId })">3. Payment</Link>

            </div>
        </div>
    </header>
    <main>
        <section class="is--no-pt">
            <div class="container is--flex is--less-padding  is--checkout">
                <div class="content card">
                    <slot>
                    </slot>
                </div>
                <div class="order__summary">
                    <h3>Your order</h3>
                    <div class="order__recipient" v-if="$page.props.address">
                        <div class="is--flex is--space-between">
                            <span><strong>Contact: </strong> {{ $page.props.address.email }}</span>
                            <Link class="text__link"
                                :href="route('shipping.index', { orderId: $page.props.route.params.orderId })">Edit
                            </Link>
                        </div>
                        <div class="divider"></div>
                        <div class="is--flex is--space-between">
                            <span><strong>Send to:</strong> {{ $page.props.address.country + ', ' +
                                $page.props.address.address1 + ', ' + $page.props.address.zip + ' ' +
                                $page.props.address.city }}</span>
                            <Link class="text__link"
                                :href="route('shipping.index', { orderId: $page.props.route.params.orderId })">Edit
                            </Link>
                        </div>
                    </div>

                    <ul class="cart-items" style="height: auto; overflow: visible;">
                        <li v-for="item in $page.props.cart">
                            <template v-if="item.type == 'poster'">
                                <strong class="is--larger" v-text="item.name"></strong>
                                <div class="is--flex is--margin-top">
                                    <span>{{ 'Size: ' + item.width + ' x ' + item.height + ' cm, ' }}
                                    </span>
                                    <span><strong v-text="'$' + item.price / 100"></strong> x {{ item.quantity }}</span>
                                    <button class="text__link"
                                        @click="$page.props.lightbox = item, $page.props.overlay = 'lightbox';">
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
                        <li v-if="$page.props.shippingMethod.shipping" class="is--flex is--no-column-gap is--border-bottom">
                            <h4>Shipping </h4>
                            <span class="is--small"
                                style="flex: 1; margin-left: 1em; text-transform: capitalize;">{{
                                    $page.props.shippingMethod.shipping.toLowerCase().replace(/_/g, ' ') }}</span><span>$
                                {{
                                    ($page.props.shippingMethod.shipping_cost / 100).toFixed(2) }}</span>
                        </li>
                        <li class="is--flex is--no-column-gap is--border-bottom">
                            <h4>Total </h4><span class="is--small" style="flex: 1; margin-left: 1em">Including $ {{ (($page.props.shippingMethod ? subtotal + $page.props.shippingMethod.shipping_cost : subtotal) /
                                500).toFixed(2) }} in
                                taxes</span><span>$ {{ (($page.props.shippingMethod ? subtotal + $page.props.shippingMethod.shipping_cost : subtotal) / 100).toFixed(2) }}</span>
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
    },

    mounted() {
    }
}
</script>