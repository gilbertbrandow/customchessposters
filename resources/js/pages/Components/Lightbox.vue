<template>

    <div class="lightbox" v-if="this.visible">
        <div class="content">

            <div class="lightbox__mask" @click="this.zoom = !this.zoom">
                <!-- TODO: Make zoom effect by using css transform: scale(2.5) -->
                <div class="poster" :class="[zoom ? 'is--zoomed' : '']">
                    <!-- TODO: Fix so that poster__svg-wrp is relative to image, not parent -->
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
                        <button @click="this.prevSlide()">
                            <Icon name="small-arrow" />
                        </button>
                        <button @click="this.nextSlide()">
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
            visible: 1,
            currSlide: 0,
            zoom: true,

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
    },

    methods: {
        nextSlide() {
            this.currSlide != this.slides.length - 1 ? this.currSlide++ : this.currSlide = 0;
        },

        prevSlide() {
            this.currSlide != 0 ? this.currSlide-- : this.currSlide = this.slides.length - 1;
        },

        onKeydown(e) {
            if (this.visible) {
                switch (e.key) {
                    case 'ArrowRight':
                        this.nextSlide();
                        break;

                    case 'ArrowLeft':
                        this.prevSlide();
                        break;

                    case 'Escape':
                        this.visible = false;
                        break;
                }
            }
        },

        zoomIn() {
            if (!this.zoom) this.zoom = true;
            else return;
        },

        mouseMove(e) {

            // Get the target
            const target = document.querySelector('.lightbox__mask')

            // Get the bounding rectangle of target
            const element = target.getBoundingClientRect();

            // Mouse position
            const x = (e.clientX - element.left) / (element.right - element.left);
            const y = (e.clientY - element.top) / (element.bottom - element.top);

            //Move poster element relative to the x and y. 
            target.querySelector('.poster').style.top = (50 - Math.max(y, 0) * 100) + '%';
            target.querySelector('.poster').style.right = (Math.max(x, 0) * 100 - 50) + '%';

        },
    },

    computed: {
        zoomEvent() {
            if (this.$data.zoom) document.querySelector('.lightbox__mask').addEventListener('mousemove', this.mouseMove);
            else {
                document.querySelector('.lightbox__mask').firstElementChild.style.top = '';
                document.querySelector('.lightbox__mask').firstElementChild.style.right = '';
                document.querySelector('.lightbox__mask').removeEventListener('mousemove', this.mouseMove);
            }
        }
    },

    mounted() {
        window.addEventListener('keydown', this.onKeydown)
    },

    destroyed() {
        window.removeEventListener('keydown', this.onKeydown)
    },
}
</script>