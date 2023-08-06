<template>
    <div v-if="Object.keys($page.props.addToCart).length" class="content variants-overlay">
        <button class="button is--only-icon is--outline" @click="$page.props.addToCart = [], $page.props.overlay = false">
            <Icon name="close" />
        </button>

        <div class="container">
            <h2>Poster "{{ $page.props.addToCart.title }}"</h2>


            <h3 class="is--margin-top">Choose a size</h3>
            <div class="switcher-wrp is--margin-top">
                <span :class="this.$data.unit ? 'is--active' : ''">Centimeters (cm)</span>
                <button :class="this.$data.unit ? 'switcher' : 'switcher is--right'"
                    @click="this.$data.unit = !this.$data.unit">
                    <div></div>
                </button>
                <span :class="!this.$data.unit ? 'is--active' : ''">Inches (")</span>
            </div>
            <ul class="sizes is--margin-top">
                <li v-for="size in this.sizes" :class="this.form.variant == size.id ? 'is--active' : ''">
                    <button @click="this.form.variant = size.id">
                        <span>{{ size.name }} ({{ size.width + ' cm x ' + size.height + ' cm' }})</span>
                        <span>+ €20.00</span>
                    </button>
                </li>
            </ul>

            <h3>Choose a frame</h3>
            <ul class="frames">
                <li v-for="frame in this.frames" :class="this.form.frame == frame.id ? 'is--active' : ''">
                    <button @click="this.form.frame = frame.id">
                        <span>{{ frame.name }}</span>
                        <span>+ €20.00</span>
                    </button>
                </li>
            </ul>

            <div class="is--flex">
                <button class="button is--black is--margin-top is--margin-bottom" @click="this.submit()"
                    :disabled="!this.form.variant">
                    {{ !this.form.variant ? 'Choose a size' : 'Add to cart' }}
                    <Icon :name="!this.form.variant ? '' : 'cart'" />
                </button>

                <span>Total: €00.00</span>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3'
import axios from 'axios'

export default {
    components: {
    },


    data() {
        return {
            sizes: null,
            frames: null,
            unit: true,
            form: useForm({
                poster_data: this.$page.props.addToCart,
                variant: null,
            })
        }
    },

    methods: {

        submit() {
            this.form.post('/product', {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    this.$page.props.overlay = false;
                    this.$page.props.addToCart = [];
                }
            });
        },

        fetchVariants() {
            axios
                .get('/poster-variants')
                .then(response => (
                    this.$data.sizes = response.data['sizes'],
                    this.$data.frames = response.data['frames'],
                    console.log(response.data['sizes'])

                ))
                .catch((error) => (
                    console.log(error)
                ))
        },
    },

    mounted() {
        this.fetchVariants();
    }
}
</script>