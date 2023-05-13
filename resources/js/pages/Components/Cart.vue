<template>
    <div v-if="this.$page.props.overlay == 'cart'" class="content slide-out cart-wrp">
        <button class="button__rnd-icn" @click="this.$page.props.overlay = false">
            <Icon name="close" />
        </button>
        <h2>Cart</h2>
        <ul class="cart-items">
            <li v-if="!this.$page.props.cart || !this.$page.props.cart.length">
                No items in your cart
            </li>
            <li v-else v-for="item in this.$page.props.cart">
                <template v-if="item.type == 'Poster'">
                    <Poster :poster="item" environment="/images/environments/builder-mockup.jpeg" />
                    <div class="content">
                        <h3 v-text="item.name"></h3>
                        <span>{{ 'Size: ' + item.width + ' x ' + item.height + ' cm, ' }}
                            <Link class="text__link" :href="route('poster.show', { 'id': item.id })">see poster</Link>
                        </span>

                        <div>
                            <strong v-text="'$' + item.price / 100"></strong> x Quantity: 
                            <input type="number" :value="item.quantity" @change="this.updateCart(item.itemId, false, $event)"/>
                            <button class="text__link" type="submit" @click="this.updateCart(item.itemId, true)">remove item from cart</button>
                        </div>

                    </div>
                </template>
            </li>
        </ul>
        <div class="button is--cart is--flex is--space-between">Total: <span>${{ total / 100 }}</span></div>
        <button v-if="this.$page.props.cart && this.$page.props.cart.length"
            class="button is--black is--less-border-radius is--flex is--space-between">Checkout
            <Icon name="arrow-right" />
        </button>
    </div>
</template>

<script>
import Icon from '../../Icons/Icon.vue'
import Poster from '../Components/Poster.vue'
import { Link } from "@inertiajs/vue3";
import { useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import axios from 'axios'

export default {

    components: {
        Poster,
        Link,
    },

    props: {

    },

    data() {
        return {
            form: useForm({
                id: null,
                quantity: null,
                remove: null,
            })
        }
    },

    computed: {
        total() {

            if (!this.$page.props.cart) return;

            let total = 0;

            this.$page.props.cart.forEach(element =>

                total += element.price * element.quantity
            );

            return total;
        },
    },

    methods: {
        updateCart(id, remove, event) {

            router.visit('/cart-item/' + (remove ? 'destroy/' : 'update/') + id, {
                method: 'post',
                data: {
                    quantity: !remove ? event.target.value : null,
                },
                preserveScroll: true,

                onFinish: visit => {
                    axios
                        .get('/cart')
                        .then(response => (
                            this.$page.props.overlay = 'cart',
                            this.$page.props.cart = response.data
                        ))
                        .catch(() => (
                            console.log(error)
                        ))
                },
            })


        },
    },
}
</script>