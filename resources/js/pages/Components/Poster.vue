<template>
    <div class="poster">
        <div v-if="controls" class="poster__buttons-wrp"  :class="[ (controls.small) ? 'small' : '']">
            <button class="button"
                @click="this.$page.props.overlay.lightbox = this.poster, this.$page.props.overlay.visible = true;">
                <span v-if="!controls.small">Full screen</span>
                <Icon name="fullScreen" />
            </button>
            <form v-if="controls.save" @submit.prevent="submitForm(this.poster)">
                <button class="button" type="submit"> 
                    <span v-if="!controls.small">Save this design</span>
                    <Icon name="bookmark" />
                </button>
            </form>
        </div>
        <div class="poster__svg-wrp">
            <Poster :poster="this.poster" />
        </div>
        <img class="poster__environment" :src="this.environment" />
    </div>
</template>

<script setup>

import Poster from './Poster/PosterSVG.vue';
import { useForm } from '@inertiajs/vue3';

let form = useForm({
    posterData: {},
});

function submitForm(poster) {
    form.posterData = poster;
    form.post('/save-poster', { preserveScroll: true });
}

</script>

<script>
export default {

    props: {
        poster: {},
        environment: "",
        controls: true,
    },


}
</script>