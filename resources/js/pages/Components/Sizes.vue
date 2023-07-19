<template>
    <div v-if="Object.keys(this.$page.props.addToCart).length" class="content sizes-overlay">
        <div class="container">
            <h2>Choose a size for "{{ this.$page.props.addToCart.title }}"</h2>

            <div class="switcher-wrp is--margin-top">
                <span :class="this.$data.unit ? 'is--active' : ''">Centimeters (cm)</span>
                <button :class="this.$data.unit ? 'switcher' : 'switcher is--right'"
                    @click="this.$data.unit = !this.$data.unit">
                    <div></div>
                </button>
                <span :class="!this.$data.unit ? 'is--active' : ''">Inches (")</span>
            </div>


            <ul class="sizes is--margin-top">
                <li :class="this.form.variant == 1 ? 'is--active' : ''">
                    <button @click="this.form.variant = 1">
                        <span>Small &nbsp; &nbsp; &nbsp; €20.00</span>
                        <span>{{ this.$data.unit ? '21 x 30 cm' : '8" x 12"' }}
                        </span>
                    </button>
                </li>
                <li :class="this.form.variant == 2 ? 'is--active' : ''">
                    <button @click="this.form.variant = 2">
                        <span>Medium &nbsp; &nbsp; &nbsp; €30.00</span>
                        <span>{{ this.$data.unit ? '50 x 70 cm' : '20" x 27"' }}</span>
                    </button>
                </li>
                <li :class="this.form.variant == 3 ? 'is--active' : ''">
                    <button @click="this.form.variant = 3">
                        <span>Large &nbsp; &nbsp; &nbsp; €40.00</span>
                        <span>{{ this.$data.unit ? '61 x 91 cm' : '24" x 36"' }}</span>
                    </button>
                </li>
            </ul>

            <button class="button is--black is--margin-top" @click="this.submit()" :disabled="!this.form.variant">
                {{ !this.form.variant ? 'Choose a size' : 'Add to cart' }}
                <Icon :name="!this.form.variant ? '' : 'cart'" />
            </button>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3'

export default {
    components: {
    },


    data() {
        return {
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
        }
    }
}
</script>