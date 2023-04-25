<template>
    <section>
        <div class="container">
            <h1>Game Collection</h1>
            <p>Here is our collection of amazing games.</p>

            <div class="filter">
                <div class="field__wrp">
                    <label for="sortBy" class="field__label">Sort by</label>
                    <select v-model="query.sort" id="sortBy" class="field" name="sortBy">
                        <option value="recent-desc">Most recent</option>
                        <option value="recent-asc">Least recent</option>
                        <option value="date-desc">Date played, newest to oldest</option>
                        <option value="date-asc">Date played, oldest to newest</option>
                        <Icon name="sort"></Icon>
                    </select>

                </div>
            </div>
            <ul class="game__collection">
                <li v-for="game in this.$page.props.games.data">
                    <div class="content">
                        <h2 v-text="game.name"></h2>

                        <div class="player">
                                <div class="flag"><Flags :country="game.white_country"/><div class="info"><div></div>{{game.white_country }} </div></div>
                                {{ game.white_name }}
                        </div>
                        
                        <div class="player">
                            <div class="flag"><Flags :country="game.black_country"/><div class="info"><div></div>{{game.black_country }} </div></div>
                            {{ game.black_name }}
                        </div>

                        <div class="banner">
                            <Icon v-if="game.world_championship_game" name="king" />
                           <span v-text="(game.world_championship_game) ? 'World Championship' : 'Played'"></span>{{ game.date + ' in ' + game.where}}
                        </div>

                        <strong class="is--small">{{ game.opening_eco + ': ' + game.opening_name }}</strong>
                    
                        <p>{{ game.description }}</p>
                        <div class="button-wrp">
                            <button class="button is--black"> Add to cart
                                <Icon name="cart" />
                            </button>

                            <a class="button" :href="route('poster.edit', { 'id': game.id })">
                                Edit poster
                                <Icon name="edit" />
                            </a>
                        </div>
                    </div>
                    <Poster :poster="game" environment="/images/environments/builder-mockup.jpeg"
                        :controls="{ 'small': true, 'save': true }"></Poster>
                </li>
            </ul>
            <aside class="pagination is--flex is--space-between">
                <span>Showing {{ this.$page.props.games.from }} - {{ this.$page.props.games.to }} of {{ this.$page.props.games.total }} results </span>
                <div class="links">

                    <template  v-for="link in this.$page.props.games.links">
                        <Link v-if="link.url" :href="link.url" :only="['games']" :class="[link.active ? 'active' : '' ]" preserve-scroll preserve-state>
                            {{ link.label }}
                        </Link>
                        <div v-else> {{ link.label }} </div>
                    </template>
                </div>
            </aside>
        </div>
    </section>
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import Poster from "./Components/Poster.vue"
import Flags from "../Icons/Flags.vue"
import { Link } from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'

export default {

    layout: AppLayout,

    components: {
        Poster,
        Flags,
        Link,
    },

    props: {

    },

    data() {
        return {

            query: {
                sort: 'date-desc',
                search: null,
                players: [],
                openings: [],
                countries: [],
                result: [],
                championshipGame: null,
                dateFrom: null,
                dateTo: null,
            },
        }
    },

    watch: {

        query: {
            handler(newValue, oldValue) {

                let params = {};

                for (var key in this.$data.query) {
                    if (this.$data.query.hasOwnProperty(key) && this.$data.query[key] && this.$data.query[key].length) {
                        params[key] = this.$data.query[key];
                    }
                }

                router.reload({
                    only: ['games'],
                    data: params,
                    preserveScroll: true,
                    preserveState: true,
                })
            },

            deep: true
        },
    }, 

    mounted() {
        console.log(this.$page.props.games);
    }
}
</script>
