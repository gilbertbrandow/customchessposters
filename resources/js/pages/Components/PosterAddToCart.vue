<template>
    <div class="button-wrp">
        <button class="button is--black" @click="showSizes()">
            {{ this.sizes ? 'Choose a size' : 'Add to cart' }}
            <Icon :name="this.sizes ? 'arrow-right' : 'cart'" />
        </button>

        <form @submit.prevent>
            <ul v-if="this.sizes" class="sizes">
                <li><button type="submit" @click="this.form.size = 1">21 x 30cm</button></li>
                <li><button type="submit" @click="this.form.size = 2">50 x 70</button></li>
                <li><button type="submit" @click="this.form.size = 3">61 x 91cm</button></li>
                <li><button type="submit" @click="this.form.size = 4">70 x 100cm</button></li>
            </ul>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3'

export default {
    props: {
        poster: {},
    },

    data() {
        return {
            sizes: false,
            form: useForm({
                poster_data: this.poster,
                size: null,
            })
        }
    },

    methods: {
        showSizes() {
            this.sizes = true;
        },
    },

    watch: {
        'form.size'() {
            this.form.post('/product', {
                preserveState: true, 
                preserveScroll: true, 
                onSuccess: () => this.sizes = false,
            });
        }
    }
}
</script>