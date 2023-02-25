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

    </svg>

</template>

<script>

export default {

    props: {
        poster: {},
    },

    computed: {
        title() {

            //Need to build this smarter so that it does not split words randomly, also maybe adjust text size dynamically to fit more chars?
            const string = this.$props.poster.gameMeta.title;
            var title = [];
            this.$parent.$data.posterBuilder.titleValid = true;

            let words = string.split(' ');
            let rowCount = 0; 

            for(let i = 0; i < words.length; i++)
            {

                if(rowCount + words[i].length < 26 && !title[1]){
                    rowCount = rowCount + words[i].length + 1; 

                    if(i == 0){ 
                        title[0] = words[i];
                    } else {
                        title[0] += ' ' + words[i];
                    }
                } else {

                    if(!title[1]) {

                        rowCount = words[i].length;

                        if(rowCount < 26) {
                            title[1] = words[i];
                        } else {
                            this.$parent.$data.posterBuilder.titleValid = false;
                        }

                    } else {

                        rowCount = rowCount + words[i].length + 1; 

                        if(rowCount < 26) {
                            title[1] += ' ' + words[i];
                        } else {
                            this.$parent.$data.posterBuilder.titleValid = false;
                        }
                    }
                }

            }

            return title;
        },
    }
}

</script>