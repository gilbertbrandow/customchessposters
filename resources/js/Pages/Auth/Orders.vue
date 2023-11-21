<template>
        <section>
        <h1>Orders</h1>
        {{ this.$page.props.orders }}
    </section>
</template>

<script>
import App from "../../Layouts/App.vue";
import AccountNav from "../../Layouts/AccountNav.vue";

export default {
    layout: (h, page) => {
        return h(App, () => h(AccountNav, () => page))
    },

    components: {
    },
}
</script>