<template>
    <section>
        <div class="container">
            <h2>Games from our collection</h2>
            <Filter :results="this.games.length" :advanced="false"></Filter>
            <ul class="game__collection">
                <template v-for="(game, index) in this.games" :key="index">
                    <Game :game="game"></Game>
                </template>
            </ul>
        </div>
    </section>
</template>

<script>
import Game from "./Game.vue"
import Filter from "./Filter.vue"

export default {

    components: {
        Game,
        Filter,
    },

    props: {
        games: {},
    },

    mounted() {
        console.log(this.games);
    }

}
</script>