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

        <text font-size="20" font-family="AdobeClean-Regular, Adobe Clean">
            <tspan v-for="(row, index) in pgnRows" x="200" :y="2700 - (40 * (pgnRows.length - 1 - index))">{{ row }}
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
                    if(rows[rowsIndex]){
                        if(rows[rowsIndex].length + move.length < 200)
                        {
                            rows[rowsIndex] += ' ' + move;

                        } else if(rowsIndex < 10){
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