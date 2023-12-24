<template>
    <section>
        <h1>Orders</h1>
        <div v-for="order in this.orders" class="card" :key="order.id">
            <h2>Order number #{{ order.id }}</h2>
            <div class="status" :class="[order.status.toLowerCase()]">
                {{ order.status }}
            </div>
            <h4>Items</h4>
            <ul class="items">
                <li v-for="item in order.items">
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
                                        '$' +
                                        (item.product.price / 100).toFixed(2)
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
            
            <ul class="is--margin-top-2 is--no-margin-bottom">
                <li
                    class="is--flex is--space-between is--border-bottom is--margin-bottom"
                >
                    <h4>Subtotal</h4>
                    <span
                        >€
                        {{
                            ((order.total - order.shipping.cost) / 100).toFixed(
                                2
                            )
                        }}</span
                    >
                </li>
                <li
                    class="is--flex is--no-column-gap is--border-bottom is--margin-bottom"
                >
                    <h4>Shipping</h4>
                    <span
                        class="is--small"
                        style="
                            flex: 1;
                            margin-left: 1em;
                            text-transform: capitalize;
                        "
                        >{{ order.shipping.name }}</span
                    ><span>€ {{ (order.shipping.cost / 100).toFixed(2) }}</span>
                </li>
                <li class="is--flex is--no-column-gap is--border-bottom">
                    <h4>Total</h4>
                    <span class="is--small" style="flex: 1; margin-left: 1em"
                        >Including €
                        {{ (order.total * 0.002).toFixed(2) }}
                        in taxes</span
                    ><span
                        >€
                        {{ (order.total / 100).toFixed(2) }}
                    </span>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
import App from "../../Layouts/App.vue";
import Poster from "../Components/Poster.vue";
import AccountNav from "../../Layouts/AccountNav.vue";
import axios from "axios";

export default {
    layout: (h, page) => {
        return h(App, () => h(AccountNav, () => page));
    },

    data() {
        return {
            orders: [],
        };
    },

    components: {
        Poster,
    },

    methods: {
        getOrders() {
            axios
                .get(
                    "/api/orders?user=" +
                        this.$page.props.auth.user.id +
                        "&not_status=pending"
                )
                .then(
                    (response) => (
                        (this.$data.orders = response.data.data),
                        console.log(response)
                    )
                )
                .catch((error) => console.error(error));
        },
    },

    mounted() {
        this.getOrders();
    },
};
</script>
