<template>
        <li :class="[this.game.poster_highlight ? 'is--highlighted-poster' : '', this.small ? 'is--standing' : '']">
                    <div class="content">
                        <h2  v-if="this.small !== true" v-text="this.game.name"></h2>
                        <h3  v-else v-text="this.game.name"></h3>

                        <div v-if="this.small !== true" class="player">
                                <div class="flag" @mouseover="removeClass($event)"><Flags :country="this.game.white_country"/><div :class="[this.game.white_country_highlight ? 'info show' : 'info']"><div></div><span>{{this.game.white_country }}</span></div></div>
                                <div class="name">{{ this.game.white_name }} ({{ this.game.white_rating ? this.game.white_rating : 'N/A' }})</div>
                        </div>
                        
                        <div v-if="this.small !== true" class="player">
                            <div class="flag" @mouseover="removeClass($event)"><Flags :country="this.game.black_country"/><div :class="[this.game.black_country_highlight ? 'info show' : 'info']"><div></div><span>{{this.game.black_country }}</span></div></div>
                            <div class="name">{{ this.game.black_name }} ({{ this.game.black_rating ? this.game.black_rating : 'N/A' }})</div>
                        </div>

                        <div class="banner">
                            <Icon v-if="this.game.world_championship_game" name="king" />
                           <span v-text="(this.game.world_championship_game) ? 'World Championship' : 'Played'"></span><span>{{ this.game.date + ' in ' + this.game.where}}</span>
                        </div>

                        <strong class="is--small">{{ this.game.opening_eco + ': ' + this.game.opening_name }}</strong>
                    
                        <div class="excerpt" v-if="this.small === true"><p>{{ this.game.description }}</p><Link :href="route('game.show', { 'id': this.game.game_id })" class="text__link" :class="[this.game.read_more_highlight ? 'highlight' : '']">See the whole game</Link></div>

                        <p v-else>{{ this.game.description }}</p>
            
                        <div class="button-wrp">
                            <button class="button is--black"> Add to cart
                                <Icon name="cart" />
                            </button>

                            <Link v-if="this.small !== true" class="button" :href="route('game.show', { 'id': this.game.game_id })">
                                Go to game
                                <Icon name="arrow-up" />
                            </Link>
                        </div>
                    </div>
                    <Poster :poster="game" :showPlayers="showPlayersInPoster" environment="/images/environments/builder-mockup.jpeg"
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
        showPlayersInPoster: false,
        small: false,
    },

    methods: {

        removeClass(event) {
            event.target.closest('.player').querySelector('.info').classList.remove('show');
        },
    },
}

</script>