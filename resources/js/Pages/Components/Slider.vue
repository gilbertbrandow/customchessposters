<template>
    <section>
        <div class="container">
            <h2>The Most Recent Games From Our Collection</h2>

            <div class="slider__header">
                <Filter :results="this.games.length" :advanced="false"></Filter>

                <div class="slider__navigation">
                    <button @click="this.changeSlide(false)" aria-label="next slide" class="button is--only-icon is--outline is--flipped">
                        <Icon name="arrow-right"></Icon>
                    </button>
                    <button @click="this.changeSlide(true)" aria-label="previous slide" class="button is--only-icon is--outline">
                        <Icon name="arrow-right"></Icon>
                    </button>
                </div>
            </div>
            <div class="slider" @touchstart="touchStart($event)" @touchend="touchEnd($event)">
                <ul class="game__collection is--slider" :style="{ 'margin-left': (-22.25 * this.currSlide) + 'em' }">
                    <Game v-for="(game, index) in this.games" :game="game" :small="true" :showPlayersInPoster="true"></Game>

                    <li class="last-slide" v-if="this.games.length > 3">
                        <h3>Do you want to see more games like this?</h3>
                        <p>We are constantly adding new games to our
                            <Link class="text__link" :href="route('game.index')">Game Collection</Link> and you will likely
                            find a game there that will pique your interest. If you cant find the game you are looking for, you
                            can always
                            <Link class="text__link" :href="route('poster.index')">create the poster yourself!</Link>
                        </p>
                    </li>

                    <li class="last-slide" v-if="!this.games.length">
                        <h3>Could you not find the game you were looking for?</h3>
                        <p>You might have better luck finding it by using our advanced filter options in the
                            <Link class="text__link" :href="route('game.index')">Game Collection</Link>. If you still can not find your game, you
                            can always
                            <Link class="text__link" :href="route('poster.index')">create any poster yourself!</Link>
                        </p>
                    </li>

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
            xStart: null, 
        }
    },

    methods: {
        changeSlide(direction) {
            if (direction) this.currSlide < this.games.length ? this.currSlide++ : this.currSlide = 0;
            else if (!direction && this.currSlide) this.currSlide--; 
        },

        touchStart(touchStart) {
            this.xStart = touchStart.changedTouches[0].clientX; 
            return; 
        },

        touchEnd(touchEnd) {

            if(Math.abs(touchEnd.changedTouches[0].clientX - this.xStart) < 20) return; 

            if(touchEnd.changedTouches[0].clientX < this.xStart) this.changeSlide(true); 
            else this.changeSlide(false); 

        }
    },

     watch: {
        'games.length'() {
            this.currSlide = 0; 
        },
    },

}
</script>