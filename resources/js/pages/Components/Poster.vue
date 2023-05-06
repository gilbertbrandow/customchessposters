<template>
    <div class="poster">
        <div v-if="controls" class="poster__buttons-wrp"  :class="[ (controls.small) ? 'small' : '']">
            <button class="button"
                @click="this.$page.props.overlay.lightbox = this.poster, this.$page.props.overlay.visible = true;">
                <span v-if="!controls.small">Fullscreen</span>
                <Icon name="fullScreen" />
                <div v-if="controls.small" class="info"><div></div>Fullscreen</div>
            </button>
            <Link v-if="controls.edit" :href="route('poster.show', { 'id': poster.id })" class="button">
                <span v-if="!controls.small">Edit Poster</span>
                <Icon :name="controls.small ? 'edit-small' : 'edit'" />

                <div v-if="controls.small" class="info"><div></div>Edit poster</div>
            </Link>
            <form v-if="controls.save || controls.update" @submit.prevent="submitForm(this.poster)">
                <button class="button" type="submit" :class="[(this.$page.props.auth.user && this.$page.props.auth.user.saved.includes(this.poster.id) && !controls.update) ? 'saved' : '']" :disabled="this.$page.props.auth.user && this.$page.props.auth.user.saved.includes(this.poster.id)"> 
                    
                    <span v-if="!controls.small" v-text="(controls.update && this.$page.props.auth.user && this.$page.props.auth.user.saved.includes(this.poster.id)) ? 'Update poster' : (this.$page.props.auth.user && this.$page.props.auth.user.saved.includes(this.poster.id)) ? 'Poster saved' : 'Save this design' "></span>
                    
                    <Icon :name="(controls.update && this.$page.props.auth.user && this.$page.props.auth.user.saved.includes(this.poster.id)) ? 'update' : (controls.small) ? 'bookmark-small' : 'bookmark'" />
                    
                    <div v-if="controls.small && (!this.$page.props.auth.user || !this.$page.props.auth.user.saved.includes(this.poster.id))" class="info"><div></div>Save poster</div>
                </button>
            </form>
        </div>

        <div v-if="showPlayers === true" class="players">
            <div class="player">
                    <Flag :country="this.poster.white_country"></Flag>
                    <div :class="[this.poster.white_country_highlight ? 'info show' : 'info']"><div></div><span>{{this.poster.white_country }}</span></div>
                    <span>{{ this.poster.white_name }}</span>
                </div>
                -
                <div class="player">
                    <Flag :country="this.poster.black_country"></Flag>
                    <div :class="[this.poster.black_country_highlight ? 'info show' : 'info']"><div></div><span>{{this.poster.black_country }}</span></div>
                    <span>{{ this.poster.black_name }}</span>
                </div>
        </div>

        <div class="poster__svg-wrp">
            <Poster :poster="this.poster" />
        </div>
        <img class="poster__environment" :src="this.environment" />
    </div>
</template>

<script setup>

import Poster from './Poster/PosterSVG.vue';
import Flag from '../../Icons/Flags.vue'
import { useForm } from '@inertiajs/vue3';
import { Link } from "@inertiajs/vue3";

let form = useForm({
    posterData: {},
});

function submitForm(poster) {
    form.posterData = {
        id: poster.id, 
        theme: poster.theme, 
        orientation: poster.orientation, 
        starting_position: poster.starting_position, 
        pgn: poster.pgn, 
        diagram_position: poster.diagram_position, 
        move_comment: poster.move_comment, 
        fen: poster.fen, 
        result: poster.result, 
        title: poster.title, 
        white_player: poster.white_player, 
        black_player: poster.black_player, 
        white_rating: poster.white_rating, 
        black_rating: poster.black_rating, 
        white_title: poster.white_title, 
        black_title: poster.black_title, 
        where: poster.where, 
        where: poster.where, 
    };
    
    form.post('/save-poster', { preserveScroll: true, preserveState: true, });
}

</script>

<script>
export default {

    components: {
        Poster,
        Link,
        Flag,
    },

    props: {
        poster: {},
        showPlayers: false,
        environment: "",
        controls: true,
    },
}
</script>