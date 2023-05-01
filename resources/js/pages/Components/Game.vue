<template>
        <li :class="[this.game.poster_search ? 'is--highlighted-poster' : '']">
                    <div class="content">
                        <h2 v-text="this.game.name"></h2>

                        <div class="player">
                                <div class="flag" @mouseover="removeClass($event)"><Flags :country="this.game.white_country"/><div :class="[this.search && this.game.white_country.toLowerCase().includes(this.search.toLowerCase()) ? 'info show' : 'info']"><div></div><span>{{this.game.white_country }}</span></div></div>
                                <div class="name">{{ this.game.white_name }} ({{ this.game.white_rating ? this.game.white_rating : 'N/A' }})</div>
                        </div>
                        
                        <div class="player">
                            <div class="flag" @mouseover="removeClass($event)"><Flags :country="this.game.black_country"/><div :class="[this.search && this.game.black_country.toLowerCase().includes(this.search.toLowerCase()) ? 'info show' : 'info']"><div></div><span>{{this.game.black_country }}</span></div></div>
                            <div class="name">{{ this.game.black_name }} ({{ this.game.black_rating ? this.game.black_rating : 'N/A' }})</div>
                        </div>

                        <div class="banner">
                            <Icon v-if="this.game.world_championship_game" name="king" />
                           <span v-text="(this.game.world_championship_game) ? 'World Championship' : 'Played'"></span><span>{{ this.game.date + ' in ' + this.game.where}}</span>
                        </div>

                        <strong class="is--small">{{ this.game.opening_eco + ': ' + this.game.opening_name }}</strong>
                    
                        <p>{{ this.game.description }}</p>
                        <div class="button-wrp">
                            <button class="button is--black"> Add to cart
                                <Icon name="cart" />
                            </button>

                            <a class="button" :href="route('game.show', { 'id': this.game.id })">
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