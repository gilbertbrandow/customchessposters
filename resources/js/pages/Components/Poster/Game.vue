<template>
    <svg x="40" y="15" view-box="0 0 1600 1600">

        <Board />

        <template v-for="(value, piece) in pieces" :key="piece">
            <svg v-if="!value[0]" width="200" height="200" fill="none" viewbox="0 0 200 200"
                :x="this.$parent.poster.orientation == 'w' ? (value[1].charCodeAt(0) - 97) * 200 : (7 - (value[1].charCodeAt(0) - 97)) * 200"
                :y="this.$parent.poster.orientation == 'w' ? (8 - Number(value[1][1])) * 200 : (Number(value[1][1]) - 1) * 200">
                <Pieces :piece="value[2]" />
            </svg>
        </template>

    </svg>
</template>

<script>
import Board from '../../../Themes/Old Knowledge/Board.vue';
import Pieces from '../../../Themes/Old Knowledge/Pieces.vue';

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
            pieces: {},
            boardPosition: 0,
        }
    },

    methods: {

        //The method to visually move the piece on the board. Direction = 0 || false lets function know to undo the move
        movePiece(from, to, moveNumber, san, direction) {

            if (!direction) {
                let temp = from;
                from = to;
                to = temp;
            }

            //Handling castling
            if (san == "O-O" && (from == "e1" || from == "g1")) this.movePiece("h1", "f1", 1, false, direction);
            else if (san == "O-O" && (from == "e8" || from == "g8")) this.movePiece("h8", "f8", 1, false, direction);
            else if (san == "O-O-O" && (from == "e1" || from == "c1")) this.movePiece("a1", "d1", 1, false, direction);
            else if (san == "O-O-O" && (from == "e8" || from == "c8")) this.movePiece("a8", "d8", 1, false, direction);

            for (var piece in this.pieces) {

                //Remove or put back captured piece
                if (this.pieces[piece][1] == to && this.boardPosition < this.diagramPosition) {

                    if (!this.pieces[piece][0]) this.pieces[piece][0] = moveNumber;
                    continue;

                } else if (this.pieces[piece][1] == from && this.boardPosition >= this.diagramPosition && this.pieces[piece][0] == moveNumber && moveNumber != 0) {
                    this.pieces[piece][0] = 0;
                    continue;
                }

                //Move piece if on move coordinate and not captured
                if (this.pieces[piece][1] == from && !this.pieces[piece][0]) {
                    this.pieces[piece][1] = to;

                    //Handle promotion of piece
                    if(san.includes("=")) this.pieces[piece][2] =  (direction) ? this.pieces[piece][2].slice(0, -1) + san[san.indexOf("=") + 1] : this.pieces[piece][2].slice(0, -1) + "p";
                }
            }

        },

        startingPosition() {

            const pieces = {
                //White pieces
                "wp0": [0, "a2", "wp"],
                "wp1": [0, "b2", "wp"],
                "wp2": [0, "c2", "wp"],
                "wp3": [0, "d2", "wp"],
                "wp4": [0, "e2", "wp"],
                "wp5": [0, "f2", "wp"],
                "wp6": [0, "g2", "wp"],
                "wp7": [0, "h2", "wp"],
                "wR0": [0, "a1", "wR"],
                "wR1": [0, "h1", "wR"],
                "wN0": [0, "b1", "wN"],
                "wN1": [0, "g1", "wN"],
                "wB0": [0, "c1", "wB"],
                "wB1": [0, "f1", "wB"],
                "wQ": [0, "d1", "wQ"],
                "wK": [0, "e1", "wK"],

                //Black pieces
                "bp0": [0, "a7", "bp"],
                "bp1": [0, "b7", "bp"],
                "bp2": [0, "c7", "bp"],
                "bp3": [0, "d7", "bp"],
                "bp4": [0, "e7", "bp"],
                "bp5": [0, "f7", "bp"],
                "bp6": [0, "g7", "bp"],
                "bp7": [0, "h7", "bp"],
                "bR0": [0, "a8", "bR"],
                "bR1": [0, "h8", "bR"],
                "bN0": [0, "b8", "bN"],
                "bN1": [0, "g8", "bN"],
                "bB0": [0, "c8", "bB"],
                "bB1": [0, "f8", "bB"],
                "bQ": [0, "d8", "bQ"],
                "bK": [0, "e8", "bK"],
            }; 

            this.$data.pieces = pieces;
            this.$data.boardPosition = 0;
        },

    },

    watch: {

        diagramPosition() {

            //Get history TODO: Dont work if move is undone, the last history[] cant be retrieved
            var history = this.$parent.$parent.chessGame.history({ "verbose": true });

            if (this.boardPosition < this.diagramPosition) {

                for (let i = this.boardPosition; i < this.diagramPosition; i++) {

                    this.movePiece(history[i].from, history[i].to, i, history[i].san, 1);

                    this.boardPosition++;
                }

            } else {

                for (let i = this.boardPosition - 1; i >= this.diagramPosition; i--) {

                    this.movePiece(history[i].from, history[i].to, i, history[i].san, 0);

                    this.boardPosition--;
                }

            }



        }

    },

    mounted() {
        this.startingPosition();
    },

}
</script>