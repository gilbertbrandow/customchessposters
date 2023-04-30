<template>
    <div class="poster">
        <div v-if="controls" class="poster__buttons-wrp"  :class="[ (controls.small) ? 'small' : '']">
            <button class="button"
                @click="this.$page.props.overlay.lightbox = this.poster, this.$page.props.overlay.visible = true;">
                <span v-if="!controls.small">Fullscreen</span>
                <Icon name="fullScreen" />
                <div v-if="controls.small" class="info"><div></div>Fullscreen</div>
            </button>
            <Link v-if="controls.edit" :href="route('poster.edit', { 'id': poster.id })" class="button">
                <span v-if="!controls.small">Edit Poster</span>
                <Icon :name="controls.small ? 'edit-small' : 'edit'" />

                <div v-if="controls.small" class="info"><div></div>Edit poster</div>
            </Link>
            <form v-if="controls.save || controls.update" @submit.prevent="submitForm(this.poster)">
                <button class="button" type="submit" :class="[(this.$page.props.auth.user && this.$page.props.auth.user.saved.includes(this.poster.id) && !controls.update) ? 'saved' : '']" :disabled="this.$page.props.auth.user && this.$page.props.auth.user.saved.includes(this.poster.id)"> 
                    <span v-if="!controls.small" v-text="(controls.update) ? 'Update poster' : (this.$page.props.auth.user && this.$page.props.auth.user.saved.includes(this.poster.id)) ? 'Poster saved' : 'Save this design' "></span>
                    <Icon :name="(controls.update) ? 'update' : (controls.small) ? 'bookmark-small' : 'bookmark'" />
                    <div v-if="controls.small" class="info"><div></div>Save poster</div>
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
import { Link } from "@inertiajs/vue3";

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

    components: {
        Link,
    },

    props: {
        poster: {},
        environment: "",
        controls: true,
    },
}
</script>