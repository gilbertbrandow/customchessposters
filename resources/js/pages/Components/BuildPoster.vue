<template>
    <section>
        <div class="container">
            <div class="poster__builder">
                <div class="poster__module">
                    <div class="is--flex is--space-between">
                        <h2 v-text="(this.$page.props.editPoster) ? 'Editing poster' : 'Create Your Custom Poster'"></h2>
                        <button v-if="this.$data.controls.update" class="link-arrow is--low-op" @click="resetChanges()">
                            Undo all changes
                            <Icon name="undo" />
                        </button>
                    </div>
                    <div class="module__mask" ref="mask">
                        <div :class="[posterBuilder.currStep == 0 ? 'is--active' : '']" class="module__step">
                            <h3>1. Your Design</h3>
                            <p>Choose a theme for your poster from the list below and decide if the position should be
                                viewed from whites or blacks point of view.</p>
                            <ul class="themes" ref="themes">

                                <li v-for="theme in themes" :key="theme.id" @click="setTheme(theme.id)"
                                    :class="[poster.theme == theme.id ? 'is--active' : '']" class="theme">
                                    <div class="theme__colour-wrp">
                                        <div class="theme__colour">
                                            <div><img style="height: 100%" :src="`/images/posters/themes${theme.texture}`"
                                                    alt=""></div>
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
                                <label for="orientation" class="field__label">Diagram orientation</label>

                                <select v-model="poster.orientation" id="orientation" class="field" name="orientation">
                                    <option :value="1">White</option>
                                    <option :value="0">Black</option>
                                </select>

                            </div>

                            <div class="row is--starting-position">
                                <div class="field__wrp">
                                    <label v-text="'Starting position'" for="starting_position"
                                        class="field__label"></label>
                                    <div v-if="!posterBuilder.starting_position.valid" class="field__error">
                                        FEN is not valid </div>
                                    <input v-model="posterBuilder.starting_position.fen" class="field"
                                        :class="{ 'is--error': !posterBuilder.starting_position.valid }"
                                        id="starting_position"
                                        placeholder="rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1" />
                                </div>
                                <button v-if="!this.posterBuilder.starting_position.confirm" class="link-arrow"
                                    @click="this.poster.pgn.length == 0 ? this.updateStartingFen() : this.posterBuilder.starting_position.confirm = true">Update</button>
                                <div v-else class="confirm">This will reset the moves. Do you wish to <button
                                        class="link-arrow" @click="this.updateStartingFen()">continue</button> or
                                    <button class="link-arrow"
                                        @click="this.posterBuilder.starting_position.confirm = false">cancel</button>?
                                </div>
                            </div>
                            <div v-if="this.posterBuilder.starting_position.fen != 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1' && (this.poster.pgn.length == 0 || this.poster.starting_position == 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1')"
                                class="link-arrow is--low-op is--margin-top"
                                @click="this.posterBuilder.starting_position.fen = 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1', this.updateStartingFen()">
                                Reset to default starting position
                                <Icon name="undo" />
                            </div>


                            <div v-if="posterBuilder.announcement" class="message is--margin-top">
                                <div @click="posterBuilder.announcement = false">
                                    <Icon name="close" />
                                </div>
                                <h4>Don't sweat it if you feel unsure</h4>
                                <p>You can always come back to this section down the road and jump between steps to make
                                    changes as you
                                    need before you are completely happy with the result. </p>

                            </div>
                        </div>
                        <div :class="[posterBuilder.currStep == 1 ? 'is--active' : '']" class="module__step">
                            <h3>2. The Moves</h3>
                            <p>Insert the moves of the game, next step you will pick a position to display. <a
                                    v-if="poster.pgn" class="text__link" @click="resetBoard()">Reset game</a></p>

                            <div class="tabs">
                                <div class="tabs__header">
                                    <div class="tab__item" :class="[posterBuilder.currTab == 0 ? 'is--active' : '']"
                                        @click="posterBuilder.currTab = 0">
                                        <h4>Input moves manually</h4>
                                    </div>
                                    <div class="tab__item" :class="[posterBuilder.currTab == 1 ? 'is--active' : '']"
                                        @click="posterBuilder.currTab = 1">
                                        <h4>Paste PGN</h4>
                                    </div>
                                    <div class="tab__item" :class="[posterBuilder.currTab == 2 ? 'is--active' : '']"
                                        @click="posterBuilder.currTab = 2">
                                        <h4>Load game from Lichess</h4>
                                    </div>
                                </div>
                                <div class="tab" v-if="posterBuilder.currTab == 0">
                                    <div class="manual-moves">

                                        <div class="row">
                                            <div class="field__wrp">
                                                <label v-if="posterBuilder.manualMove.valid && !isGameOver" for="whiteMove"
                                                    class="field__label"
                                                    v-text="this.$data.chessGame.turn() == 'w' ? 'White to move' : 'Black to move'"></label>
                                                <div v-if="!posterBuilder.manualMove.valid" class="field__error">
                                                    Move is not valid</div>
                                                <input v-model="posterBuilder.manualMove.pgn" @input="makeMove(false)"
                                                    class="field" :class="{ 'is--error': !posterBuilder.manualMove.valid }"
                                                    id="whiteMove"
                                                    :placeholder="isGameOver ? this.posterBuilder.result : 'Move ' + this.$data.chessGame._moveNumber + '.'"
                                                    :disabled="isGameOver"
                                                    :style="isGameOver ? 'width:' + this.posterBuilder.result.length * 0.75 + 'em;' : ''" />
                                            </div>

                                            <div v-if="!(this.$data.chessGame.turn() == 'w' && this.$data.chessGame._moveNumber == 1)"
                                                class="link-arrow is--low-op" @click="undoMove()">Undo Last Move
                                                <Icon name="undo" />
                                            </div>
                                        </div>

                                        <div v-if="posterBuilder.manualMove.suggestions.length" class="text__link">{{
                                            posterBuilder.manualMove.valid ? 'Do' : 'Did'
                                        }} you mean
                                            <span v-for="(suggestion, index) in posterBuilder.manualMove.suggestions      ">
                                                <span role="button"
                                                    @click="posterBuilder.manualMove.pgn = suggestion; makeMove(true)"
                                                    v-text="suggestion" class="suggestion"></span>
                                                <span v-if="index + 1 != posterBuilder.manualMove.suggestions.length"
                                                    v-text="(index + 2 == posterBuilder.manualMove.suggestions.length) ? ' or ' : ', '"></span>
                                            </span>?
                                        </div>
                                    </div>

                                    <div v-if="pgnArray.length != 0">
                                        <strong>Previous moves: </strong>
                                        <div style="display: flex; column-gap: 0.5em;">
                                            <div v-if="pgnArray.length >= 5" style="margin-right: -0.25em;">...</div>
                                            <template v-for="(move, index) in pgnArray" :key="index">
                                                <div v-if="pgnArray.length < 5 || pgnArray.length - index < 5">
                                                    <span v-if="index % 2 == 0" v-text="(index / 2 + 1) + '. '"></span>
                                                    <span class="move" v-text="move"></span>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab" v-if="posterBuilder.currTab == 1">

                                    <div class="field__wrp">
                                        <label for="pastePgn" class="field__label">Paste your PGN below</label>
                                        <textarea v-model="posterBuilder.pastePgn.moves" class="field"
                                            :class="{ 'is--error': !posterBuilder.pastePgn.valid, 'is--success': posterBuilder.pastePgn.success }"
                                            name="password" placeholder="1.e4 e5 2. Nf3 Nc6 3. Bc4 Bc5 4. b4..."
                                            id="pastePgn"
                                            @input=" posterBuilder.pastePgn.success = false, posterBuilder.pastePgn.valid = true">
                                                                        </textarea>
                                        <div v-if="!posterBuilder.pastePgn.valid" class="field__error">Invalid PGN</div>
                                        <div v-if="posterBuilder.pastePgn.success" class="field__error is--success">PGN
                                            loaded successfully!</div>
                                    </div>
                                    <div class="button is--black" @click=" pastePgn(posterBuilder.pastePgn.moves);">
                                        Upload </div>
                                </div>

                                <div class="tab" v-if="posterBuilder.currTab == 2">
                                    <div class="field__wrp">
                                        <label for="gameUrl" class="field__label">Game URL</label>
                                        <div v-if="!posterBuilder.uploadLichess.valid" class="field__error"> URL is not
                                            valid</div>
                                        <div v-if="posterBuilder.uploadLichess.success" class="field__error is--success">
                                            Game uploaded successfully!</div>
                                        <input v-model="posterBuilder.gameUrl" class="field"
                                            :class="{ 'is--error': !posterBuilder.uploadLichess.valid, 'is--success': posterBuilder.uploadLichess.success }"
                                            name="gameUrl" id="gameUrl" placeholder="https://lichess.org/SwuG1qFK"
                                            @input=" posterBuilder.uploadLichess.success = false, posterBuilder.uploadLichess.valid = true" />
                                    </div>
                                    <div class="button is--black"
                                        @click=" uploadGameFromLichess(posterBuilder.gameUrl), posterBuilder.gameUrl = ''">
                                        Load </div>

                                    <div v-if="posterBuilder.gameDesc" class="message is--margin-top">
                                        <div @click=" posterBuilder.gameDesc = false">
                                            <Icon name="close" />
                                        </div>
                                        <h4>How it works</h4>
                                        <p>Simply look up any game on the <a class="text__link"
                                                href="https://lichess.org">Lichess</a> website and go to the page of that
                                            game, for example: <a class="text__link" target="_blank"
                                                href="https://lichess.org/SwuG1qFK">Polgar v. Shakhriyar</a>. Then copy the
                                            URL and paste it here.</p>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div :class="[posterBuilder.currStep == 2 ? 'is--active' : '']" class="module__step">
                            <h3>3. The Position</h3>
                            <p>Choose which position of the game you will share with the world</p>
                            <div class="poster__moves">
                                <span v-if="pgnArray.length > 140 && poster.diagram_position >= 70">...</span>
                                <div v-for="(move, index) in       pgnArray      " :key="index">

                                    <div
                                        v-if="pgnArray.length < 140 || (index < poster.diagram_position + 70 + Math.max(0, (70 - poster.diagram_position)) && index > poster.diagram_position - (70 + Math.max(0, (70 - (pgnArray.length - poster.diagram_position)))))">
                                        <span v-if="index % 2 == 0" v-text="(index / 2 + 1) + '. '"></span>
                                        <span class="move" :class="{ 'is--active': index + 1 == poster.diagram_position }"
                                            v-text="move" @click=" poster.diagram_position = index + 1"></span>
                                    </div>
                                </div>
                                <span
                                    v-if="pgnArray.length > 140 && poster.diagram_position < pgnArray.length - 70">...</span>
                            </div>
                            <div v-if="!pgnArray.length" class="message">

                                <h4>You need to make some moves!</h4>
                                <p>In order to be able to choose a position for your poster, you need to insert some
                                    moves in the previous step. If you are unsure of how to do that, you can always load
                                    a game from our <a href="/game-collection" class="text__link">Game Collection</a>
                                </p>

                            </div>

                            <div v-else class="field__wrp is--margin-top">
                                <label for="moveComment" class="field__label">Move comment (optional)</label>
                                <input v-model="poster.move_comment" class="field" name="moveComment" maxlength="92"
                                    id="moveComment" placeholder="Lorem ipsum dolor set ami" />
                            </div>
                        </div>
                        <div :class="[posterBuilder.currStep == 3 ? 'is--active' : '']" class="module__step">
                            <h3>4. The Game</h3>
                            <p>Other interesting information to give your poster some context.</p>

                            <div class="row is--title-result">
                                <div class="field__wrp">
                                    <label for="gameTitle" class="field__label">Title</label>
                                    <div v-if="!posterBuilder.titleValid" class="field__error">Title is too long</div>
                                    <input v-model="poster.title" class="field"
                                        :class="{ 'is--error': !posterBuilder.titleValid }" name="gameTitle" id="gameTitle"
                                        placeholder="Lorem ipsum dolor set ami" />
                                </div>

                                <div class="field__wrp">
                                    <label for="result" class="field__label">Result</label>
                                    <select v-model="poster.result" id="result" class="field" name="result">
                                        <option value="">Result</option>
                                        <option value="1-0">White won</option>
                                        <option value="0-1">Black won</option>
                                        <option value="1/2 - 1/2">Draw</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row is--player-input is--margin-top">
                                <div class="field__wrp">
                                    <label for="whitePlayer" class="field__label">White player</label>
                                    <input maxlength="45" v-model="poster.white_player" class="field" name="whitePlayer"
                                        id="whitePlayer" placeholder="Carlsen, Magnus" />
                                </div>

                                <div class="field__wrp">
                                    <label for="whiteRating" class="field__label">Rating</label>
                                    <input v-model="poster.white_rating" class="field" name="whiteRating" id="whiteRating"
                                        type="number" max="9999" placeholder="2126" @input="this.ratingFormat()" />
                                </div>

                                <div class="field__wrp">

                                    <label for="whiteTitle" class="field__label">Title</label>

                                    <select v-model="poster.white_title" id="whiteTitle" class="field" name="whiteTitle">
                                        <option value="">None</option>
                                        <option value="GM">GM</option>
                                        <option value="WGM">WGM</option>
                                        <option value="IM">IM</option>
                                        <option value="WIM">WIM</option>
                                        <option value="FM">FM</option>
                                        <option value="WFM">WFM</option>
                                        <option value="CM">CM</option>
                                        <option value="WCM">WCM</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row is--player-input is--margin-top">
                                <div class="field__wrp">
                                    <label for="blackPlayer" class="field__label">Black player</label>
                                    <input maxlength="45" v-model="poster.black_player" class="field" name="blackPlayer"
                                        id="blackPlayer" placeholder="Abdusattorov, Nodirbek" />
                                </div>

                                <div class="field__wrp">
                                    <label for="blackRating" class="field__label">Rating</label>
                                    <input v-model="poster.black_rating" class="field" name="blackRating" id="blackRating"
                                        type="number" max="9999" placeholder="2126" @input="this.ratingFormat()" />
                                </div>

                                <div class="field__wrp">

                                    <label for="blackTitle" class="field__label">Title</label>

                                    <select v-model="poster.black_title" id="blackTitle" class="field" name="blackTitle">
                                        <option value="">None</option>
                                        <option value="GM">GM</option>
                                        <option value="WGM">WGM</option>
                                        <option value="IM">IM</option>
                                        <option value="WIM">WIM</option>
                                        <option value="FM">FM</option>
                                        <option value="WFM">WFM</option>
                                        <option value="CM">CM</option>
                                        <option value="WCM">WCM</option>
                                    </select>

                                </div>
                            </div>
                            <div class="row is--margin-top">
                                <div class="field__wrp">
                                    <label for="gameWhere" class="field__label">Where</label>
                                    <input maxlength="40" v-model="poster.where" class="field" name="gameTitle"
                                        id="gameWhere" placeholder="Wijk aan Zee, Netherlands" />
                                </div>
                                <div class="field__wrp">
                                    <label for="gameWhen" class="field__label">When</label>
                                    <input maxlength="40" v-model="poster.when" class="field" name="gameTitle" id="gameWhen"
                                        placeholder="Tata Steel, January 2023. Round 3" />
                                </div>
                            </div>
                        </div>
                        <div :class="[posterBuilder.currStep == 4 ? 'is--active' : '']" class="module__step">
                            <h3>5. The Poster</h3>
                            <p>How big would you like your poster?</p>

                            <ul class="sizes">
                                <li :class="this.form.variant == 1 ? 'is--active' : ''"><button @click="this.form.variant = 1">21 x 30cm</button></li>
                                <li :class="this.form.variant == 2 ? 'is--active' : ''"><button @click="this.form.variant = 2">50 x 70cm</button></li>
                                <li :class="this.form.variant == 3 ? 'is--active' : ''"><button @click="this.form.variant = 3">61 x 91cm</button></li>
                                <li :class="this.form.variant == 4 ? 'is--active' : ''"><button @click="this.form.variant = 4">70 x 100cm</button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="module__navigation">
                        <div ref="buttonWrapper" class="module__buttons">
                            <button v-if="this.$data.posterBuilder.currStep != 0" class="link-arrow is--low-op"
                                @click=" changeStep(this.$data.posterBuilder.currStep - 1)">Go back
                                <Icon name="arrow-back" />
                            </button>

                            <button v-if="this.$data.posterBuilder.currStep != 4" class="button is--black"
                                @click=" changeStep(this.$data.posterBuilder.currStep + 1)">Next Step
                                <Icon name="arrow-right" />
                            </button>

                            <button v-if="this.$data.posterBuilder.currStep == 4" class="button is--black" :disabled="!this.form.variant" @click="this.addToCart()">
                                {{ !this.form.variant ? 'Add to Cart (You need to choose a size)' : 'Add to cart' }}
                                <Icon :name="!this.form.variant ? '' : 'cart'" />
                            </button>

                        </div>
                        <div class="module__progress-wrp">
                            <div class="module__progress">
                                <div class="progress__bar">
                                    <div :style="{ width: (posterBuilder.currStep / 4 * 100) + '%' }"
                                        class="progress__bar-indicator">
                                    </div>
                                </div>
                                <div :class="[posterBuilder.currStep == 0 ? 'is--active' : '', posterBuilder.currStep > 0 ? 'is--passed' : '']"
                                    class="progress__step" @click=" changeStep(0)">1 <div>Your design</div>
                                </div>
                                <div :class="[posterBuilder.currStep == 1 ? 'is--active' : '', posterBuilder.currStep > 1 ? 'is--passed' : '']"
                                    class="progress__step" @click=" changeStep(1)">2 <div>The Moves</div>
                                </div>
                                <div :class="[posterBuilder.currStep == 2 ? 'is--active' : '', posterBuilder.currStep > 2 ? 'is--passed' : '']"
                                    class="progress__step" @click=" changeStep(2)">3 <div>The Position</div>
                                </div>
                                <div :class="[posterBuilder.currStep == 3 ? 'is--active' : '', posterBuilder.currStep > 2 ? 'is--passed' : '']"
                                    class="progress__step" @click=" changeStep(3)">4 <div>The Game</div>
                                </div>
                                <div :class="[posterBuilder.currStep == 4 ? 'is--active' : '']" class="progress__step"
                                    @click=" changeStep(4)">5 <div>The Poster</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <Poster :poster="poster" :environment="this.$data.posterBuilder.currEnvironment" :controls="controls">
                </Poster>

            </div>
        </div>
    </section>
</template>

<script>
import { Chess } from 'chess.js'
import axios from 'axios'
import Poster from './Poster.vue'
import { useForm } from '@inertiajs/vue3'


export default {

    components: {
        Poster,
    },

    data() {
        return {

            chessGame: new Chess(),

            posterBuilder: {
                currStep: 0,
                announcement: true,
                gameDesc: true,
                currEnvironment: "",
                currTab: 0,
                starting_position: {
                    valid: true,
                    fen: "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1",
                    confirm: false,
                    success: false,
                },
                manualMove: {
                    pgn: "",
                    valid: true,
                    suggestions: [],
                },
                pastePgn: {
                    moves: "",
                    success: false,
                    valid: true,
                },
                uploadLichess: {
                    gameUrl: "",
                    success: false,
                    valid: true,
                },
                result: "",
                titleValid: true,
            },

            poster: this.$page.props.editPoster || {
                id: null,
                theme: 1,
                orientation: 1,
                starting_position: "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1",
                pgn: "",
                diagram_position: 0,
                move_comment: "",
                fen: "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR",
                result: "",
                title: "Lorem ipsum dolor sit amet, consectetur adi",
                white_player: "Magnus Carlsen",
                black_player: "Fabiano Caruana",
                white_rating: null,
                black_rating: null,
                white_title: "GM",
                black_title: "GM",
                when: "Tata Steel Chess, January 2014. Round 3",
                where: "Wijk aan Zee, Netherlands",
            },

            form: useForm({
                poster_data: null,
                variant: null,
            }),

            originalPoster: {},

            controls: {
                save: true,
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
        }
    },
    computed: {
        isGameOver() {

            return this.$data.chessGame.isGameOver();
        },

        gameTermination() {

            if (this.$data.chessGame.isCheckmate()) {
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
        },

        pgnArray() {

            let string = this.$data.poster.pgn ?? '';
            const gameArray = [];

            for (let i = 0; i < string.length; i++) {

                if (string[i] == " ") continue;

                for (var k = i + 1; k < string.length; k++) {
                    if (string[k] == " ") break;
                    if (string[k] == ".") {
                        i = k
                        break;
                    }
                }

                if (k > i) gameArray.push(string.substring(i, k));
                i = k;
            }

            return gameArray;
        }
    },
    methods: {

        ratingFormat() {

            if (this.poster.white_rating > 9999) this.poster.white_rating = Math.floor(this.poster.white_rating / 10);
            if (this.poster.black_rating > 9999) this.poster.black_rating = Math.floor(this.poster.black_rating / 10);
        },

        setTheme(id) {
            this.$data.poster.theme = id;
            this.$data.posterBuilder.currEnvironment = this.$data.themes[id].environment;
        },

        changeStep(index) {
            this.$data.posterBuilder.currStep = index;
        },

        updateStartingFen() {

            if (this.poster.starting_position == this.posterBuilder.starting_position.fen) {
                this.posterBuilder.starting_position.valid = true;
                return;
            }

            try {
                this.chessGame.load(this.posterBuilder.starting_position.fen)
            } catch (e) {
                this.posterBuilder.starting_position.valid = false;
                return;
            }

            this.posterBuilder.starting_position.valid = true;
            this.posterBuilder.starting_position.confirm = false;
            this.posterBuilder.starting_position.success = true;
            this.$data.poster.pgn = "";
            this.$data.poster.diagram_position = 0;
            this.poster.starting_position = this.posterBuilder.starting_position.fen;
            this.poster.fen = this.posterBuilder.starting_position.fen;

        },

        findMovesThatStartWith(moves, input) {

            var result = [];

            for (let i = 0; i < moves.length; i++) {
                if (moves[i].startsWith(input)) result.push(moves[i]);
            }

            if (result.length == 0) return false;

            return result;

        },

        findSuggestions(moves, input) {

            if (input.length > 10) return [];

            //strip input of all non compatible characters, except lowercased letters who capitalized correlate to pieces
            let regEx = /[^abcdefghABCDEFGH12345678KQBNRkqbnrx+#O\-]/g;
            input = input.replace(regEx, '');

            if (!input) return [];

            let suggestions = [];

            //Check possible moves if exact match when modifications are made
            moves.forEach(move => {
                if (move[0] == input[0] && move.includes(input.substr(1)) ||
                    move[0] == input[0].toUpperCase() && move.includes(input.substr(1)) ||
                    move == input.charAt(0).toUpperCase() + input.slice(1) ||
                    move == input.substr(0, 1) + 'x' + input.substr(1) ||
                    move == input.charAt(0).toLowerCase() + input.slice(1)
                ) {
                    suggestions.push(move);
                }
            });

            if (suggestions.length) return suggestions;

            //Try finding moves that start with input with modifications
            let variations = [];

            //Check if piece indication is not done with uppercase
            variations.push(input.charAt(0).toUpperCase() + input.slice(1));

            //Try by inserting x as second char, i.e capture was not specified
            variations.push(input.substr(0, 1) + 'x' + input.substr(1));

            //Try the combination of changing to uppercase and inserting x
            variations.push(variations[1].charAt(0).toUpperCase() + variations[1].slice(1));

            //Try turning first letter to lowercase
            variations.push(input.charAt(0).toLowerCase() + input.slice(1));

            //Loop through variations and try finding moves that start with
            for (let i = 0; i < variations.length; i++) {
                suggestions = this.findMovesThatStartWith(moves, variations[i]);
                if (suggestions.length) return suggestions;
            }

            //Try removing the last char and recalling the function
            if (input.length > 1) {
                let shortened = input.substring(0, input.length - 1);
                let validStart = this.findMovesThatStartWith(moves, shortened)
                if (validStart) {
                    return validStart;
                } else {
                    return this.findSuggestions(moves, shortened);
                }
            }

            return [];
        },

        makeMove(confirmed) {

            //If empty input
            if (this.$data.posterBuilder.manualMove.pgn == "") {

                this.$data.posterBuilder.manualMove.valid = true;
                this.$data.posterBuilder.manualMove.suggestions = [];
                return;
            }

            //Declare variables
            const moves = this.$data.chessGame.moves();
            const input = this.$data.posterBuilder.manualMove.pgn

            //Run function to get the possible moves considering the input and get boolean value to determine if complete move
            const possibleMoves = this.findMovesThatStartWith(moves, input);

            if (!possibleMoves) {

                this.$data.posterBuilder.manualMove.valid = false;
                this.$data.posterBuilder.manualMove.suggestions = this.findSuggestions(moves, input);

                return;
            }

            this.$data.posterBuilder.manualMove.valid = true;

            const completeMove = possibleMoves.includes(input);

            if (completeMove && (possibleMoves.length == 1 || confirmed)) {

                //The input is a complete move and there is only that possible move or the input has been confirmed
                this.$data.posterBuilder.manualMove.suggestions = [];

                try {
                    this.$data.chessGame.move(input);
                } catch (error) {

                    //Display general error message
                    return;
                }

                this.$data.poster.pgn = this.getStrictPgn();
                this.$data.poster.diagram_position = this.pgnArray.length;
                this.$data.posterBuilder.manualMove.pgn = "";

                return;

            } else if (completeMove && possibleMoves.length > 1 && !confirmed) {

                //The input is a complete move but the input is also substring of another possible move and the input is not confirmed
                this.$data.posterBuilder.manualMove.suggestions = [];
                this.$data.posterBuilder.manualMove.suggestions = possibleMoves;
                return;

            } else if (!completeMove && possibleMoves.length < 6) {

                //The input is not a complete move but there is a limited possible moves
                this.$data.posterBuilder.manualMove.suggestions = possibleMoves;

                return;

            } else {

                //The input is not a complete move and there are more than 6 possibleMoves
                this.$data.posterBuilder.manualMove.suggestions = [];
                return;

            }

        },

        undoMove() {

            //Undo move
            this.$data.chessGame.undo();
            this.$data.poster.pgn = this.getStrictPgn(),
                this.$data.posterBuilder.manualMove.pgn = "";
            this.$data.poster.diagram_position = this.pgnArray.length;
            this.makeMove();
            return;
        },

        resetBoard() {

            this.$data.chessGame.reset();
            this.$data.poster.pgn = "";
            this.$data.poster.diagram_position = "0";

        },

        getStrictPgn() {

            let history = this.$data.chessGame.history();
            let pgnStrict = "";

            //Loop through history of only moves and concatinate to string
            for (let i = 0; i < history.length; i++) {

                if (i % 2 == 0) pgnStrict += (i / 2 + 1) + '. '
                pgnStrict += history[i] + ' ';

            }

            return pgnStrict;

        },

        tryHeaders() {
            const headers = this.$data.chessGame.header();

            if (!headers) return;

            if (headers.White) this.poster.white_player = headers.White;
            if (headers.WhiteElo && /^\d+$/.test(headers.WhiteElo)) {
                this.poster.white_rating = headers.WhiteElo
                this.poster.white_title = (headers.WhiteElo > 2500) ? "GM" : "";
            } else {
                this.poster.white_title = "";
            }

            if (headers.Black) this.poster.black_player = headers.Black;

            if (headers.BlackElo && /^\d+$/.test(headers.BlackElo)) {
                this.poster.black_rating = headers.BlackElo
                this.poster.black_title = (headers.BlackElo > 2500) ? "GM" : "";
            } else {
                this.poster.black_title = "";
            }


            if (headers.Site) this.poster.where = headers.Site;
            if (headers.Event) this.poster.when = headers.Event;
            if (headers.Date) this.poster.when += ', ' + headers.Date;
            if (headers.Round) this.poster.when += ' Round ' + headers.Round;
            if (headers.Result) this.poster.result = headers.Result;

            return;

        },

        pastePgn(pgn) {

            try {
                this.$data.chessGame.loadPgn(pgn);
            } catch {
                this.$data.posterBuilder.pastePgn.valid = false;
                return;
            }

            this.$data.posterBuilder.pastePgn.success = true;

            this.$data.poster.diagram_position = this.pgnArray.length;

            this.$data.poster.pgn = this.getStrictPgn();

            this.tryHeaders();

        },

        uploadGameFromLichess(url) {

            let gameId = url.replace('https://lichess.org/', '').slice(0, 8);

            axios
                .get('https://lichess.org/game/export/' + gameId, { params: { pgnInJson: true, tags: true, clocks: false, evals: false, opening: false } })
                .then(response => (
                    this.resetBoard(),
                    this.$data.chessGame.loadPgn(response.data),
                    this.tryHeaders(),
                    this.$data.poster.pgn = this.getStrictPgn(),
                    this.$data.posterBuilder.uploadLichess.success = true,
                    this.$data.poster.diagram_position = this.pgnArray.length
                ))
                .catch(() => (
                    this.$data.posterBuilder.uploadLichess.valid = false
                ))
        },

        onKeydown(e) {
            if (this.poster.pgn != "") {
                switch (e.key) {
                    case 'ArrowRight':
                        if (this.poster.diagram_position < this.pgnArray.length) this.poster.diagram_position++;
                        break;

                    case 'ArrowLeft':
                        if (this.poster.diagram_position > 0) this.poster.diagram_position--;
                        break;

                    case 'ArrowDown':
                        this.poster.diagram_position = 0;
                        break;

                    case 'ArrowUp':
                        this.poster.diagram_position = this.pgnArray.length;
                        break;
                }
            }
        },

        resetChanges() {
            if (this.$data.originalPoster) {
                this.$data.poster = JSON.parse(this.$data.originalPoster);
                this.updateStartingFen();
                this.$data.chessGame.loadPgn(this.$data.poster.pgn);
            }
        },

        addToCart() {

            this.form.poster_data = this.poster; 

            this.form.post('/product', {
                preserveState: true, 
                preserveScroll: true, 
                onSuccess: () => this.form.variant = false,
            });
        }

    },

    watch: {
        poster: {
            handler(newValue, oldValue) {

                if (!this.$page.props.editPoster) return;

                if (JSON.stringify(this.$data.poster) != this.$data.originalPoster) {
                    this.$data.controls.update = true;
                } else {
                    this.$data.controls.update = false;
                }
            },
            deep: true
        },

        'poster.diagram_position'() {

            if (this.pgnArray.length == this.poster.diagram_position) {
                this.$data.poster.fen = this.chessGame.fen();
            } else {
                let history = this.chessGame.history({ verbose: true });
                this.$data.poster.fen = history[this.poster.diagram_position].fen;
            }
        },
        'posterBuilder.currStep'() {

            if (this.posterBuilder.currStep == 2) window.addEventListener('keydown', this.onKeydown)
            else window.removeEventListener('keydown', this.onKeydown)

        },

        isGameOver() {

            if (this.$data.chessGame.isCheckmate()) {
                this.poster.result = this.pgnArray.length % 2 == 1 ? "1-0" : "0-1"
                this.posterBuilder.result = "The game ended in checkmate";

            } else if (this.$data.chessGame.isThreefoldRepetition()) {
                this.poster.result = "1/2-1/2"
                this.posterBuilder.result = "The game ended in a draw due to threefold repetition";

            } else if (this.$data.chessGame.isStalemate()) {
                this.poster.result = "1/2-1/2"
                this.posterBuilder.result = "The game ended in a draw due to stalemate";

            } else if (this.$data.chessGame.isInsufficientMaterial()) {
                this.poster.result = "1/2-1/2"
                this.posterBuilder.result = "The game ended in a draw due to insufficent material";

            } else if (this.$data.chessGame.isDraw()) {
                this.poster.result = "1/2-1/2"
                this.posterBuilder.result = "The game ended in a draw due to the 50-move rule";
            } else {
                this.poster.result = "";
            }

            return;
        }
    },

    mounted() {

        if (this.$page.props.editPoster) {
            this.$data.originalPoster = JSON.stringify(Object.assign({}, this.$page.props.editPoster));
        }

        this.setTheme(this.$data.poster.theme);
        this.chessGame.load(this.$data.poster.starting_position);
        if (this.$data.poster.pgn) this.chessGame.loadPgn(this.$data.poster.pgn);
    }
}
</script>