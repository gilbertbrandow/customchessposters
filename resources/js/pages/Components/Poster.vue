<template>
    <section>
        <div class="container">
            <div class="poster__builder">

                <div class="poster__module">
                    <div class="module__header">
                        <h2>Create Your Poster</h2>
                        <Link class="link-arrow is--low-op" :href="route('home.index')">How does it work? <img
                            class="link-arrow__icn" src="../../../../public/images/icons/arrow-up.svg" alt=""></Link>
                    </div>
                    <div class="module__mask" ref="mask">
                        <div :class="[currStep == 0 ? 'is--active' : '']" class="module__step">
                            <h3>1. Your Design</h3>
                            <p>Choose a theme for your poster from the list below:</p>
                            <ul class="themes" ref="themes">

                                <li v-for="theme in themes" :key="theme.id" @click="setTheme(theme.id)" :class="[currTheme == theme.id ? 'is--active' : '']" class="theme">
                                    <div class="theme__colour-wrp">
                                        <div class="theme__colour">
                                            <div><img style="height: 100%"
                                                    :src="`/images/posters/themes${theme.texture}`" alt=""></div>
                                            <div :style="{ backgroundColor: theme.colour, }"></div>
                                        </div>
                                    </div>
                                    <div class="theme__text">
                                        <h4 v-text="theme.title"></h4>
                                        <p v-text="theme.desc"></p>
                                    </div>
                                </li>

                            </ul>

                            <div v-if="!isHidden" class="message">
                                <div @click="isHidden = true"><img src="/images/icons/close.svg" /></div>
                                <h4>Don't sweat it if you feel unsure</h4>
                                <p>You can always come back to this section down the road and jump between steps to make
                                    changes as you
                                    need before you are completely happy with the result. </p>

                            </div>
                        </div>
                        <div :class="[currStep == 1 ? 'is--active' : '']" class="module__step">
                            <h3>2. The Moves</h3>
                            <p>Insert the moves of the game</p>
                        </div>
                        <div :class="[currStep == 2 ? 'is--active' : '']" class="module__step">
                            <h3>3. The Position</h3>
                            <p>Choose which position of the game you will share with the world!</p>
                        </div>
                        <div :class="[currStep == 3 ? 'is--active' : '']" class="module__step">
                            <h3>4. The Game</h3>
                            <p>Other interesting information to give your poster some more backstory.</p>
                        </div>
                    </div>
                    <div class="module__navigation">
                        <div ref="buttonWrapper" class="module__buttons">
                            <div v-if="this.$data.currStep != 0" class="link-arrow is--low-op"
                                @click="changeStep(this.$data.currStep - 1)">Go back <img class="link-arrow__icn"
                                    src="../../../../public/images/icons/back.svg" alt=""></div>

                            <div v-if="this.$data.currStep != 3" class="button is--black" @click="changeStep(this.$data.currStep + 1)">Next Step
                                <img src="../../../../public/images/icons/right-arrow-white.svg" alt=""></div>
                            <div v-if="this.$data.currStep == 3" class="button is--black">Add to cart <img
                                    src="../../../../public/images/icons/bag-white.svg" alt=""></div>

                        </div>
                        <div class="module__progress-wrp">
                            <div class="module__progress">
                                <div class="progress__bar">
                                    <div :style="{ width: (currStep / 3 * 100) + '%' }" class="progress__bar-indicator"></div>
                                </div>
                                <div :class="[currStep == 0 ? 'is--active' : '', currStep > 0 ? 'is--passed' : '' ]" class="progress__step" @click="changeStep(0)">1 <div>Your design</div>
                                </div>
                                <div :class="[currStep == 1 ? 'is--active' : '', currStep > 1 ? 'is--passed' : '' ]" class="progress__step" @click="changeStep(1)">2 <div>The Moves</div>
                                </div>
                                <div :class="[currStep == 2 ? 'is--active' : '', currStep > 2 ? 'is--passed' : '' ]" class="progress__step" @click="changeStep(2)">3 <div>The Position</div>
                                </div>
                                <div :class="[currStep == 3 ? 'is--active' : '']" class="progress__step" @click="changeStep(3)">4 <div>The Game</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="poster">
                    <div class="poster__buttons-wrp">
                        <div class="button">Full screen<img src="/images/icons/full-screen.svg" /></div>
                        <div class="button"> Save this design <img src="/images/icons/bookmark-black.svg" /></div>
                    </div>
                    <div class="poster__svg-wrp"><img src="/images/posters/poster-test.svg" /></div>
                    <img class="poster__environment" src="/images/environments/builder-mockup.jpeg" />
                </div>

            </div>
        </div>
    </section>
</template>

<script>
import { onMounted } from 'vue';
export default {
    data() {
        return {
            isHidden: false,

            currStep: 0,

            currTheme: 0,

            themes: [
                {
                    id: 0,
                    title: 'New Waves',
                    desc: 'Warm & Modern',
                    texture: '/new-waves/waves.svg',
                    colour: '#fbf4ea',
                    poster: '',
                },

                {
                    id: 1,
                    title: 'Old Knowledge',
                    desc: 'Vintage & Nostalgic',
                    texture: '/old-knowledge/lines.jpg',
                    colour: '#f5f5f5',
                    poster: '',
                }

            ],
        }
    },

    methods: {

        setTheme(id) {
            this.$data.currTheme = id;
        },

        changeStep(index) {

            this.$data.currStep = index;
        }

    },

    mounted() {
        this.setTheme(0)
        this.changeStep(this.$data.currStep)
    }
}
</script>