<template>
    <span class="is--larger">Choose a size</span>
    <UnitSwitcher />
    <ul class="sizes is--margin-top is--margin-btm">
        <li
            v-for="size in this.sizes"
            :class="this.properties.size == size.id ? 'is--active' : ''"
        >
            <button @click="this.properties.size = size.id">
                <span>{{
                    $page.props.unit
                        ? size.width + " x " + size.height + " cm"
                        : Math.round(size.width * 0.393700787) +
                          '" x ' +
                          Math.round(size.height * 0.393700787) +
                          '"'
                }}</span>
                <span>{{ size.cost }}</span>
            </button>
        </li>
    </ul>

    <div class="is--flex" style="margin-top: 1.5em; column-gap: 0.25em">
        <span class="is--larger">Choose a frame</span><span>(Optional)</span>
    </div>
    <ul class="frames">
        <li
            v-for="frame in this.frames"
            :class="this.properties.frame == frame.id ? 'is--active' : ''"
        >
            <button @click="this.properties.frame = frame.id">
                <div class="frame__img">
                    <img :src="frame.image" />
                </div>
                <span>{{ frame.name }}</span>
                <span>{{ frame.cost }}</span>
            </button>
        </li>

        <button
            v-if="this.$data.properties.frame"
            class="link-arrow is--margin-left"
            @click="this.$data.properties.frame = null"
        >
            No frame {{ this.removeFrameCost }}
        </button>
    </ul>
</template>

<script>
import UnitSwitcher from "./UnitSwitcher.vue";
import axios from "axios";

export default {
    components: {
        UnitSwitcher,
    },

    emits: {
        variant: null,
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
            variant: null,
        };
    },

    methods: {
        fetchVariants() {
            axios
                .get("/api/poster-variants")
                .then(
                    (response) => (
                        (this.$data.sizes = response.data["sizes"]),
                        (this.$data.frames = response.data["frames"]),
                        (this.$data.variants = response.data["variants"])
                    )
                )
                .catch((error) => console.error(error))
                .finally(() => {
                    this.$data.properties.size = 1;
                });
        },
    },

    watch: {
        properties: {
            handler() {
                //Whenever any property is changed loop through all varaints and find match
                this.$data.variants.forEach((variant) => {
                    if (
                        variant.size == this.$data.properties.size &&
                        variant.frame == this.$data.properties.frame
                    ) {
                        //Update current variant and change total to its price
                        this.$emit("variant", {
                            variant: variant.id,
                            total: variant.price,
                            frame: variant.frame,
                        });

                        this.$data.total = variant.price;

                        //Update cost of all sizes and frames
                        this.$data.sizes.forEach((size) => {
                            //If current
                            if (size.id == variant.size)
                                size.cost = "Selected";
                            else {
                                //Get cost of variant where match, subtract current price and update cost
                                this.$data.variants.forEach((variant) => {
                                    if (
                                        variant.size == size.id &&
                                        variant.frame ==
                                            this.$data.properties.frame
                                    ) {
                                        size.cost =
                                            variant.price < this.$data.total
                                                ? "- €" +
                                                  (
                                                      (variant.price -
                                                          this.$data.total) /
                                                      -100
                                                  ).toFixed(2)
                                                : "+ €" +
                                                  (
                                                      (variant.price -
                                                          this.$data.total) /
                                                      100
                                                  ).toFixed(2);

                                        return;
                                    }
                                });
                            }
                        });

                        this.$data.frames.forEach((frame) => {
                            //If current
                            if (frame.id == variant.frame)
                                frame.cost = "Selected";
                            else {
                                //Get cost of variant where match, subtract current price and update cost
                                this.$data.variants.forEach((variant) => {
                                    if (
                                        variant.frame == frame.id &&
                                        variant.size ==
                                            this.$data.properties.size
                                    ) {
                                        frame.cost =
                                            variant.price < this.$data.total
                                                ? "- €" +
                                                  (
                                                      (variant.price -
                                                          this.$data.total) /
                                                      -100
                                                  ).toFixed(2)
                                                : "+ €" +
                                                  (
                                                      (variant.price -
                                                          this.$data.total) /
                                                      100
                                                  ).toFixed(2);

                                        return;
                                    }
                                });
                            }
                        });

                        return;
                    }
                });
            },

            deep: true,
        },
    },

    computed: {
        removeFrameCost() {
            let cost = null;

            this.$data.variants.forEach((variant) => {
                if (
                    variant.frame == null &&
                    variant.size == this.$data.properties.size
                ) {
                    cost =
                        "(- €" +
                        ((variant.price - this.$data.total) / -100).toFixed(2) +
                        ")";
                }
            });

            return cost;
        },
    },

    mounted() {
        this.fetchVariants();
    },
};
</script>
