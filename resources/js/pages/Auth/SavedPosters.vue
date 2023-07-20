<template>
    <section>
        <h1>Your saved designs</h1>
        <ul v-if="this.$page.props.posters.length" class="saved__posters">
            <li v-for="poster in $page.props.posters">
                <Poster :poster="poster" environment="/images/environments/builder-mockup.jpeg"
                    :controls="{ 'small': true, 'save': false }"></Poster>
                <div class="content">
                    <div class="button-wrp">
                        <PosterAddToCart :poster="{
                            'theme_id': poster.theme_id, 
                            'orientation': poster.orientation, 
                            'starting_position': poster.starting_position, 
                            'pgn': poster.pgn, 
                            'diagram_position': poster.diagram_position, 
                            'move_comment': poster.move_comment, 
                            'fen': poster.fen, 
                            'result': poster.result, 
                            'title': poster.title, 
                            'white_player': poster.white_player, 
                            'black_player': poster.black_player,
                            'white_rating': poster.white_rating, 
                            'black_rating': poster.black_rating, 
                            'white_title': poster.white_title, 
                            'black_title': poster.black_title,  
                            'when': poster.when, 
                            'where': poster.where,  
                            }" />

                        <a class="button" :href="route('poster.show', { 'id': poster.id })">
                            Edit
                            <Icon name="edit" />
                        </a>

                        <form @submit.prevent="submitForm(poster.id)">
                            <button class="button is--only-icon" type="submit">
                                <Icon name="delete" />
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
        <div v-else>
            <p>You currently have no posters saved</p>
            <div class="button-wrp">
                <Link :href="route('poster.index')" class="button is--black">Create your own custom poster</Link>
                <Link :href="route('game.index')" class="button">See our game collection
                <Icon name="arrow-up" />
                </Link>
            </div>
        </div>
    </section>
</template>

<script setup>

import { useForm } from '@inertiajs/vue3';

let form = useForm({
    deleteSavedPosterId: 0,
});

function submitForm(id) {
    form.deleteSavedPosterId = id;
    form.post('/remove-poster', { preserveScroll: true });
}


</script>

<script>
import App from "../../Layouts/App.vue";
import AccountNav from "../../Layouts/AccountNav.vue";
import Poster from "../Components/Poster.vue"
import PosterAddToCart from '../Components/PosterAddToCart.vue';

export default {
    layout: (h, page) => {
        return h(App, () => h(AccountNav, () => page))
    },

    components: {
        Poster,
    },
}
</script>
