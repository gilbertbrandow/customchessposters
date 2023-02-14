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

                                <select v-model="poster.orientation" id="orientation" class="field" name="orientation">
                                    <option value="White">White</option>
                                    <option value="Black">Black</option>
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

                            <!-- <div>Current PGN: {{ this.$data.poster.gamePgn.moves }} </div>
                            <div style="margin-bottom: 2em;">Current FEN: {{ this.$data.chessGame.fen() }} </div> -->
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

                                        <div class="row">
                                            <div class="field__wrp">
                                                <label v-if="posterBuilder.manualMove.valid && !isGameOver"
                                                    for="whiteMove" class="field__label"
                                                    v-text="this.$data.chessGame.turn() == 'w' ? 'White to move' : 'Black to move'"></label>
                                                <div v-if="!posterBuilder.manualMove.valid"
                                                    class="field__error">
                                                    Move is not valid</div>
                                                <input v-model="posterBuilder.manualMove.pgn" @input="makeMove(false)"
                                                    class="field"
                                                    :class="{ 'is--error': !posterBuilder.manualMove.valid }"
                                                    id="whiteMove"
                                                    :placeholder="isGameOver ? 'Game ended' : 'Move ' + this.$data.chessGame._moveNumber + '.'"
                                                    :disabled="isGameOver" />
                                            </div>

                                            <div v-if="!(this.$data.chessGame.turn() == 'w' && this.$data.chessGame._moveNumber == 1)"
                                                class="link-arrow is--low-op" @click="undoMove()">Undo Last Move <img
                                                    class="link-arrow__icn"
                                                    src="../../../../public/images/icons/undo.svg" alt="">
                                            </div>
                                        </div>

                                        <div v-if="posterBuilder.manualMove.suggestions.length"
                                            class="text__link">{{ posterBuilder.manualMove.valid ? 'Do' : 'Did' }} you mean
                                            <span v-for="(suggestion, index) in posterBuilder.manualMove.suggestions">
                                                <span 
                                                @click="posterBuilder.manualMove.pgn = suggestion; makeMove(true)"
                                                v-text="suggestion"
                                                class="suggestion"
                                                ></span>
                                                <span v-if="index + 1  != posterBuilder.manualMove.suggestions.length" v-text="(index + 2 == posterBuilder.manualMove.suggestions.length) ? ' or ' : ', '"></span>
                                            </span>?
                                        </div>
                                    </div>
                                </div>

                                <div class="tab" v-if="posterBuilder.currTab == 1">

                                    <div class="field__wrp">
                                        <label for="UploadPgn" class="field__label">Paste your PGN below</label>
                                        <textarea v-model="posterBuilder.pastePgn.moves" class="field"
                                            :class="{ 'is--error': !posterBuilder.pastePgn.valid, 'is--success' : posterBuilder.pastePgn.success  }" name="password"
                                            placeholder="1.e4 e5 2. Nf3 Nc6 3. Bc4 Bc5 4. b4..." id="gamePgn"
                                            @input="posterBuilder.pastePgn.success = false, posterBuilder.pastePgn.valid = true">
                                </textarea>
                                        <div v-if="!posterBuilder.pastePgn.valid" class="field__error">Invalid PGN</div>
                                        <div v-if="posterBuilder.pastePgn.success"
                                        class="field__error is--success">PGN loaded successfully!</div>
                                    </div>
                                    <div class="button is--black" @click="loadPgn(posterBuilder.pastePgn.moves);"> Upload </div>
                                </div>

                                <div class="tab" v-if="posterBuilder.currTab == 2">
                                    <div class="field__wrp">
                                        <label for="gameUrl" class="field__label">Game URL</label>
                                        <div v-if="!posterBuilder.uploadLichess.valid" class="field__error"> URL is not valid</div>
                                        <div v-if="posterBuilder.uploadLichess.success"
                                        class="field__error is--success">Game uploaded successfully!</div>
                                        <input v-model="posterBuilder.gameUrl" class="field"
                                            :class="{ 'is--error': !posterBuilder.uploadLichess.valid, 'is--success' : posterBuilder.uploadLichess.success }" name="gameUrl" id="gameUrl"
                                            placeholder="https://lichess.org/Sxov6E94" 
                                            @input="posterBuilder.uploadLichess.success = false, posterBuilder.uploadLichess.valid = true" />
                                    </div>
                                    <div class="button is--black"
                                        @click="uploadGameFromLichess(posterBuilder.gameUrl), posterBuilder.gameUrl = ''"> Load </div>
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
import axios from 'axios'

export default {
    data() {
        return {

            chessGame: new Chess(),

            posterBuilder: {
                currStep: 0,
                announcement: false,
                currEnvironment: "",
                currTab: 0,
                
                manualMove: {
                    pgn: "",
                    valid: true,
                    suggestions: [],
                },
                uploadLichess: {
                    gameUrl: "",
                    success: false,
                    valid: true,
                },
                pastePgn: {
                    moves: "",
                    success: false,
                    valid: true,
                },
            },

            poster: {
                themeId: 0,
                orientation: "White",
                gamePgn: "",
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
        }
    },
    computed: {
        isGameOver() {

            return this.$data.chessGame.isGameOver();
        },

        //I get recursive error, again?
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

        findMovesThatStartWith(moves, input) {

            var result = [];

            for (let i = 0; i < moves.length; i++) {
                if (moves[i].startsWith(input)) result.push(moves[i]);
            }

            if (result.length == 0) return false;

            return result;

        },

        findSuggestions(moves, input) {

            if(input.length > 10) return [];

            //strip input of all non compatible characters, except lowercased pieces. Since this is common occurrence
            let regEx = /[^abcdefghABCDEFGH12345678KQBNRkqbnrx+#O\-]/g;
            input = input.replace(regEx,'');

            let suggestions = [];

            //Check if piece indication is not done with uppercase
            let capitalized = input.charAt(0).toUpperCase() + input.slice(1);
            suggestions = this.findMovesThatStartWith(moves, capitalized);
            if(suggestions && suggestions.length < 5) return suggestions;

            //Try by inserting x as second char
            let capture = input.substr(0, 1) + 'x' + input.substr(1);
            suggestions = this.findMovesThatStartWith(moves, capture)
            if(suggestions) return suggestions;

            //Try the combination of changing to uppercase and inserting x
            let combination = capture.charAt(0).toUpperCase() + capture.slice(1);
            suggestions = this.findMovesThatStartWith(moves, capture)
            if(suggestions) return suggestions;

            //Try turning first letter to lowercase
            let lowerCase = input.charAt(0).toLowerCase() + input.slice(1);
            suggestions = this.findMovesThatStartWith(moves, lowerCase);
            if(suggestions && suggestions.length < 5) return suggestions;
        
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

                this.$data.poster.gamePgn = this.$data.chessGame.pgn();
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

            }else {

                //The input is not a complete move and there are more than 1 possibleMoves
                this.$data.posterBuilder.manualMove.suggestions = [];
                return;

            }

        },

        undoMove() {
            this.$data.chessGame.undo();
            this.$data.poster.gamePgn = this.$data.chessGame.pgn();
            this.$data.posterBuilder.manualMove.pgn = "";
            this.makeMove();
            return;
        },

        loadPgn(pgn) {

            try {
                this.$data.chessGame.loadPgn(pgn);
            } catch {
                this.$data.posterBuilder.pastePgn.valid = false;
                return;
            }

            this.$data.posterBuilder.pastePgn.success = true;
            this.$data.poster.gamePgn = this.$data.chessGame.loadPgn(pgn);

        },

        uploadGameFromLichess(url) {

            let gameId = url.replace('https://lichess.org/', '');

            axios
                .get('https://lichess.org/game/export/' + gameId, { params: { tags: false, clocks: false, evals: false, opening: false } })
                .then(response => (
                    this.$data.chessGame.loadPgn(response.data),
                    this.$data.poster.gamePgn = this.$data.chessGame.pgn(),
                    this.$data.posterBuilder.uploadLichess.success = true
                ))
                .catch(() => (
                    console.clear(),
                    this.$data.posterBuilder.uploadLichess.valid = false
                ))
        },

    },

    mounted() {
        this.changeStep(this.$data.posterBuilder.currStep)
        this.setTheme(this.$data.poster.themeId)
    }
}
</script>