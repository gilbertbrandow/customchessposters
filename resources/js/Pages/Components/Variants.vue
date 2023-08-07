<template>
    <div v-if="Object.keys($page.props.addToCart).length" class="content variants-overlay">
        <button class="button is--only-icon is--outline" @click="$page.props.addToCart = [], $page.props.overlay = false">
            <Icon name="close" />
        </button>

        <div class="container">
            <h2>Poster "{{ $page.props.addToCart.title }}"</h2>


            <h3 class="is--margin-top">Choose a size</h3>
            <UnitSwitcher />
            <ul class="sizes is--margin-top is--margin-btm">
                <li v-for="size in this.sizes" :class="this.properties.size == size.id ? 'is--active' : ''">
                    <button @click="this.properties.size = size.id">
                        <span>{{ this.$page.props.unit ? size.width + ' cm x ' + size.height + ' cm' : Math.round(size.width * 0.393700787) + '" x ' + Math.round(size.height * 0.393700787) + '"'}}</span>
                        <span>{{ size.cost }}</span>
                    </button>
                </li>
            </ul>

            <div class="is--flex" style="margin-top: 1.5em; column-gap: 0.25em;">
                <h3>Choose a frame</h3><span>(Optional)</span>
            </div>
            <ul class="frames">
                <li v-for="frame in this.frames" :class="this.properties.frame == frame.id ? 'is--active' : ''">
                    <button @click="this.properties.frame = frame.id">
                        <div class="frame__img">
                            <img :src="frame.image" alt="">
                        </div>
                        <span>{{ frame.name }}</span>
                        <span>{{ frame.cost }}</span>
                    </button>
                </li>

                <button v-if="this.$data.properties.frame" class="link-arrow"
                    @click="this.$data.properties.frame = null">No frame {{ this.removeFrameCost }}</button>
            </ul>

            <div class="is--flex">
                <button class="button is--black is--margin-top is--margin-bottom" @click="this.submit()"
                    :disabled="!this.form.variant">
                    {{ !this.form.variant ? 'Choose a size' : 'Add to cart' }}
                    <Icon :name="!this.form.variant ? '' : 'cart'" />
                </button>

                <span style="font-size: 2em;">€{{ (this.total / 100).toFixed(2) }}</span>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3'
import axios from 'axios'
import UnitSwitcher from './UnitSwitcher.vue'

export default {
    components: {
        UnitSwitcher,
    },


    data() {
        return {
            sizes: null,
            frames: null,
            variants: null,
            properties: {
                size: null,
                frame: null,
            },
            total: 0,
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
                    this.$data.variants = response.data['variants']
                ))
                .catch((error) => (
                    console.log(error)
                )).finally(() => {
                    this.$data.properties.size = 1
                })
        },
    },

    watch: {
        properties: {
            handler() {

                //Whenever any property is changed loop through all varaints and find match
                this.$data.variants.forEach((variant) => {
                    if (variant.poster_size_id == this.$data.properties.size
                        && variant.poster_frame_id == this.$data.properties.frame) {

                        //Update current variant and change total to its price
                        this.$data.form.variant = variant.id;
                        this.$data.total = variant.price;

                        //Update cost of all sizes and frames
                        this.$data.sizes.forEach((size) => {

                            //If current
                            if (size.id == variant.poster_size_id) size.cost = 'Selected';
                            else {

                                //Get cost of variant where match, subtract current price and update cost
                                this.$data.variants.forEach((variant) => {
                                    if (variant.poster_size_id == size.id
                                        && variant.poster_frame_id == this.$data.properties.frame) {
                                        size.cost = variant.price < this.$data.total
                                            ? '- €' + ((variant.price - this.$data.total) / -100).toFixed(2)
                                            : '+ €' + ((variant.price - this.$data.total) / 100).toFixed(2)

                                        return;
                                    }
                                });
                            }
                        })

                        this.$data.frames.forEach((frame) => {

                            //If current
                            if (frame.id == variant.poster_frame_id) frame.cost = 'Selected';
                            else {
                                //Get cost of variant where match, subtract current price and update cost
                                this.$data.variants.forEach((variant) => {
                                    if (variant.poster_frame_id == frame.id
                                        && variant.poster_size_id == this.$data.properties.size) {
                                        frame.cost = variant.price < this.$data.total
                                            ? '- €' + ((variant.price - this.$data.total) / -100).toFixed(2)
                                            : '+ €' + ((variant.price - this.$data.total) / 100).toFixed(2)

                                        return;
                                    }
                                });
                            }
                        })

                        return;
                    }
                })
            },

            deep: true
        }
    },

    computed: {
        removeFrameCost() {
            let cost = null;

            this.$data.variants.forEach((variant) => {
                if (variant.poster_frame_id == null
                    && variant.poster_size_id == this.$data.properties.size) {
                    cost = '(- €' + ((variant.price - this.$data.total) / -100).toFixed(2) + ')';
                }
            });

            return cost;
        },
    },

    mounted() {
        this.fetchVariants();
    }
}
</script>