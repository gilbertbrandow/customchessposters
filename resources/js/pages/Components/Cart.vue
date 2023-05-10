<template>
    <div v-if="this.$page.props.overlay == 'cart'" class="content slide-out cart-wrp">
        <button class="button__rnd-icn" @click="this.$page.props.overlay = false">
            <Icon name="close" />
        </button>
        <h2>Cart</h2>
        <ul class="cart-items">
            <li v-if="!this.$page.props.cart.length">
                No items in your cart
            </li>
            <li v-for="item in this.$page.props.cart">
                <template v-if="item.type == 'Poster'">
                    <Poster :poster="item" environment="/images/environments/builder-mockup.jpeg" />
                    <div class="content">
                        <h3 v-text="item.name"></h3>
                        <span>{{ 'Size: ' + item.width + ' x ' + item.height + ' cm' }}</span>

                        <div><strong v-text="'$' + item.price / 100"></strong> x {{ 'Quantity: ' + item.quantity }}</div>
                        <Link class="text_link" :href="route('poster.show', { 'id': item.id })">Edit poster</Link>
                    </div>
                </template>
            </li>
        </ul>
        <div class="button is--cart is--flex is--space-between">Total: <span>${{ total / 100 }}</span></div>
        <button v-if="this.$page.props.cart.length"
            class="button is--black is--less-border-radius is--flex is--space-between">Checkout
            <Icon name="arrow-right" />
        </button>
    </div>
</template>

<script>
import Icon from '../../Icons/Icon.vue'
import Poster from '../Components/Poster.vue'
import { Link } from "@inertiajs/vue3";

export default {

    components: {
        Poster,
        Link,
    },

    props: {

    },

    data() {
        return {

        }
    },

    computed: {
        total() {

            let total = 0;

            this.$page.props.cart.forEach(element =>

                total += element.price * element.quantity
            );

            return total;
        },
    },

    methods: {
    },
}
</script>