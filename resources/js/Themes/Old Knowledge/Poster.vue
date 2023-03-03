<template>
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 3000">

        <!-- The Title -->
        <text font-size="150" font-family="AdobeClean-Regular, Adobe Clean" text-anchor="middle">
            <tspan x="1000" y="300">{{ title[0] }}</tspan>
            <tspan v-if="title[1]" x="1000" y="500">{{ title[1] }}</tspan>
        </text>

         <!-- Players name, title and ranking -->
         <text font-size="70" font-family="AdobeClean-Regular, Adobe Clean" text-anchor="middle" x="1000" :y="title[1] ? 700 : 500" >
            <tspan font-weight="600" v-if="poster.gameMeta.white.title"> {{ poster.gameMeta.white.title + ' ' }} </tspan>
            <tspan v-if="poster.gameMeta.white.name"> {{ poster.gameMeta.white.name + ' ' }} </tspan>
            <!-- <tspan font-size="40" v-if="poster.gameMeta.white.rating">({{ poster.gameMeta.white.rating + ' FIDE' }}) </tspan> -->
            <tspan font-size="40"> - </tspan>
            <tspan font-weight="600" v-if="poster.gameMeta.black.title"> {{ poster.gameMeta.black.title + ' ' }} </tspan>
            <tspan v-if="poster.gameMeta.black.name"> {{ poster.gameMeta.black.name + ' ' }} </tspan>
        <!--<tspan font-size="40" v-if="poster.gameMeta.black.rating">({{ poster.gameMeta.black.rating + ' FIDE' }}) </tspan> -->
        </text>

        <!-- Where and when -->
        <text font-size="40" font-family="AdobeClean-Regular, Adobe Clean"  text-anchor="middle" x="1000" :y="title[1] ? 800 : 600">
            <tspan>{{ poster.gameMeta.where }}</tspan>
            <tspan>{{ poster.gameMeta.when }}</tspan>
        </text>

       <!--  <text font-size="60" font-family="AdobeClean-Regular, Adobe Clean" x="200" :y="title[1] ? 900 : 700">
            <tspan font-weight="600" v-if="poster.gameMeta.black.title"> {{ poster.gameMeta.black.title + ' ' }} </tspan>
            <tspan v-if="poster.gameMeta.black.name"> {{ poster.gameMeta.black.name + ' ' }} </tspan>
            <tspan font-size="40" v-if="poster.gameMeta.black.rating">({{ poster.gameMeta.black.rating + ' FIDE' }}) </tspan>
        </text> -->



        <!-- The board (!!!!!)-->
        <Board :y="2900 - (40 * (pgnRows.length)) - 50 - 1590.381"/>


        <!-- The PGN -->

        <text font-size="20" font-family="AdobeClean-Regular, Adobe Clean">
            <tspan v-for="(row, index) in pgnRows" x="200" :y="2900 - (40 * (pgnRows.length - 1 - index))">{{ row }}
            </tspan>
        </text>

    </svg>

</template>

<script>

import Board from './Board.vue';

export default {

    components: {
        Board,
    }, 

    props: {
        poster: {},
    },

    computed: {
        title() {

            const string = this.$props.poster.gameMeta.title;
            var title = [];
            this.$parent.$data.posterBuilder.titleValid = true;

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
                        } else {
                            this.$parent.$data.posterBuilder.titleValid = false;
                        }

                    } else {

                        rowCount = rowCount + words[i].length + 1;

                        if (rowCount < 26) {
                            title[1] += ' ' + words[i];
                        } else {
                            this.$parent.$data.posterBuilder.titleValid = false;
                        }
                    }
                }

            }
            return title;
        },

        pgnRows() {

            var gamePgn = this.$props.poster.gamePgn;
            var rows = [];
            let rowsIndex = 0;

            //Figure out max chars per row, max rows and do while loop and push to rows array when possible

            //Nested while loop to take the whole next move (Up until space followed by number)
            for (let i = 0; i < gamePgn.length; i++) {

                if ((gamePgn[i] == ' ' && this.containsNumbers(gamePgn[i + 1])) || !gamePgn[i + 1]) {
                    //Create substring of the next full move, remove it from gamePgn
                    var move = gamePgn.substring(0, i + 1);
                    gamePgn = gamePgn.substring(i + 1);
                    i = 0;

                    //Check if fits in curent row[]
                    if (rows[rowsIndex]) {
                        if (rows[rowsIndex].length + move.length < 200) {
                            rows[rowsIndex] += ' ' + move;

                        } else if (rowsIndex < 10) {
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
        }
    },
    methods: {

        containsNumbers(str) {
            return /[0-9]/.test(str);
        },
    }
}

</script>