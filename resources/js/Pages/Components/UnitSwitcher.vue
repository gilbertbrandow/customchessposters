<template>
    <div class="switcher-wrp is--margin-top">
        <span :class="this.$page.props.unit ? 'is--active' : ''">Centimeters (cm)</span>
        <button :class="this.$page.props.unit ? 'switcher' : 'switcher is--right'" @click="this.submit()">
            <div></div>
        </button>
        <span :class="!this.$page.props.unit ? 'is--active' : ''">Inches (")</span>
    </div>
</template>

<script>
import { router } from '@inertiajs/vue3';

export default {


    methods: {

        submit() {
            router.visit('/unit', {
                method: 'post',
                data: {
                    unit: !this.$page.props.unit,
                    overlay: this.$page.props.overlay,
                    addToCart: this.$page.props.addToCart,
                },
                preserveState: true,
                preserveScroll: true,
            })
        },
    }
}
</script>