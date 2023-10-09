<template>
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 3000"
        :style="{ 'background-color': (this.poster.theme_id == 1) ? '#FBF6EE' : '#f8f5f1', 'fill': (this.poster.theme_id == 1) ? '#41251D' : '#000000', 'font-family': (this.poster.theme_id == 1) ? 'Custom Serif By Ayaka Ito Regular' : 'EB Garamond', }">

        <!-- The Title -->
        <text id="title" font-size="150" text-anchor="middle" font-weight="400">
            <tspan x="1000" y="300">{{ title[0] }}</tspan>
            <tspan v-if="title[1]" x="1000" y="500">{{ title[1] }}</tspan>
        </text>

        <!-- Players name, title and ranking -->
        <text id="players" font-size="70" text-anchor="middle" x="1000" font-weight="400" :y="title[1] ? 700 : 500">
            <tspan v-if="poster.white_title"> 
                {{ poster.white_title + ' ' }}
            </tspan>
            <tspan v-if="poster.white_player"> 
                {{ poster.white_player + ' ' }} 
            </tspan>
            <tspan v-if="poster.white_rating">
                ({{ poster.white_rating }})
            </tspan>
            <tspan> 
                - 
            </tspan>
            <tspan v-if="poster.black_title"> 
                {{ poster.black_title + ' ' }}
            </tspan>
            <tspan v-if="poster.black_player"> 
                {{ poster.black_player + ' ' }} 
            </tspan>
            <tspan v-if="poster.black_rating">
                ({{ poster.black_rating }}) 
            </tspan>
        </text>

        <!-- Where and when -->
        <text id="meta" font-size="40" text-anchor="middle" x="1000" :y="title[1] ? 800 : 600"
            :style="{ 'font-family': (this.poster.theme_id == 1) ? 'Custom Serif By Ayaka Ito Italic' : 'EB Garamond italic' }">
            <tspan>{{ poster.where }}</tspan>
            <tspan v-if="poster.where && poster.when"> | </tspan>
            <tspan>{{ poster.when }}</tspan>
        </text>


        <!-- The chess -->
        <svg width="1645" height="1690" viewBox="0 0 1645 1671" x="185" style="overflow: visible;"
            :y="((Math.min(2900 - (40 * (pgnRows.length)), 2860) - (title[1] ? 800 : 600)) / 2) + (title[1] ? 800 : 600) - 800">

            <text id="rows" font-size="40">
                <tspan v-for="index in 8" x="1625" :y="70 + (200 * index) - 200">{{
                    poster.orientation ? 9 - index :
                    index
                }}</tspan>
            </text>

            <text id="columns" font-size="40">
                <tspan v-for="index in 8" :x="20 + (200 * index) - 200" y="0">{{
                    poster.orientation ?
                    String.fromCharCode(96 + index) : String.fromCharCode(96 + 9 - index)
                }}</tspan>
            </text>

            <!-- Frame of the board -->
            <Frame :theme="this.poster.theme_id" />

            <!-- The board itself with pieces -->
            <Game ref="Game" :theme_id="this.$props.poster.theme_id" :fen="this.$props.poster.fen" />

            <!-- Diagram comment -->
            <text id="comment" y="1690" x="815" text-anchor="middle" font-size="32"
                :style="{ 'font-family': (this.poster.theme_id == 1) ? 'Custom Serif By Ayaka Ito Italic' : 'EB Garamond italic' }"
                v-text="this.$props.poster.move_comment ? this.diagramInfo + ', ' + this.$props.poster.move_comment: this.diagramInfo"></text>

        </svg>


        <!-- The PGN -->
        <text font-size="18" text-anchor="middle">
            <tspan v-for="(row, index) in pgnRows" x="1000" :y="2900 - (40 * (pgnRows.length - 1 - index))">
                {{ row }}
                <tspan v-if="index == pgnRows.length - 1 && this.poster.result" font-weight="800"> | {{
                    this.poster.result
                }}</tspan>
            </tspan>
            <tspan v-if="!pgnRows.length" x="1000" y="2900">
                No move has been made.
            </tspan>
        </text>

    </svg>
</template>

<style>
@font-face {
    font-family: 'EB Garamond';
    src: url("../../../../fonts/EBGaramond-Regular.ttf") format("truetype-variations");
}

@font-face {
    font-family: 'EB Garamond italic';
    src: url("../../../../fonts/EBGaramond-Italic.ttf") format("truetype-variations");
}

@font-face {
    font-family: 'Custom Serif By Ayaka Ito Italic';
    src: url("../../../../fonts/Custom-Serif-By-Ayaka-Ito-Italic.ttf") format("truetype-variations");
    font-weight: 1 999;
}

@font-face {
    font-family: 'Custom Serif By Ayaka Ito Regular';
    src: url("../../../../fonts/Custom-Serif-By-Ayaka-Ito-Regular.ttf") format("truetype-variations");
    font-weight: 1 999;
}
</style>

<script>

import Game from './Game.vue';
import Frame from '../../../Themes/Frame.vue';

export default {

    components: {
        Game,
        Frame,
    },

    props: {
        poster: {},
    },

    computed: {
        title() {

            const string = this.$props.poster.title;
            var title = [];

            let words = string.split(' ');
            let rowCount = 0;

            for (let i = 0; i < words.length; i++) {

                if (rowCount + words[i].length < 26 && !title[1]) {
                    rowCount = rowCount + words[i].length + 1;

                    if (i == 0) {
                        title[0] = words[i];
                    } else {
                        title[0] += ' ' + words[i];
                    }
                } else {

                    if (!title[1]) {

                        rowCount = words[i].length;

                        if (rowCount < 26) {
                            title[1] = words[i];
                        }

                    } else {

                        rowCount = rowCount + words[i].length + 1;

                        if (rowCount < 26) {
                            title[1] += ' ' + words[i];
                        }
                    }
                }

            }
            return title;
        },

        pgnRows() {

            var pgn = this.$props.poster.pgn ?? '';
            var rows = [];
            let rowsIndex = 0;

            //Nested while loop to take the whole next move (Up until space followed by number)
            for (let i = 0; i < pgn.length; i++) {

                if ((pgn[i] == ' ' && this.containsNumbers(pgn[i + 1])) || !pgn[i + 1]) {

                    //Create substring of the next full move, remove it from pgn
                    var move = pgn.substring(0, i + 1);
                    pgn = pgn.substring(i + 1);
                    i = 0;

                    //Check if fits in curent row[]
                    if (rows[rowsIndex]) {
                        if (rows[rowsIndex].length + move.length < 210) {
                            rows[rowsIndex] += ' ' + move;

                        } else if (rowsIndex < 5) {
                            rowsIndex++;
                            rows[rowsIndex] = move;
                        } else {
                            rows[rowsIndex] += "...";
                            return rows;
                        }
                    } else {
                        rows[rowsIndex] = move;
                    }
                }
            }

            return rows;
        },

        diagramInfo() {
            if (!this.poster.diagram_position) return 'Starting position';

            let pgn = this.poster.pgn;

            //Loop through the array until finding correct move number and set starting index of that move
            let indexOfMove = pgn.indexOf((Math.round(this.poster.diagram_position / 2)) + '.') + Math.round(this.poster.diagram_position / 2).toString().length + 2;

            //Get index of next space
            let spaceIndex = pgn.indexOf(' ', indexOfMove);

            if (spaceIndex == -1) { spaceIndex = pgn.length }

            //Depending on if half move or not, look until next ' ', or from next ' ' to the one after that
            if (this.poster.diagram_position % 2 != 0) {
                //White move
                return "Position after White's move " + Math.round(this.poster.diagram_position / 2) + '. ' + pgn.substring(indexOfMove, spaceIndex);
            } else {
                //Black move
                let nextSpaceIndex = (pgn.indexOf(' ', spaceIndex + 1) > 0) ? pgn.indexOf(' ', spaceIndex + 1) : pgn.length;
                return "Position after Black's move " + Math.round(this.poster.diagram_position / 2) + '. ... ' + pgn.substring(spaceIndex + 1, nextSpaceIndex);
            }
        }
    },
    methods: {
        containsNumbers(str) {
            return /[0-9]/.test(str);
        },
    },

}

</script>