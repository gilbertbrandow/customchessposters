<template>
    <div class="filter">
        <div class="simple">
            <div class="button-wrp">
                <div class="field__wrp">
                    <label for="search" class="field__label">Search</label>
                    <input v-model="search" class="field" name="search" id="search" ref="search"
                        placeholder="Player, country, opening..." />
                    <span v-text="getOS"></span>
                </div>

                <button v-if="this.advanced !== false" @click="this.advancedShow = !this.advancedShow"
                    class="button is--outline" :class="[advancedShow ? 'is--active' : '']">
                    Filter
                    <Icon name="filter"></Icon>
                </button>
                <Link v-else :href="route('game.index')" class="button is--outline">
                See all games
                <Icon name="arrow-up"></Icon>
                </Link>
            </div>
            <div v-if="this.advanced !== false" class="field__wrp">
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
        <div v-if="this.advanced !== false && this.advancedShow" class="advanced">

            <div class="field__wrp">
                <label for="after" class="field__label">Played after</label>
                <input v-model="query.dateFrom" class="field" name="after" id="after" type="date" />
            </div>

            <div class="field__wrp">
                <label for="before" class="field__label">Played before</label>
                <input v-model="query.dateTo" class="field" name="before" id="before" type="date" />
            </div>

            <div class="field__wrp">
                <label for="wcc" class="field__label">Filter by World Championship Game</label>
                <select v-model="query.wcc" id="wcc" :class="[query.wcc !== null ? 'field active' : 'field']" name="wcc">
                    <option selected :value="null">No preference</option>
                    <option :value="1">Is a WCC game</option>
                    <option :value="0">Is not a WCC game</option>
                </select>
            </div>

            <div class="field__wrp">
                <label for="result" class="field__label">Filter by result</label>
                <select v-model="query.result" id="result" :class="[query.result !== null ? 'field active' : 'field']"
                    name="result">
                    <option selected :value="null">No preference</option>
                    <option value="1-0">White won</option>
                    <option value="0-1">Black won</option>
                    <option value="1/2-1/2">Draw</option>
                </select>
            </div>

            <div class="field__wrp">
                <label for="player" class="field__label">Filter by player</label>
                <select v-model="query.player" id="player" :class="[query.player !== null ? 'field active' : 'field']"
                    name="player">
                    <option :value="null">No preference</option>
                    <option v-for="player in this.$page.props.players" :value="player.id">{{ player.name }}</option>
                </select>
            </div>

            <div class="field__wrp">
                <label for="country" class="field__label">Filter by player country</label>
                <select v-model="query.country" id="country" :class="[query.country !== null ? 'field active' : 'field']"
                    name="wcc">
                    <option :value="null">No preference</option>
                    <option v-for="(country, name) in this.$page.props.countries" :value="name">{{ name }}</option>
                </select>
            </div>

            <div class="field__wrp">
                <label for="wcc" class="field__label">Filter by opening</label>
                <select v-model="query.opening" id="wcc" :class="[query.opening !== null ? 'field active' : 'field']"
                    name="wcc">
                    <option :value="null">No preference</option>
                    <option v-for="opening in this.$page.props.openings" :value="opening.id">{{ opening.eco + ': ' +
                        opening.name }}</option>
                </select>
            </div>

            <div class="field__wrp">
                <label for="titles" class="field__label">Filter by titles</label>
                <select v-model="query.titles" id="titles" :class="[query.titles !== null ? 'field active' : 'field']"
                    name="titles">
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
            {{ this.results ? 'Showing games that' : 'Found no games that' }} {{ this.queryDesc }}
            <button class="link-arrow is--low-op is--margin-left" @click="resetQuery()">
                Remove filters
                <Icon name="filter-remove" />
            </button>
        </div>
    </div>
</template>

<script>

import { router } from '@inertiajs/vue3';
import throttle from 'lodash/throttle';

export default {

    props: {
        advanced: true,
        results: false,
    },

    data() {
        return {

            advancedShow: false,

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
                sort: typeof this.$page.props.route.query.sort === 'string' ? this.$page.props.route.query.sort : (this.advanced ? 'recent-desc' : null),
                page: this.$page.props.games.current_page || null,
            },
        }
    },

    methods: {

        highlightText() {

            const regex = new RegExp(this.query.search, 'gi');

            const textElements = document.querySelectorAll('li p, li .name, li .players span, li strong, li h2, li h3, li .banner span:last-child, li .flag .info span');

            textElements.forEach((element) => {

                if (element.closest('.last-slide')) return;

                let text = element.innerHTML;
                text = text.replace(/(<mark class="highlight">|<\/mark>)/gim, '');

                element.innerHTML = text.replace(regex, '<mark class="highlight">$&</mark>');

            });

            return;
        },

        resetQuery() {

            router.visit(window.location.href.split('?')[0], {
                only: ['games'],
                preserveScroll: true,
                preserveState: true,

                onFinish: visit => {
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
                    };
                },
            });

        },

        onKeydown(e) {
            if (e.code == "KeyK" && e.metaKey) this.$refs.search.focus();
        }

    },

    computed: {
        queryDesc() {
            let params = [];

            if (this.$data.search) params.push('match "' + this.$data.search + '"');
            if (this.query.dateFrom) params.push('was played after ' + this.$data.query.dateFrom);
            if (this.query.dateTo) params.push('was played before ' + this.$data.query.dateTo);
            if (this.query.wcc !== null) params.push(this.query.wcc ? 'were part of the WCC' : 'were not part of the WCC');
            if (this.query.country) params.push('had at least one player who competed for ' + this.$data.query.country);
            if (this.query.player) {

                let obj = this.$page.props.players;
                let id = this.$data.query.player

                this.$page.props.players.forEach(function (player) {
                    if (player.id == id) {
                        let name = player.name.split(', ')
                        params.push(name[1] + ' ' + name[0] + ' played');
                    }
                });
            }
            if (this.query.result !== null) {
                if (this.query.result == '1-0') {
                    params.push('White won');
                } else if (this.query.result == '0-1') {
                    params.push('Black won');
                } else {
                    params.push('was a draw');
                }
            }
            if (this.query.opening !== null) {
                this.$page.props.openings.forEach(element => {
                    if (element.id == this.$data.query.opening) params.push('started as "' + element.name + '"');
                })
            }
            if (this.query.titles !== 'null') {
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

            if (params.length) return params.join(', ').replace(/,([^,]*)$/, ' and' + '$1');
            else return false;
        },

        getOS() {
            if (navigator.userAgentData.mobile) return '';
            else if (navigator.userAgentData.platform.toUpperCase().indexOf('MAC') != -1) return '⌘ + K'
            else return '⊞ Win + K'
        }
    },

    watch: {

        search: throttle(function (value) {
            this.$data.query.search = this.$data.search != "" ? this.$data.search : null;
        }, 500),

        query: {
            handler() {

                if (this.$page.props.games.current_page) this.$data.query.page = 1;

                let params = {};

                for (var key in this.$data.query) {

                    if (this.$data.query.hasOwnProperty(key) && this.$data.query[key] !== null && this.$data.query[key] !== 'null') {
                        params[key] = this.$data.query[key];
                    }
                }

                router.visit(window.location.href.split('?')[0], {
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
        window.addEventListener('keydown', this.onKeydown)
        console.log(this.$page.props.players);
    },

    beforeDestroy() {
        window.removeEventListener('keydown', this.onKeydown)
    }
}

</script>