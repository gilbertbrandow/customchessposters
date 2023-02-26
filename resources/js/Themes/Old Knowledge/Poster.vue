<template>
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 3000">

        <!-- The Title -->
        <text font-size="150" font-family="AdobeClean-Regular, Adobe Clean">
            <tspan x="200" y="300">{{ title[0] }}</tspan>
            <tspan v-if="title[1]" x="200" y="500">{{ title[1] }}</tspan>
        </text>

        <!-- Players name, title and ranking -->

        <!-- The board (!!!!!)-->

        <!-- The PGN -->

        <text font-size="48" font-family="AdobeClean-Regular, Adobe Clean">
            <tspan v-for="(row, index) in pgnRows" x="200" :y="2700 - (75 * (pgnRows.length - 1 - index))">{{ row }}
            </tspan>
        </text>

    </svg>

</template>

<script>

export default {

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
            rows[0] = "test"
            let rowsIndex = 0;

            //Figure out max chars per row, max rows and do while loop and push to rows array when possible

            //Nested while loop to take the whole next move (Up until space followed by number)
            for (let i = 0; i < gamePgn.length; i++) {

                if ((gamePgn[i] == ' ' && this.containsNumbers(gamePgn[i + 1])) || !gamePgn[i + 1]) {
                    //Create substring of the next full move, remove it from gamePgn
                    var move = gamePgn.substring(0, i);
                    gamePgn = gamePgn.substring(i + 1);
                    i = 0;
                    console.log(move);
                }
            }

            //Check if fits in curent row[]

            //Else if next row < 10 begin new row

            //Else break and set pgn to invalid?

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