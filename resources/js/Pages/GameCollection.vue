<template>
    <section>
        <div class="container">
            <h1>Game Collection</h1>
            <Filter :results="$page.props.games.data.length" :advanced="true"></Filter>
            <ul class="game__collection">
                <Game v-for="game in $page.props.games.data" :game="game"></Game>
            </ul>
            <aside v-if="$page.props.games.data" class="pagination is--flex is--space-between">
                <span>Showing {{ $page.props.games.from }} - {{ $page.props.games.to }} of {{ $page.props.games.total }}
                    results </span>
                <div class="navigation">
                    <div class="arrow" :class="[$page.props.games.current_page == 1 ? 'inactive' : '']"
                        @click="pageChange(false)">
                        <Icon name="arrow-right"></Icon>
                    </div>
                    <div class="pages">
                        <template v-for="(link, index) in $page.props.games.links">
                            <div v-if="index > 0 && index < $page.props.games.links.length - 1"
                                @click="this.pageChange(null, index)"
                                :class="[link.active ? 'page-link active' : 'page-link']" v-text="link.label"></div>
                        </template>
                    </div>
                    <div class="arrow"
                        :class="[$page.props.games.current_page == $page.props.games.last_page ? 'inactive' : '']"
                        @click="pageChange(true)">
                        <Icon name="arrow-right"></Icon>
                    </div>
                </div>
            </aside>
        </div>
    </section>
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import Game from './Components/Game.vue';
import Filter from './Components/Filter.vue';
import { router } from '@inertiajs/vue3';

export default {

    layout: AppLayout,

    components: {
        Game,
        Filter,
    },

    data() {
        return {
            page: this.$page.props.games.current_page,
        }
    },

    methods: {
        pageChange(direction, index) {

            if (direction === null && index) {
                this.$data.page = index;
            } else if (direction && this.$data.page != this.$page.props.games.last_page) {
                this.$data.page++
            } else if (!direction && this.$data.page != 1) {
                this.$data.page--
            }

            router.reload({
                method: 'get',
                only: ['games'],
                data: {
                    page: this.$data.page
                },
                preserveScroll: true,
                preserveState: true,
            })

            return;
        },
    }
}
</script>
