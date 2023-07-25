<template>
    <div class="poster">
        <div v-if="controls" class="poster__buttons-wrp" :class="[(controls.small) ? 'small' : '']">
            <button class="button" @click="$page.props.lightbox = poster, $page.props.overlay = 'lightbox';">
                <span v-if="!controls.small">Fullscreen</span>
                <Icon name="fullScreen" />
                <div v-if="controls.small" class="info">
                    <div></div>Fullscreen
                </div>
            </button>
            <Link v-if="controls.edit" :href="route('poster.show', { 'id': poster.id })" class="button">
            <span v-if="!controls.small">Edit Poster</span>
            <Icon :name="controls.small ? 'edit-small' : 'edit'" />

            <div v-if="controls.small" class="info">
                <div></div>Edit poster
            </div>
            </Link>
            <form v-if="controls.save || controls.update" @submit.prevent="submitForm(poster, controls.update)">
                <button class="button" type="submit"
                    :class="[($page.props.auth.user && $page.props.auth.user.saved.includes(poster.id) && !controls.update) ? 'saved' : '']"
                    :disabled="$page.props.auth.user && $page.props.auth.user.saved.includes(poster.id) && !controls.update">

                    <span v-if="!controls.small"
                        v-text="(controls.update && $page.props.auth.user && $page.props.auth.user.saved.includes(poster.id)) ? 'Update poster' : ($page.props.auth.user && $page.props.auth.user.saved.includes(poster.id)) ? 'Poster saved' : 'Save this design'"></span>

                    <Icon
                        :name="(controls.update && $page.props.auth.user && $page.props.auth.user.saved.includes(poster.id)) ? 'update' : (controls.small) ? 'bookmark-small' : 'bookmark'" />

                    <div v-if="controls.small && (!$page.props.auth.user || !$page.props.auth.user.saved.includes(poster.id))"
                        class="info">
                        <div></div>Save poster
                    </div>
                </button>
            </form>
        </div>

        <div v-if="showPlayers === true" class="players">
            <div class="player">
                <div class="flag">
                    <Flag :country="poster.white_country"></Flag>
                    <div :class="[poster.white_country_highlight ? 'info show' : 'info']">
                        <div></div><span>{{ poster.white_country }}</span>
                    </div>
                </div>
                <span>{{ poster.white_name }}</span>

                <div v-if="poster.white_computer" class="computer">
                    <Icon name="computer"></Icon>
                    <div class="info">
                        <div></div><span>Player is not human</span>
                    </div>
                </div>
            </div>
            -
            <div class="player">
                <div class="flag">
                    <Flag :country="poster.black_country"></Flag>
                    <div :class="[poster.black_country_highlight ? 'info show' : 'info']">
                        <div></div><span>{{ poster.black_country }}</span>
                    </div>
                </div>
                <span>{{ poster.black_name }}</span>
                <div v-if="poster.black_computer" class="computer">
                    <Icon name="computer"></Icon>
                    <div class="info">
                        <div></div><span>Player is not human</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="poster__svg-wrp">
            <Poster :poster="poster" />
        </div>
        <img class="poster__environment" :src="`/images/environments/${environment}`"/>
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

function submitForm(poster, update) {

    form.posterData = {
        id: poster.id,
        theme_id: poster.theme_id,
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
        when: poster.when,
    };

    form.post(update ? '/update-poster' : '/save-poster', { preserveScroll: true, preserveState: true, });
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