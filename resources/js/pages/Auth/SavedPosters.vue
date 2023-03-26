<template>

    <section>
        <div class="container">
            <h1>{{ $page.props.auth.user.name }}'s saved designs</h1>
            <ul class="saved__posters">
                <li v-for="poster in $page.props.posters">
                    <Poster :poster="poster" environment="/images/environments/builder-mockup.jpeg"></Poster>
                    <div class="content">
                        <h3 v-text="poster.pivot.name"></h3>
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
import Poster from "../Components/Poster.vue"

export default {
    layout: AppLayout,

    components: {
        Poster,
    },
}
</script>
