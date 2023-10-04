<template>
    <section>
        <div class="container">
            <ul class="game__collection is--single">
                <li class="single">
                    <div class="content">
                        <h1 v-text="this.$data.game.name"></h1>

                        <div class="player">
                            <div class="flag">
                                <Flags :country="this.$data.game.white_country" />
                                <div class="info">
                                    <div></div><span>{{ this.$data.game.white_country }}</span>
                                </div>
                            </div>
                            <div class="name">{{ this.$data.game.white_name }} ({{ this.$data.game.white_rating
                                ? this.$data.game.white_rating : 'N/A' }})</div>
                        </div>

                        <div class="player">
                            <div class="flag" @mouseover="removeClass($event)">
                                <Flags :country="this.$data.game.black_country" />
                                <div class="info">
                                    <div></div><span>{{ this.$data.game.black_country }}</span>
                                </div>
                            </div>
                            <div class="name">{{ this.$data.game.black_name }} ({{ this.$data.game.black_rating
                                ? this.$data.game.black_rating : 'N/A' }})</div>
                        </div>

                        <div :class="['banner', this.$data.game.world_championship_game ? 'is--icon' : '']">
                            <Icon v-if="this.$data.game.world_championship_game" name="king" />
                            <span
                                v-text="(this.$data.game.world_championship_game) ? 'World Championship' : 'Played'"></span><span>{{
                                    this.$data.game.date + ' in ' + this.$data.game.where }}</span>
                        </div>

                        <div class="move__navigation">
                            <button class="button" @click="this.makeMove(false)">
                                <Icon name="arrow-right"></Icon>
                            </button>
                            <div>
                                {{ this.moveInfo }}
                            </div>
                            <button class="button" @click="this.makeMove(true)">
                                <Icon name="arrow-right"></Icon>
                            </button>
                        </div>

                        <strong class="is--small">{{ this.$data.game.opening_eco + ': ' +
                            this.$data.game.opening_name }}</strong>

                        <p>{{ this.$data.game.description }}</p>

                        <PosterChooseVariantButton :poster="{
                            'theme_id': this.$data.game.theme_id,
                            'orientation': this.$data.game.orientation,
                            'starting_position': this.$data.game.starting_position,
                            'pgn': this.$data.game.pgn,
                            'diagram_position': this.$data.game.diagram_position,
                            'move_comment': this.$data.game.move_comment,
                            'fen': this.$data.game.fen,
                            'result': this.$data.game.result,
                            'title': this.$data.game.title,
                            'white_player': this.$data.game.white_player,
                            'black_player': this.$data.game.black_player,
                            'white_rating': this.$data.game.white_rating,
                            'black_rating': this.$data.game.black_rating,
                            'white_title': this.$data.game.white_title,
                            'black_title': this.$data.game.black_title,
                            'when': this.$data.game.when,
                            'where': this.$data.game.where,
                        }" />
                    </div>
                    <Poster :poster="this.$data.game" environment="builder-mockup.webp"
                        :controls="{ 'save': true, 'edit': true, }"></Poster>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import Poster from "./Components/Poster.vue";
import Flags from "../Icons/Flags.vue";
import PosterChooseVariantButton from "./Components/PosterChooseVariantButton.vue";
import { Chess } from 'chess.js';
import { Link } from "@inertiajs/vue3";

export default {

    layout: AppLayout,

    components: {
        Poster,
        Flags,
        Link,
        PosterChooseVariantButton,
    },

    data() {
        return {
            chessGame: new Chess(),
            game: this.$page.props.game,
            moveComment: [this.$page.props.game.diagram_position, this.$page.props.game.move_comment],
        }
    },

    methods: {
        makeMove(direction) {
            if (direction && this.chessGame.history().length > this.game.diagram_position) this.game.diagram_position++
            else if (!direction && this.game.diagram_position > 0) this.game.diagram_position--
        },

        onKeydown(e) {
            switch (e.key) {
                case 'ArrowRight':
                    if (this.game.diagram_position < this.chessGame.history().length) this.game.diagram_position++;
                    break;

                case 'ArrowLeft':
                    if (this.game.diagram_position > 0) this.game.diagram_position--;
                    break;

                case 'ArrowDown':
                    this.game.diagram_position = 0;
                    break;

                case 'ArrowUp':
                    this.game.diagram_position = this.chessGame.history().length;
                    break;
            }
        },
    },

    computed: {
        moveInfo() {
            if (this.game.diagram_position == 0) return 'Starting position';

            let pgn = this.game.pgn;

            //Loop through the array until finding correct move number and set starting index of that move
            let indexOfMove = pgn.indexOf((Math.round(this.game.diagram_position / 2)) + '.') + Math.round(this.game.diagram_position / 2).toString().length + 2;

            //Get index of next space
            let spaceIndex = pgn.indexOf(' ', indexOfMove);

            if (spaceIndex == -1) { spaceIndex = pgn.length }

            //Depending on if half move or not, look until next ' ', or from next ' ' to the one after that
            if (this.game.diagram_position % 2 != 0) {
                //White move
                return "Position after White's move " + Math.round(this.game.diagram_position / 2) + '. ' + pgn.substring(indexOfMove, spaceIndex);
            } else {
                //Black move
                let nextSpaceIndex = (pgn.indexOf(' ', spaceIndex + 1) > 0) ? pgn.indexOf(' ', spaceIndex + 1) : pgn.length;

                return "Position after Black's move " + Math.round(this.game.diagram_position / 2) + '. ... ' + pgn.substring(spaceIndex + 1, nextSpaceIndex);
            }
        }
    },

    watch: {
        'game.diagram_position'() {
            const history = this.chessGame.history({ verbose: true });

            if (this.game.diagram_position != this.moveComment[0]) this.game.move_comment = '';
            else this.game.move_comment = this.moveComment[1];

            if (history.length == this.game.diagram_position) {
                this.$data.game.fen = this.chessGame.fen();
            } else {
                this.$data.game.fen = history[this.game.diagram_position].fen;
            }
        },
    },

    mounted() {
        this.chessGame.fen(this.$data.game.starting_position)
        this.chessGame.loadPgn(this.$data.game.pgn)
        window.addEventListener('keydown', this.onKeydown)
    },

    beforeDestroy() {
        window.removeEventListener('keydown', this.onKeydown)
    }


}
</script>
