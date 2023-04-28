<template>
    <section>
        <div class="container">
            <h1>Game Collection</h1>
            <div class="filter">
                <div class="simple">
                <div class="button-wrp">
                    <div class="field__wrp">
                        <label for="search" class="field__label">Search</label>
                        <input 
                        v-model="search" 
                        class="field"
                        name="search"
                        id="search"
                        placeholder="Player, country, opening..." />
                    </div>

                    <button @click="this.filterAdvanced = !this.filterAdvanced" class="button is--outline" :class="[filterAdvanced ? 'is--active': '']">
                        Filter 
                        <Icon name="filter"></Icon>
                    </button>
                </div>
                <div class="field__wrp">
                    <label for="sortBy" class="field__label">Sort by</label>
                    <select v-model="query.sort" id="sortBy" class="field" name="sortBy">
                        <option value="rating-desc">Rating, highest to lowest</option>
                        <option value="rating-asc">Rating, lowest to highest</option>
                        <option value="recent-desc">Most recent</option>
                        <option value="recent-asc">Least recent</option>
                        <option value="date-desc">Date played, newest to oldest</option>
                        <option value="date-asc">Date played, oldest to newest</option>
                    </select>
                </div>
                </div>
                <div v-if="this.filterAdvanced" class="advanced">

                    <div class="field__wrp">
                    <label for="after" class="field__label">Played after</label>
                    <input 
                    v-model="query.dateFrom" 
                    class="field"
                    name="after"
                    id="after"
                    type="date"/>
                </div>

                <div class="field__wrp">
                    <label for="before" class="field__label">Played before</label>
                    <input 
                    v-model="query.dateTo" 
                    class="field"
                    name="before"
                    id="before"
                    type="date"/>
                </div>

                <div class="field__wrp">
                    <label for="wcc" class="field__label">Filter by World Championship Game</label>
                    <select v-model="query.wcc" id="wcc" :class="[query.wcc !== null ? 'field active': 'field']" name="wcc">
                        <option selected :value="null">No preference</option>
                        <option :value="1">Is a WCC game</option>
                        <option :value="0">Is not a WCC game</option>
                    </select>
                </div>

                <div class="field__wrp">
                    <label for="result" class="field__label">Filter by result</label>
                    <select v-model="query.result" id="result" :class="[query.result !== null ? 'field active': 'field']" name="result">
                        <option selected :value="null">No preference</option>
                        <option value="1-0">White won</option>
                        <option value="0-1">Black won</option>
                        <option value="1/2-1/2">Draw</option>
                    </select>
                </div>

                <div class="field__wrp">
                    <label for="player" class="field__label">Filter by player</label>
                    <select v-model="query.player" id="player" :class="[query.player !== null ? 'field active': 'field']" name="player">
                        <option :value="null">No preference</option>
                        <template v-for="(country, key) in this.$page.props.players">
                            <option v-for="player in country" :value="player.id">{{ player.name }}</option>
                        </template>
                    </select>
                </div>

                <div class="field__wrp">
                    <label for="country" class="field__label">Filter by player country</label>
                    <select v-model="query.country" id="country" :class="[query.country !== null ? 'field active': 'field']" name="wcc">
                        <option :value="null">No preference</option>
                        <option v-for="(country, key) in this.$page.props.players" :value="key">{{ key }}</option>
                    </select>
                </div>

                <div class="field__wrp">
                    <label for="wcc" class="field__label">Filter by opening</label>
                    <select v-model="query.opening" id="wcc" :class="[query.opening !== null ? 'field active': 'field']" name="wcc">
                        <option :value="null">No preference</option>
                        <option v-for="opening in this.$page.props.openings" :value="opening.id">{{ opening.eco + ': ' + opening.name }}</option>
                    </select>
                </div>

                <div class="field__wrp">
                    <label for="titles" class="field__label">Filter by titles</label>
                    <select v-model="query.titles" id="titles" :class="[query.titles !== null ? 'field active': 'field']" name="titles">
                        <option value="null">No preference</option>
                        <option value="GMs">Both players were Grandmasters</option>
                        <option value="GM">At least one player was Grandmaster</option>
                        <option value="masters">Both players were masters</option>
                        <option value="master">At least one player was master</option>
                        <option value="none">None of the players were masters</option>
                        <option value="not">At least one player was not master</option>
                    </select>
                </div>

                </div>
                <div v-if="this.queryDesc" class="is--margin-top is--margin-left">
                  {{ this.queryDesc }}
                    <button class="link-arrow is--low-op is--margin-left" @click="resetQuery()">
                           Remove filters
                            <Icon name="filter-remove" />
                    </button>
                </div>
            </div>
            <ul class="game__collection">
                <li v-for="game in this.$page.props.games.data">
                    <div class="content">
                        <h2 v-text="game.name"></h2>

                        <div class="player">
                                <div class="flag" @mouseover="removeClass($event)"><Flags :country="game.white_country"/><div :class="[this.query.search && game.white_country.toLowerCase().includes(this.query.search.toLowerCase()) ? 'info show' : 'info']"><div></div><span>{{game.white_country }}</span></div></div>
                                <div class="name">{{ game.white_name }} ({{ game.white_rating ? game.white_rating : 'N/A' }})</div>
                        </div>
                        
                        <div class="player">
                            <div class="flag" @mouseover="removeClass($event)"><Flags :country="game.black_country"/><div :class="[this.query.search && game.black_country.toLowerCase().includes(this.query.search.toLowerCase()) ? 'info show' : 'info']"><div></div><span>{{game.black_country }}</span></div></div>
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
                player: this.$page.props.route.query.player || null,
                opening: this.$page.props.route.query.opening || null,
                country: this.$page.props.route.query.country || null,
                result: this.$page.props.route.query.result || null,
                wcc: this.$page.props.route.query.wcc || null,
                titles: this.$page.props.route.query.titles || 'null',
                dateFrom: this.$page.props.route.query.dateFrom || null,
                dateTo: this.$page.props.route.query.dateTo || null,
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

            const textElements = document.querySelectorAll('li p, li .name, li strong, li h2, li .banner span:last-child, li .flag .info span');

            textElements.forEach((element) => {

                let text = element.innerHTML;
                text = text.replace(/(<mark class="highlight">|<\/mark>)/gim, '');

                let newText = text.replace(regex, '<mark class="highlight">$&</mark>');
                element.innerHTML = newText;

            });

            return; 
        },

        resetQuery() {

            this.search = null;

            this.$data.query = {
                search: null,
                player: null,
                opening: null,
                country: null,
                result: null,
                wcc: null,
                titles: null,
                dateFrom: null,
                dateTo: null,
                sort: this.$data.query.sort,
                page: 1,
            };

        }

    },

    computed: {
        queryDesc() {
            let params = [];

            if(this.$data.search) params.push('matches "' + this.$data.search + '"');
            if(this.query.dateFrom ) params.push('was played after ' + this.$data.query.dateFrom);
            if(this.query.dateTo ) params.push('was played before ' + this.$data.query.dateTo);
            if(this.query.wcc !== null) params.push(this.query.wcc ? 'were part of the WCC' : 'were not part of the WCC');
            if(this.query.country ) params.push('had at least one player who competed for ' + this.$data.query.country);
            if(this.query.player) {

                let obj = this.$page.props.players;
                let id = this.$data.query.player

                Object.keys(obj).forEach(function(key) {
                    obj[key].forEach(player => {
                        if(player.id == id) {
                            let name = player.name.split(', ')
                            params.push(name[1] + ' ' + name[0] + ' played');
                        }
                    })
                });
            } 
            if(this.query.result !== null) {
                if(this.query.result == '1-0') {
                    params.push('White won');
                } else if(this.query.result == '0-1') {
                    params.push('Black won');
                } else {
                    params.push('was a draw');
                }
            }
            if(this.query.opening !== null) {
                this.$page.props.openings.forEach(element => {
                    if(element.id == this.$data.query.opening) params.push('started as "' + element.name + '"');
                })
            } 
            if(this.query.titles !== 'null') {
                switch (this.query.titles) {
                    case 'GMs':
                        params.push('features two GMs');
                        break;
                    
                    case 'GM':
                        params.push('had at least one GM');
                        break;
                    
                    case 'masters':
                        params.push('features two masters');
                        break;    
                               
                    case 'master':
                        params.push('had at least one master');
                        break;
                    
                    case 'not':
                        params.push('had at least one player who was not master');
                        break;
                        
                    case 'none':
                        params.push('had no player who was master');
                        break;
                }
            } 

            if( params.length) return 'Showing games that ' + params.join(', ').replace(/,([^,]*)$/, ' and' + '$1');
            else return false;
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

                    if (this.$data.query.hasOwnProperty(key) && this.$data.query[key] !== null && this.$data.query[key] !== 'null') {
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
        //console.log(this.$page.props.players)
    }
}
</script>
