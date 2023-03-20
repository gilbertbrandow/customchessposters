<template>

    <div class="lightbox">
        <div class="content">

            <div class="lightbox__mask">

                <!-- TODO: Fix so that poster__svg-wrp is relative to image, not parent -->
                <div class="poster">
                    <div class="poster__svg-wrp">
                        <Poster ref="PosterSVG" :poster="poster" />
                    </div>
                    <img class="poster__environment" :src="this.slides[`${this.currSlide}`].src" />
                </div>
            </div>

            <div class="lightbox__footer">
                <h3>{{ this.slides[`${this.currSlide}`].title }}</h3>

                <div class="lightbox__nav">
                    <span> {{ this.currSlide + 1 }} / {{ this.slides.length }}</span>
                    <div class="lightbox__indexes">
                        <div v-for="(slide, index) in slides" :class="[index == this.currSlide ? 'active' : '']"
                            @click="this.currSlide = index"></div>
                    </div>
                    <div class="lightbox__arrows">
                        <button
                            @click="this.currSlide != 0 ? this.currSlide-- : this.currSlide = this.slides.length - 1">
                            <Icon name="small-arrow" />
                        </button>
                        <button
                            @click="this.currSlide != this.slides.length - 1 ? this.currSlide++ : this.currSlide = 0">
                            <Icon name="small-arrow" />
                        </button>
                    </div>
                </div>
            </div>

            <div>
            </div>

        </div>
    </div>

</template>

<script>
import Poster from './Poster/Poster.vue';
import Icon from '../../Icons/Icon.vue'

export default {
    props: {

    },

    components: {
        Poster,
        Icon,
    },

    data() {
        return {

            currSlide: 0,

            //Create array to hold each environment and display by for loop in mask. Try to make it work with only one Poster element. 
            slides: [
                {
                    title: 'Medium (50 x 75cm)',
                    src: '/images/environments/environment-medium.jpg',
                },
                {
                    title: 'Medium (50 x 75cm)',
                    src: '/images/environments/environment-medium.jpg',
                },
                {
                    title: 'Medium (50 x 75cm)',
                    src: '/images/environments/environment-medium.jpg',
                },
                {
                    title: 'Medium (50 x 75cm)',
                    src: '/images/environments/environment-medium.jpg',
                },
                {
                    title: 'Medium (50 x 75cm)',
                    src: '/images/environments/environment-medium.jpg',
                },
            ],

            poster: {
            name: "",
            theme: 1,
            orientation: true,
            pgn: "",
            diagram_position: 0,
            fen: "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR",
            result: "",
            title: "Lorem ipsum dolor sit amet, consectetur adi",
            white_player: "Magnus Carlsen",
            black_player: "Fabiano Caruana",
            white_rating: 2881,
            black_rating: 2815,
            white_title: "GM",
            black_title: "GM",
            when: "Tata Steel Chess, January 2014. Round 3",
            where: "Wijk aan Zee, Netherlands",
            },
        }
    }
}
</script>