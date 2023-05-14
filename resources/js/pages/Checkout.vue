<template>
    {{ this.cart }}
</template>

<script>
    export default {
        data() {
            return {
                cart: this.$page.props.cart,
            }
        }
    }
</script>