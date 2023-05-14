<template>
    <div v-if="this.$page.props.overlay == 'cart'" class="content slide-out cart-wrp">
        <button class="button__rnd-icn" @click="this.$page.props.overlay = false">
            <Icon name="close" />
        </button>
        <h2>Cart</h2>
        <ul class="cart-items">
            <li v-if="!this.cart || !this.cart.length">
                No items in your cart
            </li>
            <li v-else v-for="item in this.cart">
                <template v-if="item.type == 'Poster'">
                    <Poster :poster="item" environment="/images/environments/builder-mockup.jpeg" />
                    <div class="content">
                        <h3 v-text="item.name"></h3>
                        <span>{{ 'Size: ' + item.width + ' x ' + item.height + ' cm, ' }}
                            <Link class="text__link" :href="route('poster.show', { 'id': item.id })">see poster</Link>
                        </span>

                        <div class="is--flex">
                            <strong v-text="'$' + item.price / 100"></strong> x
                            <input type="number" :value="item.quantity" @change="this.updateCart(item.itemId, false, $event.target.value)"/>
                            <button class="text__link" type="submit" @click="this.updateCart(item.itemId, true)">Remove item</button>
                        </div>

                    </div>
                </template>
            </li>
        </ul>
        <div class="button is--cart is--flex is--space-between">Total: <span>${{ total / 100 }}</span></div>
        <button v-if="this.cart && this.cart.length"
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

export default {

    components: {
        Poster,
        Link,
    },

    data() {
        return {
            cart: this.$page.props.cart,
            form: useForm({
                id: null,
                quantity: null,
                remove: null,
            })
        }
    },

    computed: {
        total() {

            if (!this.cart) return;

            let total = 0;

            this.cart.forEach(element =>

                total += element.price * element.quantity
            );

            return total;
        },
    },

    methods: {
        updateCart(id, remove, quantity) {

            router.visit('/cart-item/' + (remove ? 'destroy/' : 'update/') + id, {
                method: 'post',
                data: {
                    quantity: !remove ? quantity : null,
                },
                preserveScroll: true,
                preserveState: true,

                onFinish: visit => {

                    //Update cart content only in frontend instead of new axios request
                    for(let i = 0; i < this.cart.length; i++) {
                        if(this.cart[i].itemId == id && remove) this.cart.splice(i, 1);
                        if(this.cart[i].itemId == id && quantity) this.cart[i].quantity = quantity;
                    }
                },
            })


        },
    },
}
</script>