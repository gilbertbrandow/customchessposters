<template>
    <div v-if="$page.props.addToCart && Object.keys($page.props.addToCart).length && $page.props.overlay == 'addToCart'" class="content variants-overlay">
        <button class="link-arrow is--close" @click="this.$page.props.overlay = false">
            Close <Icon name="close" />
        </button>

        <div class="container">
            <h2 class="is--margin-bottom">Poster "{{ $page.props.addToCart.title }}"</h2>

            <VariantPicker @variant="recieveVariant" />

            <PosterAddToCart :variant="this.$data.variant" :poster="$page.props.addToCart" :total="this.$data.total" />
        </div>
    </div>
</template>

<script>
import UnitSwitcher from './UnitSwitcher.vue'
import PosterAddToCart from './PosterAddToCart.vue'
import VariantPicker from './VariantPicker.vue'

export default {
    components: {
        UnitSwitcher,
        VariantPicker,
        PosterAddToCart,
    },


    data() {
        return {
            total: 0,
            variant: null,
        }
    },

    methods: {
        recieveVariant(emitted) {
            this.$data.total = emitted.total;
            this.$data.variant = emitted.variant
        }
    }
}
</script>