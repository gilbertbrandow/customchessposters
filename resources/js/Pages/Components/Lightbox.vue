<template>
    <div class="content lightbox" v-if="Object.keys(this.$page.props.lightbox).length">
        <div class="lightbox__mask" @click="[this.updateZoom(), this.mouseMove($event)]">
            <div class="poster" :class="[zoom ? 'is--zoomed' : '']">
                <div class="poster__svg-wrp" :class="this.slides[`${this.currSlide}`].class">
                    <Poster ref="PosterSVG" :poster="this.$page.props.lightbox" />
                </div>
                <img v-if="this.slides[`${this.currSlide}`].size == 's'" class="poster__environment"
                    src="../../../../public/images/environments/environment-small.jpg" />
                <img v-else-if="this.slides[`${this.currSlide}`].size == 'm'" class="poster__environment"
                    src="../../../../public/images/environments/environment-medium.jpg" />
                <img v-else-if="this.slides[`${this.currSlide}`].size == 'l'" class="poster__environment"
                    src="../../../../public/images/environments/environment-large.jpg" />
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
                    <button @click="this.$page.props.overlay = false, this.$page.props.lightbox = false;">
                        <Icon name="close" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Poster from './Poster/PosterSVG.vue';
import Icon from '../../Icons/Icon.vue';

export default {

    components: {
        Poster,
        Icon,
    },

    data() {
        return {
            currSlide: 0,
            zoom: false,

            //Create array to hold each environment and display by for loop in mask. Try to make it work with only one Poster element. 
            slides: [
                {
                    title: 'Small (30.5 x 46 cm)',
                    class: 'is--lightbox-small',
                    size: 's',
                },
                {
                    title: 'Medium (50 x 75cm)',
                    class: 'is--lightbox-medium',
                    size: 'm',
                },
                {
                    title: 'Large (61 x 91cm)',
                    class: 'is--lightbox-large',
                    size: 'l',
                },
            ],
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
            switch (e.key) {
                case 'ArrowRight':
                    this.nextSlide();
                    break;

                case 'ArrowLeft':
                    this.prevSlide();
                    break;
            }
        },

        updateZoom() {
            this.zoom = !this.zoom;
        },

        mouseMove(e) {

            // Get the target
            const target = document.querySelector('.lightbox__mask')

            // Get the bounding rectangle of target
            const element = target.getBoundingClientRect();

            // Mouse position
            const x = (e.clientX - element.left) / (element.right - element.left);
            const y = (e.clientY - element.top) / (element.bottom - element.top);

            if (x * 100 < 0.5 || y * 100 < 0.5 || x * 100 > 99.5 || y * 100 > 99.5) {
                this.zoom = false;
                return;
            }

            //Move poster element relative to the x and y. 
            target.querySelector('.poster').style.top = (50 - Math.max(y, 0) * 100) + '%';
            target.querySelector('.poster').style.right = (Math.max(x, 0) * 100 - 50) + '%';

        },
    },

    watch: {
        zoom() {
            if (this.zoom) document.querySelector('.lightbox__mask').addEventListener('mousemove', this.mouseMove);
            else {
                document.querySelector('.lightbox__mask').firstElementChild.style.top = '';
                document.querySelector('.lightbox__mask').firstElementChild.style.right = '';
                document.querySelector('.lightbox__mask').removeEventListener('mousemove', this.mouseMove);
            }

            return;
        },
    },

    mounted() {
        window.addEventListener('keydown', this.onKeydown); 
    }, 

    beforeUnmount() {
        window.removeEventListener('keydown', this.onKeydown);
    }
}
</script>