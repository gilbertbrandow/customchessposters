<template>
    <button class="button is--black"
        @click="this.$page.props.addToCart = this.poster, this.$page.props.overlay = 'addToCart';">
        Add To Cart
        <Icon name="cart" />
    </button>
</template>

<script>

export default {
    props: {
        poster: {},
    },

    data() {
        return {
            sizes: false,
            unit: true,
        }
    },
}
</script>