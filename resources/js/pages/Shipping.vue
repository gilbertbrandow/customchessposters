<template>
    <div class="content">
        <h2>Shipping</h2>
    </div>
</template>

<script>
import Checkout from "../Layouts/Checkout.vue";

export default {
    layout: Checkout,

    data() {
        return {
            cart: this.$page.props.cart,
        }
    }
}
</script>