<template>
    <button class="button is--black"
        @click="$page.props.addToCart = this.poster, $page.props.overlay = 'addToCart';">
        Add To Cart
        <Icon name="cart" />
    </button>
</template>

<script>

export default {
    props: {
        poster: {},
    },
}
</script>