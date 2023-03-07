<template>
    <svg x="40" y="15" view-box="0 0 1600 1600">

        <Board />

        <template v-for="(coordinates, piece) in pieces" :key="coordinates">
            <svg v-if="!coordinates[0]" width="200" height="200" fill="none" viewbox="0 0 200 200"
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

            //Each piece has a unique key and consists of first a value indicating which move it was captured, 0 if not captured, and last known position. 
            //TODO: Add piece type to array to handle promotion

            pieces: {


                //White pieces
                "wp0": [0, "a2",],
                "wp1": [0, "b2",],
                "wp2": [0, "c2",],
                "wp3": [0, "d2",],
                "wp4": [0, "e2",],
                "wp5": [0, "f2",],
                "wp6": [0, "g2",],
                "wp7": [0, "h2",],
                "wR0": [0, "a1",],
                "wR1": [0, "h1",],
                "wN0": [0, "b1",],
                "wN1": [0, "g1",],
                "wB0": [0, "c1",],
                "wB1": [0, "f1",],
                "wQ": [0, "d1",],
                "wK": [0, "e1",],

                //Black pieces
                "bp0": [0, "a7",],
                "bp1": [0, "b7",],
                "bp2": [0, "c7",],
                "bp3": [0, "d7",],
                "bp4": [0, "e7",],
                "bp5": [0, "f7",],
                "bp6": [0, "g7",],
                "bp7": [0, "h7",],
                "bR0": [0, "a8",],
                "bR1": [0, "h8",],
                "bN0": [0, "b8",],
                "bN1": [0, "g8",],
                "bB0": [0, "c8"],
                "bB1": [0, "f8",],
                "bQ": [0, "d8",],
                "bK": [0, "e8",],

            },

            boardPosition: 0,
        }
    },

    methods: {
        movePiece(from, to, moveNumber) {

            //TODO: Need to move logic for castling to this function
            
            //TODO: Handle promotion of piece

            for (var piece in this.pieces) {

                //Remove or put back captured piece
                if (this.pieces[piece][1] == to && this.boardPosition < this.diagramPosition) {

                    if(!this.pieces[piece][0]) this.pieces[piece][0] = moveNumber;
                    continue;

                } else if (this.pieces[piece][1] == from && this.boardPosition >= this.diagramPosition && this.pieces[piece][0] == moveNumber && moveNumber != 0) {
                    this.pieces[piece][0] = 0;
                    continue;
                }

                //Move piece if on move coordinate and not captured
                if (this.pieces[piece][1] == from && !this.pieces[piece][0]) {
                    this.pieces[piece][1] = to;
                }
            }

        },

    },

    watch: {

        diagramPosition() {

            //Get history TODO: Dont work if move is undone, the last history[] cant be retrieved
            var history = this.$parent.$parent.chessGame.history({ "verbose": true });

            if (this.boardPosition < this.diagramPosition) {

                for (let i = this.boardPosition; i < this.diagramPosition; i++) {

                    if (history[i].san == "O-O" && history[i].color == "w") this.movePiece("h1", "f1", i);
                    else if (history[i].san == "O-O" && history[i].color == "b") this.movePiece("h8", "f8", i);
                    else if (history[i].san == "O-O-O" && history[i].color == "w") this.movePiece("a1", "d1", i);
                    else if (history[i].san == "O-O-O" && history[i].color == "b") this.movePiece("a8", "d8", i);

                    this.movePiece(history[i].from, history[i].to, i);

                    this.boardPosition++;
                }

            } else {

                for (let i = this.boardPosition - 1; i >= this.diagramPosition; i--) {

                    if (history[i].san == "O-O" && history[i].color == "w") this.movePiece("f1", "h1", i);
                    else if (history[i].san == "O-O" && history[i].color == "b") this.movePiece("f8", "h8", i);
                    else if (history[i].san == "O-O-O" && history[i].color == "w") this.movePiece("d1", "a1", i);
                    else if (history[i].san == "O-O-O" && history[i].color == "b") this.movePiece("d8", "a8", i);

                    this.movePiece(history[i].to, history[i].from, i);

                    this.boardPosition--;
                }

            }



        }

    },

}
</script>