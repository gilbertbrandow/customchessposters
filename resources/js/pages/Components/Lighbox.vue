<template>

    <div class="lightbox">
        <div content>

            <div class="poster">
                <div class="poster__svg-wrp">
                    <Poster ref="PosterSVG" :poster="poster" />
                </div>
                <img class="poster__environment" :src="this.$data.posterBuilder.currEnvironment" />
            </div>

            <div>
            </div>

        </div>
    </div>

</template>

<script>
import Poster from '../Components/Poster/Poster.vue';

export default {
    props: {
        poster: {},
    },

    components: {
        Poster,
    },

    data() {
        return {

            //Create array to hold each environment and display by for loop in mask
            images: [],
        }
    }
}
</script>