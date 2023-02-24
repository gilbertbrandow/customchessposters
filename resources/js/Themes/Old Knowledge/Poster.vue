<template>
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 3000">

        <text x=200 y="300" font-size="150" font-family="AdobeClean-Regular, Adobe Clean">
            <tspan x="150" y="300">{{ title[0] }}</tspan>
            <tspan x="150" y="500">{{ title[1] }}</tspan>
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

            const string = this.$props.poster.gameMeta.title
            const title = [string.substring(0, 25), string.substring(25, 50)];

            return title;
        },
    }
}

</script>