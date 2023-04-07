<template>
    <section>
        <h1>Your saved designs</h1>
        <ul class="saved__posters">
            <li v-for="poster in $page.props.posters">
                <Poster :poster="poster" environment="/images/environments/builder-mockup.jpeg"
                    :controls="{ 'small': true, 'save': false }"></Poster>
                <div class="content">
                    <div class="button-wrp">
                        <button class="button is--black"> Add to cart
                            <Icon name="cart" />
                        </button>

                        <a class="button" :href="route('poster.edit', { 'id': poster.id })">
                            Edit
                            <Icon name="edit" />
                        </a>

                        <form @submit.prevent="submitForm(poster.id)">
                            <button class="button is--only-icon" type="submit">
                                <Icon name="delete" />
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </section>
</template>

<script setup>

import { useForm } from '@inertiajs/vue3';

let form = useForm({
    deleteSavedPosterId: 0,
});

function submitForm(id) {
    form.deleteSavedPosterId = id;
    form.post('/remove-poster', { preserveScroll: true });
}


</script>

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
