<template>
    <section>
        <h1>Orders</h1>
        <div v-for="order in this.orders" class="card" :key="order.id">
            <h2>Order number #{{ order.id }}</h2>
            <div class="status" :class="[order.status.toLowerCase()]">{{ order.status }}</div>
            <ul>
                <li class="is--flex is--space-between is--border-bottom">
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
                <li class="is--flex is--no-column-gap is--border-bottom">
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

    components: {},

    methods: {
        getOrders() {
            axios
                .get(
                    "/api/orders?user=" +
                        this.$page.props.auth.user.id +
                        "&not_status=pending"
                )
                .then((response) => (this.$data.orders = response.data.data))
                .catch((error) => console.error(error));
        },
    },

    mounted() {
        this.getOrders();
    },
};
</script>
