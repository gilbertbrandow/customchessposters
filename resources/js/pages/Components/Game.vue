<template>
        <li :class="[game.poster_search ? 'is--highlighted-poster' : '']">
                    <div class="content">
                        <h2 v-text="game.name"></h2>

                        <div class="player">
                                <div class="flag" @mouseover="removeClass($event)"><Flags :country="game.white_country"/><div :class="[this.search && game.white_country.toLowerCase().includes(this.search.toLowerCase()) ? 'info show' : 'info']"><div></div><span>{{game.white_country }}</span></div></div>
                                <div class="name">{{ game.white_name }} ({{ game.white_rating ? game.white_rating : 'N/A' }})</div>
                        </div>
                        
                        <div class="player">
                            <div class="flag" @mouseover="removeClass($event)"><Flags :country="game.black_country"/><div :class="[this.search && game.black_country.toLowerCase().includes(this.search.toLowerCase()) ? 'info show' : 'info']"><div></div><span>{{game.black_country }}</span></div></div>
                            <div class="name">{{ game.black_name }} ({{ game.black_rating ? game.black_rating : 'N/A' }})</div>
                        </div>

                        <div class="banner">
                            <Icon v-if="game.world_championship_game" name="king" />
                           <span v-text="(game.world_championship_game) ? 'World Championship' : 'Played'"></span><span>{{ game.date + ' in ' + game.where}}</span>
                        </div>

                        <strong class="is--small">{{ game.opening_eco + ': ' + game.opening_name }}</strong>
                    
                        <p>{{ game.description }}</p>
                        <div class="button-wrp">
                            <button class="button is--black"> Add to cart
                                <Icon name="cart" />
                            </button>

                            <a class="button" :href="route('game.show', { 'id': game.id })">
                                Go to game
                                <Icon name="arrow-up" />
                            </a>
                        </div>
                    </div>
                    <Poster :poster="game" environment="/images/environments/builder-mockup.jpeg"
                        :controls="{ 'small': true, 'save': true, 'edit': true, }"></Poster>
                </li>
</template>

<script>
import Poster from "./Poster.vue"
import Flags from "../../Icons/Flags.vue";
import { Link } from "@inertiajs/vue3";


export default {
    components: {
        Poster,
        Flags,
        Link,
    },

    props: {
        search: '',
        game: {},
    },

    methods: {

        removeClass(event) {
            event.target.closest('.player').querySelector('.info').classList.remove('show');
        },
    },
}

</script>