<template>
    <section>
        <h1>Account</h1>
        <p>This is your account page. Currently you are able to see your saved posters. More features are coming soon. Do you have any suggestion or wishes? <Link :href="route('contact.index')" class="text__link">Pease contact us here!</Link> </p>
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