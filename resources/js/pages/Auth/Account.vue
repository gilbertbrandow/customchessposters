<template>
    <section>
        <h1>Account</h1>
        <Link :href="route('auth.logout')" method="post" as="button"> Log out</Link>
    </section>
</template>

<script>
import App from "../../Layouts/App.vue";
import AccountNav from "../../Layouts/AccountNav.vue";


export default {
    layout: (h, page) => {
        return h(App, () => h(AccountNav, () => page))
    },
}
</script>