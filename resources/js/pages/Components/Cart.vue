<template>
    <div v-if="this.$page.props.overlay.cart" class="content slide-out">
        <button class="button__rnd-icn" @click="this.$page.props.overlay.visible = false, this.$page.props.overlay.cart = false">
            <Icon name="close" />
        </button>
        <h2>Cart</h2>
        {{ this.$page.props.cart }}
    </div>
</template>

<script>
export default {
    props: {

    },

    data() {
        return {

        }
    },

    methods: {

    }
}
</script>