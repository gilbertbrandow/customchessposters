<template>
    <section class="section__hero" ref="hero">
        <div class="container">
            <h1>Create Your Own Personal & Unique Chess Poster</h1>
            <p>
                There are more theoretically possible chess games than there are
                atoms in the known universe. Now there are equally many posters for you to choose from.
            </p>
            <div class="button-wrp">
                <Link :href="route('poster.index')" class="button is--black">Create your own poster</Link>
                <Link :href="route('game.index')" class="button">Game collection
                <Icon name="arrow-up" />
                </Link>
            </div>
        </div>
        <div class="poster-wrp">
            <div class="poster">
                <div class="poster__svg-wrp">
                    <Poster :poster="$page.props.game.poster" />
                </div>

                <img class="poster__environment" :alt="'Poster: ' +
                    $page.props.game.poster.title +
                    ' shown in a warmly lit room with frame'
                    " src="../../../public/images/environments/poster-environment-oak-frame-300x315.webp" srcset="
                        ../../../public/images/environments/poster-environment-oak-frame-1500x1574.webp 1500w,
                        ../../../public/images/environments/poster-environment-oak-frame-750x787.webp    750w,
                        ../../../public/images/environments/poster-environment-oak-frame-300x315.webp    300w
                    " />
                <img class="poster__environment is__mobile" :alt="'Poster: ' +
                    $page.props.game.poster.title +
                    ' shown in a warmly lit room with frame'
                    " src="../../../public/images/environments/poster-mockup-oak-frame-1200x1490.webp" srcset="
                        ../../../public/images/environments/poster-mockup-oak-frame-1200x1490.webp 1500w,
                        ../../../public/images/environments/poster-mockup-oak-frame-600x745.webp    750w,
                        ../../../public/images/environments/poster-mockup-oak-frame-300x372.webp    300w
                    " />
            </div>

            <div class="game__info">
                <Link :href="route('game.show', $page.props.game.id)" class="players">
                <div class="player">
                    <Flag :country="$page.props.game.white_player.country"></Flag>
                    {{ $page.props.game.white_player.name }}
                    <div v-if="$page.props.game.white_player.computer" class="computer">
                        <Icon name="computer"></Icon>
                    </div>
                </div>
                -
                <div class="player">
                    <Flag :country="$page.props.game.black_player.country"></Flag>
                    {{ $page.props.game.black_player.name }}
                    <div v-if="$page.props.game.black_player.computer" class="computer">
                        <Icon name="computer"></Icon>
                    </div>
                </div>
                </Link>

                <div class="progress-bar">
                    <div :style="{ width: 100 - this.timer + '%' }"></div>
                </div>

                <div class="button-wrp">
                    <button class="button" aria-label="replay" @click="this.resetCurrGame()">
                        <Icon name="undo"></Icon>
                    </button>

                    <button v-if="this.status" class="button" aria-label="pause" @click="this.pause()">
                        <Icon name="pause"></Icon>
                    </button>
                    <button v-else class="button is--play" aria-label="resume" @click="this.start()">
                        <Icon name="play"></Icon>
                    </button>
                    <button class="button" aria-label="next" @click="this.updateGame()">
                        <Icon name="arrow-right"></Icon>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <Features />

    <BuildPoster />

    <Slider :games="$page.props.games" />

    <Faq :faqs="$page.props.faqs" />
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import BuildPoster from "./Components/BuildPoster.vue";
import Faq from "./Components/Faq.vue";
import Features from "./Components/Features.vue";
import Poster from "./Components/Poster/PosterSVG.vue";
import Flag from "../Icons/Flags.vue";
import Slider from "./Components/Slider.vue";
import { Chess } from "chess.js";
import { router } from "@inertiajs/vue3";
import throttle from "lodash/throttle";

const INTERVAL = 20000;

export default {
    components: {
        BuildPoster,
        Faq,
        Features,
        Poster,
        Flag,
        Slider,
    },
    layout: AppLayout,

    data() {
        return {
            status: null,
            timerId: null,
            timer: 0,
            chessGame: new Chess(),
            moves: [],
            currMove: 0,
            observer: null,
            isScrolled: false,
            options: {
                root: null,
                threshold: 1,
                rootMargin: "20% 0px 100% 0px",
            },
            games: [],
        };
    },

    methods: {
        updateGame() {
            router.reload({
                only: ["game"],
                preserveState: true,
                preserveScroll: true,
                onFinish: (visit) => {
                    this.getTwentyMoves();
                    this.start(true);
                },
            });
        },

        getTwentyMoves() {
            this.moves = [];
            this.currMove = 0;
            this.chessGame.fen(this.$page.props.game.poster.starting_position);
            this.chessGame.loadPgn(this.$page.props.game.poster.pgn);
            let history = this.chessGame.history({ verbose: true });
            let move = this.$page.props.game.poster.diagram_position;
            if (move - 6 < 0) move = 3;
            else if (move + 16 > history.length)
                move = history.length - 16 > 0 ? history.length - 16 : 6;

            for (let i = -3; i < 17; i++) {

                if (history[move + i])
                    this.moves.push([
                        move + i,
                        move + i ==
                            this.$page.props.game.poster.diagram_position
                            ? this.$page.props.game.poster.move_comment
                            : "",
                        history[move + i].fen,
                        history[move + i - 1].to,
                        history[move + i - 1].from,
                    ]);
                else if (history[move + i - 1])
                    this.moves.push([
                        move + i,
                        move + i ==
                            this.$page.props.game.poster.diagram_position
                            ? this.$page.props.game.poster.move_comment
                            : "",
                        this.chessGame.fen(),
                        history[move + i - 1].to,
                        history[move + i - 1].from,
                    ]);
            }
        },

        updateMove() {
            if (this.currMove == this.moves.length) return;

            this.$page.props.game.poster.diagram_position =
                this.moves[this.currMove][0];
            this.$page.props.game.poster.move_comment =
                this.moves[this.currMove][1];
            this.$page.props.game.poster.fen = this.moves[this.currMove][2];
            this.$page.props.game.poster.to = this.moves[this.currMove][3];
            this.$page.props.game.poster.from = this.moves[this.currMove][4];


            this.currMove++;
        },

        resetCurrGame() {
            this.currMove = 0;
            this.start(true);
        },

        start(restart) {
            clearInterval(this.timerId);
            this.status = true;
            this.timer =
                this.timer > 0 && !restart ? this.timer : INTERVAL / 200;
            this.timerId = setInterval(() => {
                this.timer -= 1;
            }, INTERVAL / 100);
        },

        pause() {
            clearInterval(this.timerId);
            this.status = false;
        },

        onElementObserved(entries) {
            entries.forEach(({ target, isIntersecting }) => {
                let nav = document.querySelector("nav");

                if (!nav) {
                    return;
                } else if (isIntersecting) {
                    this.start();
                    nav.classList.remove("is--scrolled");
                } else {
                    this.pause();
                    nav.classList.add("is--scrolled");
                }
            });
        },

        getGames() {
            router.visit("/", {
                method: "get",
                data: {
                    offset: this.games.length,
                },
                only: ["games"],
                preserveScroll: true,
                preserveState: true,
                onFinish: (visit) => {
                    this.games.push(this.$page.props.games[0]);
                },
            });
        },
    },

    watch: {
        timer(newTime) {
            if (newTime % (INTERVAL / 4000) == 0) this.updateMove();
            else if (newTime === -1) {
                this.updateGame();
            }
        },

        search: throttle(function (value) {
            router.visit("/", {
                method: "get",
                only: ["games"],
                data: params,
                preserveScroll: true,
                preserveState: true,
                onFinish: (visit) => {
                    this.highlightText();
                },
            });
        }, 500),
    },

    mounted() {
        this.getTwentyMoves();
        this.start();
        this.games.push(
            this.$page.props.games[0],
            this.$page.props.games[1],
            this.$page.props.games[2]
        );

        this.observer = new IntersectionObserver(
            this.onElementObserved,
            this.options
        );

        this.observer.observe(this.$refs.hero);
    },

    beforeDestroy() {
        clearInterval(this.timerId);
        this.observer.unobserve(this.$refs.hero);
    },
};
</script>
