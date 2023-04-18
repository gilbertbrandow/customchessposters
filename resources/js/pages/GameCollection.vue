<template>
    <section>
        <div class="container">
            <h1>Game Collection</h1>
            <p>Here is our collection of amazing games.</p>
            <ul class="game__collection">
                <li v-for="game in this.$page.props.games">
                    <div class="content">
                        <h2 v-text="game.name"></h2>
                        <p v-text="game.description"></p>
                        <div class="button-wrp">
                            <button class="button is--black"> Add to cart
                                <Icon name="cart" />
                            </button>

                            <a class="button" :href="route('poster.edit', { 'id': game.poster.id })">
                                Edit
                                <Icon name="edit" />
                            </a>
                        </div>
                    </div>
                    <Poster :poster="game.poster" environment="/images/environments/builder-mockup.jpeg"
                        :controls="{ 'small': true, 'save': true }"></Poster>
                </li>
            </ul>
        </div>
    </section>
</template>

<script>
import AppLayout from "../Layouts/App.vue";
import Poster from "./Components/Poster.vue"

export default {

    layout: AppLayout,

    components: {
        Poster,
    },

    data() {
        return {

        }
    },
}
</script>