<template>
    <section>
        <h1>Account</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porttitor suscipit eros, tincidunt tempus
            nisl pulvinar at. Duis erat turpis, finibus sit amet fringilla in, laoreet vitae neque. Cras tincidunt felis
            vitae rutrum tincidunt. Nullam laoreet ipsum eu metus facilisis facilisis. Sed nec enim luctus urna imperdiet
            efficitur. Integer viverra turpis cursus cursus vulputate. Aliquam ullamcorper eleifend fringilla. Aliquam
            laoreet est sit amet dolor aliquam cursus. Mauris eu dictum libero, at venenatis libero.</p>
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