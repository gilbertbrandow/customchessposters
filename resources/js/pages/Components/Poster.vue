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
                        <div class="module__step">
                            <h3>1. Your Design</h3>
                            <p>Choose a theme for your poster from the list below:</p>
                            <ul class="themes" ref="themes">

                                <li v-for="theme in themes" :key="theme.id" @click="setTheme(theme.id)" :ref="'theme' + theme.id" class="theme">
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
                                <p>You can always come back to this section down the road and jump between steps to make changes as you
                                    need before you are completely happy with the result. </p>

                            </div>
                        </div>
                        <div class="module__step">
                            <h3>2. The Moves</h3>
                            <p>Insert the moves of the game</p>
                        </div>
                        <div class="module__step">
                            <h3>3. The Position</h3>
                            <p>Choose which position of the game you will share with the world!</p>
                        </div>
                        <div class="module__step">
                            <h3>4. The Game</h3>
                            <p>Other interesting information to give your poster some more backstory.</p>
                        </div>
                    </div>
                    <div class="module__navigation">
                        <div class="module__buttons">
                            <div class="link-arrow is--low-op is--visible"
                                @click="changeStep(getIndexOfCurrentStep() - 1)">Go back <img class="link-arrow__icn"
                                    src="../../../../public/images/icons/back.svg" alt=""></div>

                            <div class="button is--black" @click="changeStep(getIndexOfCurrentStep() + 1)">Next Step <img
                                    src="../../../../public/images/icons/right-arrow-white.svg" alt=""></div>
                            <div class="button is--black">Add to cart <img
                                    src="../../../../public/images/icons/bag-white.svg" alt=""></div>

                        </div>
                        <div class="module__progress-wrp">
                            <div class="module__progress">
                                <div class="progress__bar">
                                    <div class="progress__bar-indicator"></div>
                                </div>
                                <div class="progress__step" @click="changeStep(0)">1 <div>Your design</div>
                                </div>
                                <div class="progress__step" @click="changeStep(1)">2 <div>The Moves</div>
                                </div>
                                <div class="progress__step" @click="changeStep(2)">3 <div>The Position</div>
                                </div>
                                <div class="progress__step" @click="changeStep(3)">4 <div>The Game</div>
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

        getIndexOfCurrentStep() {
            let mask = this.$refs.mask
            let currentStep = document.querySelector('.module__step.is--active');
            let index = Array.prototype.indexOf.call(mask.children, currentStep);
            return index;
        },

         setTheme (id) {
            if(document.querySelector('.theme.is--active'))document.querySelector('.theme.is--active').classList.remove('is--active');
            this.$refs['theme' + id][0].classList.add('is--active'); 

            console.log(this.$refs['theme' + id][0])
        },

    }, 

    mounted() {
        this.setTheme(0)
    }
}
</script>

<script setup>

onMounted(() => {
    changeStep(0);
});

function changeStep(index) {

    let steps = document.querySelectorAll('.module__step');
    let active = steps.item(index);
    let buttons = document.querySelector('.module__buttons').children;
    let progressSteps = document.querySelectorAll('.progress__step');
    let progressBar = document.querySelector('.progress__bar-indicator');
    let width = (index / 3 * 100) + "%";

    if (document.querySelector('.module__step.is--active')) { document.querySelector('.module__step.is--active').classList.remove('is--active'); }
    active.classList.add('is--active');

    for (let i = 0; i < progressSteps.length; i++) {

        progressSteps[i].classList.remove('is--active');

        if (i == index) {
            progressSteps[i].classList.add('is--active');
        }
        else if (i < index) {
            progressSteps[i].classList.add('is--passed');
        }
        else if (i > index) {
            progressSteps[i].classList.remove('is--passed');
        }
    }

    progressBar.style.width = width;

    if (index == 0) {
        buttons[0].classList.remove('is--visible')
    } else if (!buttons[0].classList.contains('is--visble')) {
        buttons[0].classList.add('is--visible')
    }

    if (index == 3) {
        buttons[1].classList.remove('is--visible')
        buttons[2].classList.add('is--visible')
    } else if (!buttons[1].classList.contains('is--visible')) {
        buttons[1].classList.add('is--visible')
    }

    if (index != 3) {
        buttons[2].classList.remove('is--visible')
    }


}

</script>