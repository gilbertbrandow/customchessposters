<template>
    <svg x="0" y="27" view-box="0 0 1600 1600">

        <Board :theme="theme_id" />


        <Highlights v-if="this.$parent.poster.highlight_last_move && this.$parent.poster.to && this.$parent.poster.from" :to="this.$parent.poster.to" :from="this.$parent.poster.from"
            :orientation="this.$parent.poster.orientation" :theme="this.theme_id" />

        <template v-for="piece in pieces" :key="piece">
            <svg width="200" height="200" fill="none" viewbox="0 0 200 200"
                :x="this.$parent.poster.orientation ? piece[1] * 200 : (7 - piece[1]) * 200"
                :y="this.$parent.poster.orientation ? piece[2] * 200 : (7 - piece[2]) * 200">
                <Pieces :piece="piece[0]" :theme="this.theme_id" />
            </svg>
        </template>

    </svg>
</template>

<script>
import Board from '../../../Themes/Board.vue';
import Pieces from '../../../Themes/Pieces.vue';
import Highlights from '../../../Themes/Highlights.vue';

export default {

    components: {
        Pieces,
        Board,
        Highlights
    },

    props: {
        fen: "",
        theme_id: "",
        to: "",
        from: "",
    },

    data() {
        return {
            pieces: [],
        }
    },

    methods: {

        isLetter(str) {
            return str.length === 1 && str.match(/[a-z]/i);
        },

        loadBoard() {

            const fen = this.$props.fen;

            let column = 0;
            let row = 0;
            let pieces = [];

            //Loop through string
            for (let i = 0; i < fen.length; i++) {

                if (fen[i] == "/") {

                    row++;
                    column = 0;

                } else if (this.isLetter(fen[i])) {
                    pieces.push([fen[i], column, row])
                    column++;
                } else {

                    column += Number(fen[i]);

                }
            }

            this.pieces = pieces;

        }
    },

    watch: {

        fen() {

            this.loadBoard();

        },
    },

    mounted() {
        this.loadBoard();
    },

}
</script>