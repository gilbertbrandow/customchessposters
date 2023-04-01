<template>
    <aside class="overlay" v-if="this.$page.props.overlay.visible">
        <Lightbox></Lightbox>
        <AuthForms></AuthForms>
    </aside>
</template>

<script>

import Lightbox from './Lightbox.vue';
import AuthForms from './AuthForms.vue'

export default {

    components: {
        Lightbox, 
        AuthForms,
    },

    computed: {
        visible() {
            return this.$page.props.overlay.visible;
        }
    },

    methods: {
        clickToClose(e) {
            if (e.target.closest('.overlay') && !e.target.closest('.content')) this.$page.props.overlay.visible = false;
            return
        },

        pressToClose(e) {
            if (this.$page.props.overlay.visible && e.key == 'Escape') this.$page.props.overlay.visible = false;
            return
        },
    },

    watch: {

        visible() {
            if (this.$page.props.overlay.visible) {
                window.addEventListener('keydown', this.pressToClose)
                window.addEventListener('click', this.clickToClose)
            } else {
                window.removeEventListener('keydown', this.pressToClose)
                window.removeEventListener('click', this.clickToClose)
            }
        },
    },
}
</script>