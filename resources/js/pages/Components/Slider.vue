<template>
    <section>
        <div class="container">
            <h2>Some Recent Games From Our Collection</h2>

            <div class="slider__header">
                <Filter :results="this.games.length" :advanced="false"></Filter>

                <div class="slider__navigation">
                    <button @click="this.changeSlide(false)" class="button is--only-icon is--outline is--flipped">
                        <Icon name="arrow-right"></Icon>
                    </button>
                    <button @click="this.changeSlide(true)" class="button is--only-icon is--outline">
                        <Icon name="arrow-right"></Icon>
                    </button>
                </div>
            </div>
            <div class="slider">
                <ul class="game__collection is--slider" :style="{ 'margin-left': (-22.25 * this.currSlide) + 'em' }">
                        <Game v-for="(game, index) in this.games" :game="game" :small="true" :showPlayersInPoster="true"></Game>
                </ul>
            </div>
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

    data() {
        return {
            currSlide: 0,
        }
    },

    methods: {
        changeSlide(direction) {
            if(direction) this.currSlide < this.games.length - 1 ? this.currSlide++ : this.currSlide = 0
            else if(!direction) this.currSlide > 0 ? this.currSlide-- : this.currSlide = this.games.length - 1
        },
    }

}
</script>