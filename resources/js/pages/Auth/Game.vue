<template>
    <section>
        <h1>Games</h1>
        <p>This is a graphical interface to edit, create or delete games.</p>
        <form @submit.prevent="submitGame()" class="form">

            <div class="field__wrp">
                <label for="gameOption" class="field__label">Choose option</label>
                <select v-model="game.id" id="gameOption" class="field" name="gameOption"
                    @change="updateCurrGame($event, game)">
                    <option value="0">Create new game</option>
                    <option v-for="game in this.$page.props.games" :value="game.id">{{ 'Edit: "' + game.name + '"'
                    }}
                    </option>
                </select>

            </div>

            <div class="field__wrp">
                <label v-text="'Name'" for="name" class="field__label"></label>
                <input v-model="game.name" type="text" placeholder="Rumble in the Djungle" class="field" id="name" />
            </div>

            <div class="field__wrp">
                <label for="posterOption" class="field__label">Poster</label>
                <select v-model="game.poster_id" id="posterOption" class="field" name="posterOption">
                    <option value="0">Choose from saved posters</option>
                    <option v-for="poster in this.$page.props.posters" :value="poster.id">{{ 'Use: "' + poster.title + '"'
                    }}
                    </option>
                </select>

            </div>

            <div class="field__wrp">
                <label for="opening" class="field__label">Opening</label>

                <select v-model="game.opening_id" id="opening" class="field" name="opening">
                    <option value="0">Choose opening</option>
                    <option value="-1">Create new opening</option>
                    <option v-for="opening in this.$page.props.openings" :value="opening.id">{{ opening.eco +
                        ', ' + opening.name }}
                    </option>
                </select>

            </div>

            <div class="field__wrp">
                <label for="whitePlayer" class="field__label">White Player</label>

                <select v-model="game.white_player" id="whitePlayer" class="field" name="whitePlayer">
                    <option value="0">Choose player</option>
                    <option value="-1">Create new player</option>
                    <option v-for="player in this.$page.props.players" :value="player.id">{{ player.name }}
                    </option>
                </select>

            </div>

            <div class="field__wrp">
                <label for="blackPlayer" class="field__label">Black Player</label>

                <select v-model="game.black_player" id="blackPlayer" class="field" name="blackPlayer">
                    <option value="0">Choose player</option>
                    <option value="-1">Create new player</option>
                    <option v-for="player in this.$page.props.players" :value="player.id">{{ player.name }}
                    </option>
                </select>

            </div>

            <div class="field__wrp">
                <label v-text="'When'" for="when" class="field__label"></label>
                <input v-model="game.when" type="date" class="field" id="when" placeholder="" />
            </div>
            <div class="is--margin-top"><input v-model="game.world_championship_game" type="checkbox" id="wc"> <label
                    for="wc">Is a World Championship Game</label></div>

            <div v-if="game.id != 0" class="is--margin-top"><input v-model="game.deleteGame" type="checkbox" id="delete"> <label
                    for="delete">Delete Game</label></div>

            <div class="is--flex is--margin-top">
                <button type="submit" class="button is--black"
                    v-text="game.id != 0 ? 'Update game' : 'Create Game'"></button>

                <div v-if="this.$page.props.flash.success" v-text="this.$page.props.flash.success"
                    class="is--error is--success"></div>
            </div>

        </form>

        <form @submit.prevent="submitOpening()" v-if="game.opening == -1" class="card is--margin-top">
            <div class="field__wrp">
                <label v-text="'Opening name'" for="openingName" class="field__label"></label>
                <input v-model="opening.name" class="field" id="openingName" placeholder="King's Pawn Opening" />
            </div>

            <div class="field__wrp">
                <label v-text="'Opening ECO'" for="openingEco" class="field__label"></label>
                <input v-model="opening.eco" class="field" id="openingEco" placeholder="B00" />
            </div>
            <button type="submit" class="button is--black is--margin-top">Create opening</button>
        </form>

        <form @submit.prevent="submitPlayer()" v-if="game.white_player == -1 || game.black_player == -1"
            class="card is--margin-top">
            <div class="field__wrp">
                <label v-text="'Player name'" for="playerName" class="field__label"></label>
                <input v-model="player.name" class="field" id="playerName" placeholder="Pope Franciscus XII" />
            </div>

            <div class="field__wrp">
                <label v-text="'Country of birth'" for="playerCountry" class="field__label"></label>
                <input v-model="player.country" class="field" id="playerCountry" placeholder="Vatican State" />
            </div>
            <button type="submit" class="button is--black is--margin-top">Create player</button>
        </form>
    </section>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

let game = useForm({
    id: 0,
    name: '',
    poster_id: 0,
    white_player: 0,
    black_player: 0,
    opening_id: 0,
    when: '',
    world_championship_game: false,
    deleteGame: false,
});

let opening = useForm({
    eco: '',
    name: '',
});

let player = useForm({
    name: '',
    country: '',
});

let submitGame = () => {

    let url = '/game-';

    if (game.deleteGame) url += 'delete'
    else if (game.id == 0) url += 'create'
    else url += 'update'

    game.post(url, {

        onFinish: () => game.reset(),
        onSuccess: () => game.reset(),

    });
};

let submitOpening = () => {
    opening.post('opening-create', {
        onSuccess: () => {
            opening.reset();

            let latestId = 0;

            usePage().props.openings.forEach(element => {
                if (element.id > latestId) latestId = element.id
            });

            game.opening = latestId;
        },

    });
};

let submitPlayer = () => {
    player.post('player-create', {
        onSuccess: () => {
            player.reset();

            let latestId = 0;

            usePage().props.players.forEach(element => {
                if (element.id > latestId) latestId = element.id
            });

            if (game.white_player == -1) {
                game.white_player = latestId;
            } else {
                game.black_player = latestId;
            }
        },

    });
};

</script>

<script>
import App from "../../Layouts/App.vue";
import AccountNav from "../../Layouts/AccountNav.vue";

export default {
    layout: (h, page) => {
        return h(App, () => h(AccountNav, () => page))
    },

    methods: {
        updateCurrGame(event, game) {

            if (event.target.value == 0) {

                game.id = 0;
                game.name = '';
                game.poster_id = 0;
                game.white_player = 0;
                game.black_player = 0;
                game.opening_id = 0;
                game.when = '',
                game.world_championship_game = false;
                game.deleteGame = false;

            } else {

                for (let i = 0; i < this.$page.props.games.length; i++) {
                    if (this.$page.props.games[i].id == event.target.value) {
                        game.id = this.$page.props.games[i].id;
                        game.name = this.$page.props.games[i].name;
                        game.poster_id = this.$page.props.games[i].poster_id;
                        game.white_player = this.$page.props.games[i].white_player;
                        game.black_player = this.$page.props.games[i].black_player;
                        game.opening_id = this.$page.props.games[i].opening_id;
                        game.when = this.$page.props.games[i].when;
                        game.world_championship_game = this.$page.props.games[i].world_championship_game ? true : false;
                        game.deleteGame = false;
                        break;
                    }
                }

            }
        },
    },
}
</script>