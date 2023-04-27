<template>
    <section>
        <div class="container">
            <h1>Game Collection</h1>
            <p>Here is our collection of amazing games.</p>
            <div class="filter">
                <div class="simple">
                <div class="field__wrp" style="grid-template-columns: span 3;">
                    <label for="search" class="field__label">Search</label>
                    <input 
                    v-model="search" 
                    class="field"
                    name="search"
                    id="search"
                    placeholder="Player, country opening..." />
                </div>

                <button @click="this.filterAdvanced = !this.filterAdvanced" class="button">
                    Filter 
                    <Icon name="filter"></Icon>
                </button>
                </div>
                <div v-if="this.filterAdvanced" class="advanced">

                <div class="field__wrp">
                    <label for="wcc" class="field__label">Filter by World Championship Game</label>
                    <select v-model="query.wcc" id="wcc" :class="[query.wcc !== null ? 'field active': 'field']" name="wcc">
                        <option selected :value="null">No preference</option>
                        <option :value="1">Is a WCC game</option>
                        <option :value="0">Is not a WCC game</option>
                    </select>
                </div>

                <div class="field__wrp">
                    <label for="sortBy" class="field__label">Sort by</label>
                    <select v-model="query.sort" id="sortBy" class="field" name="sortBy">
                        <option value="recent-desc">Most recent</option>
                        <option value="recent-asc">Least recent</option>
                        <option value="date-desc">Date played, newest to oldest</option>
                        <option value="date-asc">Date played, oldest to newest</option>
                    </select>
                </div>

                <div class="field__wrp">
                    <label for="result" class="field__label">Filter games by result</label>
                    <select v-model="query.result" id="result" :class="[query.result !== null ? 'field active': 'field']" name="result">
                        <option selected :value="null">No preference</option>
                        <option value="1-0">White won</option>
                        <option value="0-1">Black won</option>
                        <option value="1/2-1/2">Draw</option>
                    </select>
                </div>

                <div class="field__wrp">
                    <label for="wcc" class="field__label">Filter by players</label>
                    <select v-model="query.players" id="wcc" class="field" name="wcc">
                        <option :value="null">No preference</option>
                        <option :value="1">Is a WCC game</option>
                        <option :value="0">Is not a WCC game</option>
                    </select>
                </div>

                <div class="field__wrp">
                    <label for="wcc" class="field__label">Filter by players country origin</label>
                    <select v-model="query.countries" id="wcc" class="field" name="wcc">
                        <option :value="null">No preference</option>
                        <option :value="1">Is a WCC game</option>
                        <option :value="0">Is not a WCC game</option>
                    </select>
                </div>

                </div>
            </div>
            <ul class="game__collection">
                <li v-for="game in this.$page.props.games.data">
                    <div class="content">
                        <h2 v-text="game.name"></h2>

                        <div class="player">
                                <div class="flag" @mouseover="removeClass($event)"><Flags :country="game.white_country"/><div :class="[this.query.search && game.white_country.toLowerCase().includes(this.query.search.toLowerCase()) ? 'info show' : 'info']"><div></div><span>{{game.white_country }}</span></div></div>
                                <div class="name">{{ game.white_name }}</div>
                        </div>
                        
                        <div class="player">
                            <div class="flag" @mouseover="removeClass($event)"><Flags :country="game.black_country"/><div :class="[this.query.search && game.black_country.toLowerCase().includes(this.query.search.toLowerCase()) ? 'info show' : 'info']"><div></div><span>{{game.black_country }}</span></div></div>
                            <div class="name">{{ game.black_name }}</div>
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
                <div class="navigation">


                    <div class="arrow" :class="[this.$page.props.games.current_page == 1 ? 'inactive' : '']" @click="pageChange(false)"><Icon name="arrow-right"></Icon></div>
                    <div class="pages">
                        <template  v-for="(link, index) in this.$page.props.games.links">
                            <div v-if="index > 0 && index < this.$page.props.games.links.length - 1"
                                @click="this.$data.query.page = index" 
                                :class="[link.active ? 'page-link active' : 'page-link' ]"
                                v-text="link.label"
                                ></div>
                        </template>
                    </div>
                    <div class="arrow" :class="[this.$page.props.games.current_page ==  this.$page.props.games.last_page ? 'inactive' : '']" @click="pageChange(true)"><Icon name="arrow-right"></Icon></div>
                </div>
            </aside>
        </div>
    </section>
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import Poster from "./Components/Poster.vue"
import Flags from "../Icons/Flags.vue";
import { Link } from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3';
import throttle from 'lodash/throttle'

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

            filterAdvanced: false, 

            search: this.$page.props.route.query.search || null,

            query: {
                search: this.$page.props.route.query.search || null,
                players: null,
                openings: null,
                countries: null,
                result: this.$page.props.route.query.result || null,
                wcc: this.$page.props.route.query.wcc || null,
                dateFrom: null,
                dateTo: null,
                sort: typeof this.$page.props.route.query.sort === 'string' ? this.$page.props.route.query.sort : 'recent-desc',
                page: this.$page.props.games.current_page,
            },
        }
    },

    methods: {
        pageChange(direction) {

            if(direction && this.$data.query.page != this.$page.props.games.last_page){
                this.$data.query.page++
            } else if(!direction &&  this.$data.query.page != 1 ) {
                this.$data.query.page--
            }

            return; 
        }, 

        removeClass(event) {
            event.target.closest('.player').querySelector('.info').classList.remove('show');
        },

        activate() {
            setTimeout(() => this.typing = false, 500);
        },

        highlightText() {

            const regex = new RegExp(this.query.search, 'gi');

            let textElements = document.querySelectorAll('li p, li .name, li strong, li h2, li .banner span:last-child, li .flag .info span');

            textElements.forEach((element) => {

                let text = element.innerHTML;
                text = text.replace(/(<mark class="highlight">|<\/mark>)/gim, '');

                const newText = text.replace(regex, '<mark class="highlight">$&</mark>');
                element.innerHTML = newText;

            });

            return; 

            //Select all text that should be highlited and push into array

            text = text.replace(/(<mark class="highlight">|<\/mark>)/gim, '');

            const newText = text.replace(regex, '<mark class="highlight">$&</mark>');
            document.querySelector('li p').innerHTML = newText;
        },

    },

    watch: {

        search: throttle(function (value) {
            this.$data.query.search = this.$data.search;

        }, 500),

        query: {
            handler() {

                if(this.$data.query.page == this.$page.props.games.current_page) this.$data.query.page = 1; 

                let params = {};

                for (var key in this.$data.query) {

                    if (this.$data.query.hasOwnProperty(key) && this.$data.query[key] !== null) {
                        params[key] = this.$data.query[key];
                    }
                }

                router.visit('/game-collection', {
                    method: 'get',
                    only: ['games'],
                    data: params,
                    preserveScroll: true,
                    preserveState: true,
                    onFinish: visit => {
                        this.highlightText();
                    },
                })
            },

            deep: true
        },
    }, 

    mounted() {
        this.highlightText();
    }
}
</script>
