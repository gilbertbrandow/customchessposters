<template>
    <div class="is--flex">
        <button class="button is--black" @click="this.addToCart()" :disabled="!this.$props.variant">
            {{ !this.$props.variant ? 'Choose a size' : 'Add to cart' }}
            <Icon :name="this.$props.variant ? 'cart' : ''" />
        </button>

        <span style="font-size: 2em;">€{{ (this.total / 100).toFixed(2) }}</span>
    </div>
</template>

<script>
import { router } from '@inertiajs/vue3'

export default {

    props: {
        variant: null,
        poster: {},
        total: 0,
    },

    data() {
        return {
        }
    },

    methods: {
        addToCart() {
            router.visit('/product', {
                method: 'post',
                data: {
                    poster_data: this.$props.poster,
                    variant: this.$props.variant,
                },
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    this.$page.props.overlay = false;
                    this.$page.props.addToCart = [];
                }
            })
        },
    },
}
</script>