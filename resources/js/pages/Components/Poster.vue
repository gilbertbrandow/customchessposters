<template>
    <div class="poster">
        <div class="poster__buttons-wrp">
            <div class="button"
                @click="this.$page.props.lightbox.poster = this.poster, this.$page.props.lightbox.visible = true">
                Full screen
                <Icon name="fullScreen" />
            </div>
            <form @submit.prevent="submitForm(this.poster)">
                <button class="button" type="submit"> Save this design
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
    form.post('/save-poster');
}

</script>

<script>
export default {

    props: {
        poster: {},
        environment: "",
    },


}
</script>