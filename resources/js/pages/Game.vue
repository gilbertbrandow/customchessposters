<template>
    <section>
        <div class="container">
            <ul class="game__collection">
                <li class="single">
                    <div class="content">
                        <h1 v-text="this.$page.props.game.name"></h1>

                        <div class="player">
                                <div class="flag"><Flags :country="this.$page.props.game.white_country"/><div class="info"><div></div><span>{{this.$page.props.game.white_country }}</span></div></div>
                                <div class="name">{{ this.$page.props.game.white_name }} ({{ this.$page.props.game.white_rating ? this.$page.props.game.white_rating : 'N/A' }})</div>
                        </div>
                        
                        <div class="player">
                            <div class="flag" @mouseover="removeClass($event)"><Flags :country="this.$page.props.game.black_country"/><div  class="info"><div></div><span>{{this.$page.props.game.black_country }}</span></div></div>
                            <div class="name">{{ this.$page.props.game.black_name }} ({{ this.$page.props.game.black_rating ? this.$page.props.game.black_rating : 'N/A' }})</div>
                        </div>

                        <div class="banner">
                            <Icon v-if="this.$page.props.game.world_championship_game" name="king" />
                           <span v-text="(this.$page.props.game.world_championship_game) ? 'World Championship' : 'Played'"></span><span>{{ this.$page.props.game.date + ' in ' + this.$page.props.game.where}}</span>
                        </div>

                        <strong class="is--small">{{ this.$page.props.game.opening_eco + ': ' + this.$page.props.game.opening_name }}</strong>
                    
                        <p>{{ this.$page.props.game.description }}</p>
                        <div class="button-wrp">
                            <button class="button is--black"> Add to cart
                                <Icon name="cart" />
                            </button>

                            <a class="button" :href="route('poster.edit', { 'id': this.$page.props.game.id })">
                                Edit poster
                                <Icon name="edit" />
                            </a>
                        </div>
                    </div>
                    <Poster :poster="this.$page.props.game" environment="/images/environments/builder-mockup.jpeg"
                        :controls="{ 'save': true }"></Poster>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import Poster from "./Components/Poster.vue"
import Flags from "../Icons/Flags.vue";
import { Link } from "@inertiajs/vue3";

export default {

    layout: AppLayout,

    components: {
        Poster,
        Flags,
        Link,
    },

    props: {

    },
}
</script>
