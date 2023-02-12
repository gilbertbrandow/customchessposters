<template>
    <section>
        <div class="container">
            <div class="poster__builder">

                <div class="poster__module">

                    <h2>Create Your Custom Poster</h2>
                    <div class="module__mask" ref="mask">
                        <div :class="[posterBuilder.currStep == 0 ? 'is--active' : '']" class="module__step">
                            <h3>1. Your Design</h3>
                            <p>Choose a theme for your poster from the list below and decide if the position should be
                                viewed from whites or blacks point of view.</p>
                            <ul class="themes" ref="themes">

                                <li v-for="theme in themes" :key="theme.id" @click="setTheme(theme.id)"
                                    :class="[poster.themeId == theme.id ? 'is--active' : '']" class="theme">
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


                            <div v-if="!posterBuilder.announcement" class="message">
                                <div @click="posterBuilder.announcement = true"><img src="/images/icons/close.svg" />
                                </div>
                                <h4>Don't sweat it if you feel unsure</h4>
                                <p>You can always come back to this section down the road and jump between steps to make
                                    changes as you
                                    need before you are completely happy with the result. </p>

                            </div>
                        </div>
                        <div :class="[posterBuilder.currStep == 1 ? 'is--active' : '']" class="module__step">
                            <h3>2. The Moves</h3>
                            <p>Insert the moves of the game</p>

                            <div>Current PGN: {{ this.$data.poster.gamePgn.moves }} </div>
                            <div style="margin-bottom: 2em;">Current FEN: {{ this.$data.chessGame.fen() }} </div>
                            <div class="tabs">
                                <div class="tabs__header">
                                    <div class="tab__item" :class="[posterBuilder.currTab == 0 ? 'is--active' : '']"
                                        @click="posterBuilder.currTab = 0">
                                        <h4>Input moves manually</h4>
                                    </div>
                                    <div class="tab__item" :class="[posterBuilder.currTab == 1 ? 'is--active' : '']"
                                        @click="posterBuilder.currTab = 1">
                                        <h4>Load PGN</h4>
                                    </div>
                                    <div class="tab__item" :class="[posterBuilder.currTab == 2 ? 'is--active' : '']"
                                        @click="posterBuilder.currTab = 2">
                                        <h4>Load game from Lichess</h4>
                                    </div>
                                </div>
                                <div class="tab" v-if="posterBuilder.currTab == 0">
                                    <div class="manual-moves">
                                        <div class="field__wrp">
                                            <label v-if="manualMove.valid && !isGameOver" for="whiteMove" class="field__label"
                                                v-text="this.$data.chessGame.turn() == 'w' ? 'White to move' : 'Black to move'"></label>
                                            <div v-if="!manualMove.valid" class="field__error"> Move is not valid</div>
                                            <input v-model="manualMove.pgn" @input="makeMove(false)" class="field"
                                                :class="{ 'is--error': !manualMove.valid }" name="manualMove"
                                                id="whiteMove"
                                                :placeholder=" isGameOver ? 'Game ended' : 'Move number ' + this.$data.chessGame._moveNumber"
                                                :disabled="isGameOver" />
                                        </div>
                                        <button v-if="manualMove.substr" class="button is--black"
                                            @click="makeMove(true);">
                                            Confirm move</button>
                                        <div v-if="!(this.$data.chessGame.turn() == 'w' && this.$data.chessGame._moveNumber == 1)"
                                            class="link-arrow is--low-op" @click="undoMove()">Undo Last Move <img
                                                class="link-arrow__icn" src="../../../../public/images/icons/undo.svg"
                                                alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="tab" v-if="posterBuilder.currTab == 1">

                                    <div class="field__wrp">
                                        <label for="UploadPgn" class="field__label">Paste your PGN below</label>
                                        <textarea v-model="poster.gamePgn.moves" class="field"
                                            :class="{ 'is--error': !poster.gamePgn.valid }" name="password"
                                            placeholder="1.e4 e5 2. Nf3 Nc6 3. Bc4 Bc5 4. b4..." id="gamePgn">
                                </textarea>
                                        <div v-if="!poster.gamePgn.valid" class="field__error">Invalid PGN</div>
                                    </div>
                                    <div class="button is--black" @click="loadPgn(poster.gamePgn.moves);"> Upload </div>
                                </div>

                                <div class="tab" v-if="posterBuilder.currTab == 2">
                                    <div class="field__wrp">
                                        <label for="gameUrl" class="field__label">Game URL</label>
                                        <div v-if="false" class="field__error"> URL is not valid</div>
                                        <input v-model="manualMove.pgn" @input="makeMove(false)" class="field"
                                            :class="{ 'is--error': false }" name="gameUrl" id="gameUrl"
                                            placeholder="https://lichess.org/Sxov6E94" />
                                    </div>
                                    <div class="button is--black"> Upload </div>
                                </div>
                            </div>



                        </div>
                        <div :class="[posterBuilder.currStep == 2 ? 'is--active' : '']" class="module__step">
                            <h3>3. The Position</h3>
                            <p>Choose which position of the game you will share with the world!</p>
                        </div>
                        <div :class="[posterBuilder.currStep == 3 ? 'is--active' : '']" class="module__step">
                            <h3>4. The Game</h3>
                            <p>Other interesting information to give your poster some more backstory.</p>
                            <h4>Title</h4>
                            <div class="field__wrp">
                                <label for="gameTitle" class="field__label">Title</label>
                                <div v-if="false" class="field__error">Title not valid</div>
                                <input v-model="poster.gameMeta.title" class="field" name="gameTitle" id="gameTitle"
                                    placeholder="Lorem ipsum dolor set ami" />
                            </div>
                            <h4>White Player</h4>
                            <h4>Black Player</h4>
                            <h4>When & Where</h4>
                        </div>
                        <div :class="[posterBuilder.currStep == 4 ? 'is--active' : '']" class="module__step">
                            <h3>5. The Poster</h3>
                            <p>How big would you like your poster?</p>
                        </div>
                    </div>
                    <div class="module__navigation">
                        <div ref="buttonWrapper" class="module__buttons">
                            <div v-if="this.$data.posterBuilder.currStep != 0" class="link-arrow is--low-op"
                                @click="changeStep(this.$data.posterBuilder.currStep - 1)">Go back <img
                                    class="link-arrow__icn" src="../../../../public/images/icons/back.svg" alt=""></div>

                            <div v-if="this.$data.posterBuilder.currStep != 4" class="button is--black"
                                @click="changeStep(this.$data.posterBuilder.currStep + 1)">Next Step
                                <img src="../../../../public/images/icons/right-arrow-white.svg" alt="">
                            </div>
                            <div v-if="this.$data.posterBuilder.currStep == 4" class="button is--black">Add to cart <img
                                    src="../../../../public/images/icons/bag-white.svg" alt=""></div>

                        </div>
                        <div class="module__progress-wrp">
                            <div class="module__progress">
                                <div class="progress__bar">
                                    <div :style="{ width: (posterBuilder.currStep / 4 * 100) + '%' }"
                                        class="progress__bar-indicator">
                                    </div>
                                </div>
                                <div :class="[posterBuilder.currStep == 0 ? 'is--active' : '', posterBuilder.currStep > 0 ? 'is--passed' : '']"
                                    class="progress__step" @click="changeStep(0)">1 <div>Your design</div>
                                </div>
                                <div :class="[posterBuilder.currStep == 1 ? 'is--active' : '', posterBuilder.currStep > 1 ? 'is--passed' : '']"
                                    class="progress__step" @click="changeStep(1)">2 <div>The Moves</div>
                                </div>
                                <div :class="[posterBuilder.currStep == 2 ? 'is--active' : '', posterBuilder.currStep > 2 ? 'is--passed' : '']"
                                    class="progress__step" @click="changeStep(2)">3 <div>The Position</div>
                                </div>
                                <div :class="[posterBuilder.currStep == 3 ? 'is--active' : '', posterBuilder.currStep > 2 ? 'is--passed' : '']"
                                    class="progress__step" @click="changeStep(3)">4 <div>The Game</div>
                                </div>
                                <div :class="[posterBuilder.currStep == 4 ? 'is--active' : '']" class="progress__step"
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
                    <img class="poster__environment" :src="this.$data.posterBuilder.currEnvironment" />
                </div>

            </div>
        </div>
    </section>
</template>

<script>
import { Chess } from 'chess.js'

export default {
    data() {
        return {

            chessGame: new Chess(),

            posterBuilder: {
                currStep: 0,
                announcement: false,
                currEnvironment: "",
                currTab: 0,
            },

            poster: {
                themeId: 0,
                gamePgn: {
                    moves: "",
                    valid: true,
                },
                gameMeta: {
                    title: "",
                    white: {
                        name: "",
                        elo: "",
                        title: "",
                    },
                    black: {
                        name: "",
                        elo: "",
                        title: "",
                    },
                },
            },

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
                    environment: '/images/environments/builder-mockup.jpeg',
                }

            ],

            manualMove: {
                pgn: "",
                valid: true,
                substr: false,
            },
        }
    },
    computed: {
        isGameOver() {

            return this.$data.chessGame.isGameOver();
        },

        //I get recursive error, again?
        gameTermination() {

            if(this.$data.chessGame.isCheckmate())
            {
                return "The game ended in checkmate";

            } else if (this.$data.chessGame.isThreefoldRepetition()) {

                return "The game ended in a draw due to threefold repetition";

            } else if (this.$data.chessGame.isStalemate()) {

                return "The game ended in a draw due to stalemate";

            } else if (this.$data.chessGame.isInsufficientMaterial()) {

                return "The game ended in a draw due to insufficent material";

            } else if (this.$data.chessGame.isDraw()) {

                return "The game ended in a draw due to the 50-move rule";
            } else {
                return 0;
            }
        }
    },
    methods: {

        setTheme(id) {
            this.$data.poster.themeId = id;
            this.$data.price = this.$data.themes[id].price;
            this.$data.posterBuilder.currEnvironment = this.$data.themes[id].environment;
        },

        changeStep(index) {
            this.$data.posterBuilder.currStep = index;
        },

        findIfAnyMoveStartWith(array, string) {
            return array.find(value => {
                return value.startsWith(string);
            });
        },

        makeMove(confirmed) {

            //Don't run if no move
            if (this.$data.manualMove.pgn == "") {

                this.$data.manualMove.valid = true;
                return;
            }

            //Declare useful variables
            let moves = this.$data.chessGame.moves();
            let move = this.$data.manualMove.pgn

            //Check to see if is valid start
            if (!this.findIfAnyMoveStartWith(moves, move)) {
                this.$data.manualMove.valid = false;
                return;
            } else {
                this.$data.manualMove.valid = true;
            }

            var index = moves.indexOf(move);

            if (index !== -1) {
                moves.splice(index, 1);

                //Check if any more possible moves start with
                if (this.findIfAnyMoveStartWith(moves, move) && !confirmed) {

                    //Flag that this moves need confirmation
                    this.$data.manualMove.substr = true;
                    return;

                } else {

                    //All checks okay, make move
                    try {
                        this.$data.chessGame.move(this.$data.manualMove.pgn);
                    } catch (error) {

                        //Display general error message
                        return;
                    }

                    //Move was made
                    this.$data.poster.gamePgn.moves = this.$data.chessGame.pgn();
                    this.$data.manualMove.pgn = "";
                    this.$data.manualMove.substr = false;
                }
            } else {
                //If not a complete move
                return;
            }

        },

        undoMove() {
            this.$data.chessGame.undo();
            this.$data.poster.gamePgn.moves = this.$data.chessGame.pgn();
        },

        loadPgn(pgn) {

            try {
                this.$data.chessGame.loadPgn(pgn);
            } catch {
                this.$data.poster.gamePgn.valid = false;
                return;
            }
        }

    },

    mounted() {
        this.changeStep(this.$data.posterBuilder.currStep)
        this.setTheme(this.$data.poster.themeId)
        //this.$data.chessGame.loadPgn('1. e4 e5 2. d4 d5 3. Nc3 Nf6 4. Be2 Nc6 5. Bg5 Bb4 6. Nf3 Bd7 7. Qd2 Qe7');
        this.$data.poster.gamePgn.moves = this.$data.chessGame.pgn();
    }
}
</script>