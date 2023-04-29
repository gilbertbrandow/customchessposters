<template>
    <section class="section__hero" ref="hero">
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
        <div class="poster-wrp">
            <div class="poster">
                <div class="poster__svg-wrp">
                    <Poster :poster="this.$page.props.game.poster" />
                </div>

                <img class="poster__environment" src="/images/environments/warm.jpg" />
            </div>

            <div class="game__info">

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

                <div class="button-wrp">

                    <button v-if="this.status" class="button" @click="this.pause()">
                        <Icon name="pause"></Icon>
                    </button>
                    <button v-else class="button is--play" @click="this.start()">
                        <Icon name="play"></Icon>
                    </button>
                    <button class="button" @click="this.updateGame()">
                        <Icon name="arrow-right"></Icon>
                    </button>

                </div>
            </div>
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

const INTERVAL = 10000;

export default {
    components: {
        BuildPoster,
        Faq,
        Features,
        Poster,
        Flag,
    },
    layout: AppLayout,

    data() {
        return {
            status: null,
            timerId: null,
            timer: 0,
            observer: null,
            isScrolled: false,
            options: {
                root: null,
                threshold: 1,
                rootMargin: "20% 0px 100% 0px",
            }
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
            this.status = true;
            this.timer = this.timer > 0 && !restart ? this.timer : INTERVAL / 100;
            this.timerId = setInterval(() => {
                this.timer -= 1;
            }, 100);
        },

        pause() {
            clearInterval(this.timerId);
            this.status = false;
        },

        onElementObserved(entries) {

            entries.forEach(({ target, isIntersecting }) => {

                if (isIntersecting) {
                    this.start();
                    document.querySelector('nav').classList.remove('is--scrolled');
                }
                else {
                    this.pause();
                    document.querySelector('nav').classList.add('is--scrolled');
                }
            });
        }
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

        this.observer = new IntersectionObserver(
            this.onElementObserved, this.options);

        this.observer.observe(this.$refs.hero);
    },

    beforeDestroy() {
        clearInterval(this.timerId);
        this.observer.unobserve(this.$refs.hero);
    },
}
</script>