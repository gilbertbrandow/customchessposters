<template>
    <section>
        <div class="container">
            <h1>Game Collection</h1>
            <p>Here is our collection of amazing games.</p>

            <div class="filter">
                <div class="field__wrp">
                    <label for="sortBy" class="field__label">Sort by</label>
                    <select v-model="sortBy" id="sortBy" class="field" name="sortBy">
                        <option value="updated_at-desc">Most recent</option>
                        <option value="updated_at-asc">Least recent</option>
                        <option value="date-desc">Date played, newest to oldest</option>
                        <option value="date-asc">Date played, oldest to newest</option>
                        <Icon name="sort"></Icon>
                    </select>

                </div>
            </div>
            <ul class="game__collection">
                <li v-for="game in this.$page.props.games">
                    <div class="content">
                        <h2 v-text="game.name"></h2>

                        <div class="player"><Flags :country="game.white_player.country"/>{{ game.white_player.name }}</div>
                        <div class="player"><Flags :country="game.black_player.country"/>{{ game.black_player.name }}</div>

                        <div class="banner">
                            <div>
                                <Icon v-if="game.world_championship_game" name="king" />
                            </div>
                           <span v-text="(game.world_championship_game) ? 'World Championship' : 'Played'"></span>{{ game.date + ' in ' + game.poster.where}}
                        </div>

                        <strong class="is--small">{{ game.opening.eco + ': ' + game.opening.name }}</strong>
                    
                        <p>{{ game.description }}</p>
                        <div class="button-wrp">
                            <button class="button is--black"> Add to cart
                                <Icon name="cart" />
                            </button>

                            <a class="button" :href="route('poster.edit', { 'id': game.poster.id })">
                                Edit poster
                                <Icon name="edit" />
                            </a>
                        </div>
                    </div>
                    <Poster :poster="game.poster" environment="/images/environments/builder-mockup.jpeg"
                        :controls="{ 'small': true, 'save': true }"></Poster>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import Poster from "./Components/Poster.vue"
import Flags from "../Icons/Flags.vue"
import { router } from '@inertiajs/vue3'

export default {

    layout: AppLayout,

    components: {
        Poster,
        Flags,
    },

    props: {

    },

    data() {
        return {

            filter: {
                query: null,
                players: [],
                openings: [],
                countries: [],
                result: [],
                championshipGame: null,
                dateFrom: null,
                dateTo: null,
            },

            sortBy: this.$page.props.sortBy,
        }
    },

    watch: {
        sortBy() {
            router.visit('/game-collection/' + this.$data.sortBy, {
                only: ['games', 'sortBy'],
                preserveScroll: true,
            })
        },
    }
}
</script>