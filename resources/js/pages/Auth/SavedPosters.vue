<template>

    <section>
        <div class="container">
            <h1>{{ $page.props.auth.user.name }}'s saved designs</h1>
            <ul>
                <li v-for="poster in $page.props.posters" class="poster__card">
                    <div class="poster">
                    <div class="poster__buttons-wrp">
                        <div class="button">Full screen
                            <Icon name="fullScreen" />
                        </div>
                    </div>
                    <div class="poster__svg-wrp">
                        <Poster ref="PosterSVG" :poster="poster" />
                    </div>
                    <img class="poster__environment" src="/images/environments/builder-mockup.jpeg" />
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
