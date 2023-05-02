<template>
    <section>
        <div class="container">
            <h2>Some Recent Games From Our Collection</h2>

            <div class="slider__header">
                <Filter :results="this.games.length" :advanced="false"></Filter>

                <div class="slider__navigation">
                    <button class="button is--only-icon is--black is--flipped"><Icon name="arrow-right"></Icon></button>
                    <button class="button is--only-icon is--black"><Icon name="arrow-right"></Icon></button>
                </div>
            </div>
            <ul class="game__collection is--slider">
                <template v-for="(game, index) in this.games" :key="index">
                    <Game :game="game" :small="true" :showPlayersInPoster="true"></Game>
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

}
</script>