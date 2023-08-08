<template>
    <div v-if="$page.props.addToCart &&  Object.keys($page.props.addToCart).length" class="content variants-overlay">
        <button class="button is--only-icon is--outline" @click="$page.props.addToCart = [], $page.props.overlay = false">
            <Icon name="close" />
        </button>

        <div class="container">
            <h2 class="is--margin-bottom">Poster "{{ $page.props.addToCart.title }}"</h2>

            <VariantPicker  @variant="recieveVariant"/>

            <PosterAddToCart :variant="this.$data.variant" :poster="$page.props.addToCart" :total="this.$data.total"/>
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