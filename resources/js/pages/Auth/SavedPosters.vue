<template>

    <section>
        <div class="container">
            <h1>{{ $page.props.auth.user.name }}'s saved designs</h1>
            <ul class="saved__posters">
                <li v-for="poster in $page.props.posters">
                    <div class="poster">
                        <div class="poster__svg-wrp">
                            <Poster ref="PosterSVG" :poster="poster" />
                        </div>
                        <img class="poster__environment" src="/images/environments/builder-mockup.jpeg" />
                    </div>
                    <div class="content">
                        <h3>Magnus wins with the Benkö Gambit</h3>
                        <div class="button-wrp">
                            <button class="button" type="submit"> Add to cart
                                <Icon name="cart" />
                            </button>

                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>

</template>

<script>
import AppLayout from "../../Layouts/App.vue";
import Poster from "../Components/Poster/Poster.vue"

export default {
    layout: AppLayout,

    components: {
        Poster,
    },
}
</script>
