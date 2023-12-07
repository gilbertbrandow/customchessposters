<template>
    <section>
        <h1>Orders</h1>
        {{ this.$data.orders }}
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
                .get("/api/orders?user=" + this.$page.props.auth.user.id + '&not_status=pending')
                .then((response) => (this.$data.orders = response.data.data))
                .catch((error) => console.error(error));
        },
    },

    mounted() {
        this.getOrders();
    },
};
</script>
