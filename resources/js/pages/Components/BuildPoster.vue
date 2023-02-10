<template>
    <section>
        <div class="container">
            <div class="poster__builder">

                <div class="poster__module">

                    <h2>Create Your Custom Poster</h2>
                    <div class="module__mask" ref="mask">
                        <div :class="[currStep == 0 ? 'is--active' : '']" class="module__step">
                            <h3>1. Your Design</h3>
                            <p>Choose a theme for your poster from the list below and decide if the position should be
                                viewed from whites or blacks point of view.</p>
                            <ul class="themes" ref="themes">

                                <li v-for="theme in themes" :key="theme.id" @click="setTheme(theme.id)"
                                    :class="[currTheme == theme.id ? 'is--active' : '']" class="theme">
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

                            <div class="field__wrp">
                                <label for="orientation" class="field__label">Orientation</label>

                                <select id="orientation" class="field" name="orientation">
                                    <option value="White">White</option>
                                    <option value="White">Black</option>
                                </select>

                            </div>


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
                            <div class="manual-moves">
                                <h4>Move 1</h4>
                                <div class="field__wrp">
                                    <label for="email" class="field__label">White move</label>
                                    <div class="field__error"> Move 1</div>
                                    <input v-model="whiteMove" v-on:input="checkIfValidMove()" class="field"
                                        name="email" placeholder="Nf3" required />
                                </div>
                                <div class="field__wrp">
                                    <label for="email" class="field__label">Black move</label>
                                    <div class="field__error"> Move 1</div>
                                    <input class="field" name="email" placeholder="e5" required />
                                </div>
                            </div>

                            <div style="margin-top: 4em;">Current FEN: {{ this.$data.FEN }}</div>
                            <div>Current PGN: {{ this.$data.PGN }}</div>

                        </div>
                        <div :class="[currStep == 2 ? 'is--active' : '']" class="module__step">
                            <h3>3. The Position</h3>
                            <p>Choose which position of the game you will share with the world!</p>
                        </div>
                        <div :class="[currStep == 3 ? 'is--active' : '']" class="module__step">
                            <h3>4. The Game</h3>
                            <p>Other interesting information to give your poster some more backstory.</p>
                        </div>
                        <div :class="[currStep == 4 ? 'is--active' : '']" class="module__step">
                            <h3>5. The Poster</h3>
                            <p>How big would you like your poster?</p>
                        </div>
                    </div>
                    <div class="module__navigation">
                        <div ref="buttonWrapper" class="module__buttons">
                            <div v-if="this.$data.currStep != 0" class="link-arrow is--low-op"
                                @click="changeStep(this.$data.currStep - 1)">Go back <img class="link-arrow__icn"
                                    src="../../../../public/images/icons/back.svg" alt=""></div>

                            <div v-if="this.$data.currStep != 4" class="button is--black"
                                @click="changeStep(this.$data.currStep + 1)">Next Step
                                <img src="../../../../public/images/icons/right-arrow-white.svg" alt="">
                            </div>
                            <div v-if="this.$data.currStep == 4" class="button is--black">Add to cart <img
                                    src="../../../../public/images/icons/bag-white.svg" alt=""></div>

                        </div>
                        <div class="module__progress-wrp">
                            <div class="module__progress">
                                <div class="progress__bar">
                                    <div :style="{ width: (currStep / 4 * 100) + '%' }" class="progress__bar-indicator">
                                    </div>
                                </div>
                                <div :class="[currStep == 0 ? 'is--active' : '', currStep > 0 ? 'is--passed' : '']"
                                    class="progress__step" @click="changeStep(0)">1 <div>Your design</div>
                                </div>
                                <div :class="[currStep == 1 ? 'is--active' : '', currStep > 1 ? 'is--passed' : '']"
                                    class="progress__step" @click="changeStep(1)">2 <div>The Moves</div>
                                </div>
                                <div :class="[currStep == 2 ? 'is--active' : '', currStep > 2 ? 'is--passed' : '']"
                                    class="progress__step" @click="changeStep(2)">3 <div>The Position</div>
                                </div>
                                <div :class="[currStep == 3 ? 'is--active' : '', currStep > 2 ? 'is--passed' : '']"
                                    class="progress__step" @click="changeStep(3)">4 <div>The Game</div>
                                </div>
                                <div :class="[currStep == 4 ? 'is--active' : '']" class="progress__step"
                                    @click="changeStep(4)">5 <div>The Poster</div>
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
                    <img class="poster__environment" :src="this.$data.currEnvironment" />
                </div>

            </div>
        </div>
    </section>
</template>

<script>
import { onMounted } from 'vue';
import { Chess } from 'chess.js'

export default {
    data() {
        return {

            price: 0,

            isHidden: false,

            currStep: 0,

            themes: [
                {
                    id: 0,
                    price: 19,
                    title: 'New Waves',
                    desc: 'Warm & Modern',
                    texture: '/new-waves/waves.svg',
                    colour: '#fbf4ea',
                    poster: '',
                    environment: '/images/environments/builder-mockup.jpeg',
                },

                {
                    id: 1,
                    price: 32,
                    title: 'Old Knowledge',
                    desc: 'Vintage & Nostalgic',
                    texture: '/old-knowledge/lines.jpg',
                    colour: '#f5f5f5',
                    poster: '',
                    environment: '/images/environments/minimalistic.webp',
                }

            ],

            currTheme: 0,

            currEnvironment: "",

            chessGame: new Chess(),

            whiteMove: "",

            PGN: '1. e4 e5',

            startingPosition: 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
        }
    },

    methods: {

        setTheme(id) {
            this.$data.currTheme = id;
            this.$data.price = this.$data.themes[id].price;
            this.$data.currEnvironment = this.$data.themes[id].environment;
        },

        changeStep(index) {
            this.$data.currStep = index;
        },

        checkIfValidMove(value) {
            console.log(this.$data.whiteMove);

            try {
                this.$data.chessGame.move(this.$data.whiteMove);
            } catch (error) {
                console.log("Not valid move");
                return;
            }
            
            console.log(this.$data.chessGame.ascii());
            //console.log("Move is valid")

        },

        makeMove(move) {
            this.$data.chessGame.move(move);
            console.log(this.$data.chessGame.ascii());
        },

    },

    mounted() {
        this.changeStep(this.$data.currStep)
        this.setTheme(this.$data.currTheme)
        //this.makeMove('e4');

    }
}
</script>