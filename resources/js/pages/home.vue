<template>
    <section class="section__hero">
        <div class="container">
            <h1>Create your own personal & unique chess poster</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum
                tristique. </p>
            <div class="button-wrp">
                <Link :href="route('poster.show')" class="button is--black">Create your own custom poster</Link>
                <Link :href="route('game.index')" class="button">See all games
                <Icon name="arrow-up" />
                </Link>
            </div>
        </div>
        <div class="poster">
            <div class="poster__svg-wrp">
                <Poster :poster="this.$page.props.game.poster" />
            </div>

            <div class="game__info" @mouseenter="this.pause()" @mouseleave="this.start()">

                <Link :href="route('game.show', this.$page.props.game.id)" class="players">
                <div>
                    <Flag :country="this.$page.props.game.white_player.country"></Flag>
                    {{ this.$page.props.game.white_player.name }}
                </div>
                     - 
                <div>
                    <Flag :country="this.$page.props.game.black_player.country"></Flag>
                    {{ this.$page.props.game.black_player.name }}
                </div>
                </Link>

                <div class="progress-bar">
                    <div :style="{ 'width': 100 - this.timer + '%' }"></div>
                </div>
                <button class="button" @click="this.updateGame()">
                    <Icon name="arrow-right"></Icon>
                </button>
            </div>

            <img class="poster__environment" src="/images/environments/warm.jpg" />
        </div>
    </section>

    <Features />

    <BuildPoster />

    <Faq :faqs="$page.props.faqs" />
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import BuildPoster from "./Components/BuildPoster.vue"
import Faq from "./Components/Faq.vue";
import Features from "./Components/Features.vue"
import Poster from "./Components/Poster/PosterSVG.vue"
import Flag from "../Icons/Flags.vue"
import { router } from '@inertiajs/vue3'
import { onMounted } from 'vue';

const INTERVAL = 10000;

export default {
    components: {
        BuildPoster,
        Faq,
        Features,
        Poster,
    },
    layout: AppLayout,

    data() {
        return {
            status: 'Stopped',
            timerId: null,
            timer: 0,
        }
    },

    methods: {
        updateGame() {
            router.reload({
                only: ['game'],
                preserveState: true,
                preserveScroll: true,
                onFinish: visit => {
                        this.start(true);
                },
            })
        },

        start(restart) {
            clearInterval(this.timerId);
            this.status = 'Running';
            this.timer = this.timer > 0 && !restart ? this.timer : INTERVAL / 100;
            this.timerId = setInterval(() => {
                this.timer -= 1;
            }, 100);
        },

        pause() {
            clearInterval(this.timerId);
            this.status = 'Paused';
        },
    },

    watch: {
        timer(newTime) {
            if (newTime === -1) {
                this.updateGame();
                this.start();
            }
        },
    },

    mounted() {
        this.start();
    },

    beforeDestroy() {
        clearInterval(this.timerId);
    }
}
</script>

<script setup>

onMounted(() => {

    const nav = document.querySelector('nav');
    const heroSection = document.querySelector('section');

    const options = {
        root: null,
        threshold: 1,
        rootMargin: "3% 0px 100% 0px",
    }

    const observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if ((nav.classList.length && entry.isIntersecting)) {
                nav.classList.remove('is--scrolled');
            } else {
                nav.classList.add('is--scrolled');
            }
        })
    }, options);

    observer.observe(heroSection);

});

</script>