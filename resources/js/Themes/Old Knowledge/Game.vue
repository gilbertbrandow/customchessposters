<template>
    <svg x="40" y="15" view-box="0 0 1600 1600">

        <Board />

        <template v-for="(coordinates, piece) in pieces" :key="coordinates">
            <svg v-if="coordinates[0]" width="200" height="200" fill="none" viewbox="0 0 200 200"
                :x="this.$parent.poster.orientation == 'w' ? (coordinates[1].charCodeAt(0) - 97) * 200 : (7 - (coordinates[1].charCodeAt(0) - 97)) * 200"
                :y="this.$parent.poster.orientation == 'w' ? (8 - Number(coordinates[1][1])) * 200 : (Number(coordinates[1][1]) - 1) * 200">
                <Pieces :piece="piece.substring(0, 2)" />
            </svg>
        </template>

    </svg>
</template>

<script>
import Board from './Board.vue';
import Pieces from './Pieces.vue';

export default {

    components: {
        Pieces,
        Board,
    },

    props: {
        diagramPosition: 0,
    },

    data() {
        return {
            pieces: {


                //White pieces
                "wp0": [true, "a2",],
                "wp1": [true, "b2",],
                "wp2": [true, "c2",],
                "wp3": [true, "d2",],
                "wp4": [true, "e2",],
                "wp5": [true, "f2",],
                "wp6": [true, "g2",],
                "wp7": [true, "h2",],
                "wR0": [true, "a1",],
                "wR1": [true, "h1",],
                "wN0": [true, "b1",],
                "wN1": [true, "g1",],
                "wB0": [true, "c1",],
                "wB1": [true, "f1",],
                "wQ": [true, "d1",],
                "wK": [true, "e1",],

                //Black pieces
                "bp0": [true, "a7",],
                "bp1": [true, "b7",],
                "bp2": [true, "c7",],
                "bp3": [true, "d7",],
                "bp4": [true, "e7",],
                "bp5": [true, "f7",],
                "bp6": [true, "g7",],
                "bp7": [true, "h7",],
                "bR0": [true, "a8",],
                "bR1": [true, "h8",],
                "bN0": [true, "b8",],
                "bN1": [true, "g8",],
                "bB0": [true, "c8"],
                "bB1": [true, "f8",],
                "bQ": [true, "d8",],
                "bK": [true, "e8",],

            },

            boardPosition: 0,
        }
    },

    methods: {
        makeMove(from, to) {

            if (this.boardPosition > this.diagramPosition) {

                let temp = from;
                from = to;
                to = temp;
            }

            for (var piece in this.pieces) {

                //Remove or put back captured piece
                if (this.pieces[piece][1] == to) {
                    this.pieces[piece][0] ? false : true;
                }

                //Move piece
                if (this.pieces[piece][1] == from) this.pieces[piece][1] = to;
            }


        },

    },

    watch: {

        diagramPosition() {

            //Get history TODO: Dont work if move is undone, the last move cant be retrieved
            var history = this.$parent.$parent.chessGame.history({ "verbose": true });

            for (let i = this.boardPosition; i != this.diagramPosition;) {

                if (history[i].san == "O-O" && history[i].color == "w") this.makeMove("h1", "f1");
                else if (history[i].san == "O-O" && history[i].color == "b") this.makeMove("h8", "f8");
                else if (history[i].san == "O-O-O" && history[i].color == "w") this.makeMove("a1", "d1");
                else if (history[i].san == "O-O-O" && history[i].color == "b") this.makeMove("a8", "d8");

                this.makeMove(history[i].from, history[i].to);

                if(this.boardPosition > this.diagramPosition){
                    this.boardPosition--
                    i--
                } else {
                    this.boardPosition++;
                    i++
                } 
            }

        }

    },

    mounted() {
        //this.makeMove("e4");
    }

}
</script>