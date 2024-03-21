<template>
    <div
        v-if="$page.props.overlay == 'cart'"
        class="content slide-out cart-wrp"
    >
        <button
            class="link-arrow is--close"
            @click="$page.props.overlay = false"
        >
            Close
            <Icon name="close" />
        </button>
        <h2>Cart</h2>
        <ul class="items cart-items">
            <li v-if="!this.cart?.items.length">No items in your cart</li>
            <li v-else v-for="item in this.cart.items">
                <template v-if="item.product.type == 'poster'">
                    <Poster
                        :poster="item.product.poster"
                        :controls="{ small: true }"
                        :environment="item.product.frame ?? 0"
                    />
                    <div class="content">
                        <h3 v-text="item.product.poster.title"></h3>
                        <span
                            >{{
                                ($page.props.unit
                                    ? item.product.width +
                                      " x " +
                                      item.product.height +
                                      " cm, "
                                    : Math.round(item.width * 0.393700787) +
                                      '" x ' +
                                      Math.round(
                                          item.product.height * 0.393700787
                                      ) +
                                      '", ') +
                                (item.product.frame
                                    ? item.product.frame + " frame"
                                    : "")
                            }}
                            <Link
                                class="text__link"
                                :href="
                                    route('poster.show', {
                                        id: item.product.poster.id,
                                    })
                                "
                                >see poster</Link
                            >
                        </span>

                        <div class="is--flex">
                            <strong
                                v-text="
                                    '$' + (item.product.price / 100).toFixed(2)
                                "
                            ></strong>
                            x
                            <input
                                type="number"
                                min="1"
                                :value="item.quantity"
                                name="quantity"
                                @change="
                                    this.updateCartItem(
                                        item.id,
                                        $event.target.value
                                    )
                                "
                            />
                            <button
                                class="text__link"
                                type="submit"
                                @click="this.deleteCartItem(item.id)"
                            >
                                Remove item
                            </button>
                        </div>
                    </div>
                </template>
            </li>
        </ul>
        <div class="button is--cart is--flex is--space-between">
            Total: <span>${{ total ? (total / 100).toFixed(2) : 0 }}</span>
        </div>
        <Link
            :href="route('checkout.index')"
            v-if="this.cart && this.cart.items.length"
            class="button is--black is--less-border-radius is--flex is--space-between"
            >Checkout
            <Icon name="arrow-right" />
        </Link>
    </div>
</template>

<script>
import Icon from "../../Icons/Icon.vue";
import Poster from "../Components/Poster.vue";
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import axios from "axios";

export default {
    components: {
        Poster,
        Link,
    },

    data() {
        return {
            cart: null,
            form: useForm({
                id: null,
                quantity: null,
                remove: null,
            }),
        };
    },

    computed: {
        total() {
            if (!this.cart) return;

            let total = 0;

            this.cart.items.forEach(
                (item) => (total += item.product.price * item.quantity)
            );

            return total;
        },
    },

    methods: {
        updateCartItem(id, quantity) {
            axios
                .put("/api/cart-items/" + id, {
                    quantity: quantity,
                })
                .then((response) => this.getCart())
                .catch((error) => console.error(error));
        },

        deleteCartItem(id) {
            axios
                .delete("/api/cart-items/" + id)
                .then((response) => this.getCart())
                .catch((error) => console.error(error));
        },

        getCart() {
            if (
                this.$page.props.overlay != "cart" ||
                !this.$page.props.cart?.id
            )
                return;

            axios
                .get("/api/carts/" + this.$page.props.cart.id)
                .then(
                    (response) => (
                        this.$data.cart = response.data.data,
                        this.$page.props.cart.count = response.data.data.count
                    )
                )
                .catch((error) => console.error(error));
        },
    },

    mounted() {
        this.getCart();
    },
};
</script>
