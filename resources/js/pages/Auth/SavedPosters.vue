<template>
    <section>
        <h1>Your saved designs</h1>
        <ul class="saved__posters">
            <li v-for="poster in $page.props.posters">
                <Poster :poster="poster" environment="/images/environments/builder-mockup.jpeg" :controls="{'small': true, 'save': false }"></Poster>
                <div class="content">
                    <h3 v-text="poster.pivot.name"></h3>
                    <div class="button-wrp">
                        <button class="button is--black"> Add to cart
                            <Icon name="cart" />
                        </button>

                        <button class="button">
                            Edit
                            <Icon name="edit" />
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </section>
</template>

<script>
import App from "../../Layouts/App.vue";
import AccountNav from "../../Layouts/AccountNav.vue";
import Poster from "../Components/Poster.vue"

export default {
    layout: (h, page) => {
        return h(App, () => h(AccountNav, () => page))
    },

    components: {
        Poster,
    },
}
</script>
