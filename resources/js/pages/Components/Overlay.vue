<template>
    <aside class="overlay" v-if="this.$page.props.overlay.visible">
        <Lightbox></Lightbox>
        <div class="content slide-out"
            v-if="(this.$page.props.overlay.login || this.$page.props.overlay.register || this.$page.props.overlay.forgot) && (!Object.keys(this.$page.props.overlay.lightbox).length)">
            <button class="button__rnd-icn" @click="this.$page.props.overlay.visible = false">
                <Icon name="close" />
            </button>

            <h2 v-text="title"></h2>
            <div v-if="this.$page.props.poster && !this.$page.props.overlay.forgot" class="currentPoster">
                <div>
                    <Icon name="bookmark" />
                </div><strong>Authenticate to save: </strong>"{{ this.$page.props.poster.title }}"
            </div>
            <p v-text="text"></p>

            <form v-if="this.$page.props.overlay.login" @submit.prevent="submit('login')" class="form">
                <div class="field__wrp">
                    <label for="email" class="field__label">Email address</label>
                    <div v-if="login.errors.email" v-text="login.errors.email" class="field__error"></div>
                    <input v-model="login.email" class="field" :class="{ 'is--error': login.errors.email }" name="email"
                        placeholder="example@email.com" required />
                </div>
                <div class="field__wrp">
                    <label for="password" class="field__label">Password</label>
                    <input v-model="login.password" type="password" class="field"
                        :class="{ 'is--error': login.errors.password }" name="password" placeholder="••••••••" required>
                    <div v-if="login.errors.password" v-text="login.errors.password" class="field__error"></div>
                </div>
                <div class="form__bottom">
                    <div class="field__checkbox"><input v-model="login.remember" type="checkbox" id="remember"
                            name="remember" /><label for="remember">Remember me</label></div>
                    <Link class="link-arrow" :href="route('auth.forgotPassword')" preserve-scroll>Forgot your
                    password?</Link>
                </div>
                <div class="field__wrp">
                    <button class="button is--black" :disabled="login.processing">
                        Sign in </button>
                    <Link class="link-arrow" :href="route('auth.registration')" preserve-scroll>Dont have an
                    account? Register
                    here
                    <Icon name="arrow-up" />
                    </Link>
                    <div v-if="login.errors.all" v-text="login.errors.all" class="field__error is--submit">
                    </div>
                </div>
            </form>

            <form v-else-if="this.$page.props.overlay.register" @submit.prevent="submit('register')" class="form">
                <div class="field__wrp">
                    <label for="name" class="field__label">Name</label>
                    <div v-if="register.errors.name" v-text="register.errors.name" class="field__error"></div>
                    <input v-model="register.name" class="field" :class="{ 'is--error': register.errors.name }" name="name"
                        placeholder="John Doe" maxlength="25" required />
                </div>
                <div class="field__wrp">
                    <label for="email" class="field__label">Email address</label>
                    <div v-if="register.errors.email" v-text="register.errors.email" class="field__error"></div>
                    <input v-model="register.email" class="field" :class="{ 'is--error': register.errors.email }"
                        name="email" placeholder="example@email.com" required />
                </div>
                <div class="field__wrp">
                    <label for="password" class="field__label">Password</label>
                    <input v-model="register.password" type="password" class="field"
                        :class="{ 'is--error': register.errors.password }" name="password" placeholder="••••••••" required>
                    <div v-if="register.errors.password" v-text="register.errors.password" class="field__error">
                    </div>
                </div>
                <div class="field__wrp">
                    <label for="password_confirmation" class="field__label">Confirm Password</label>
                    <input v-model="register.password_confirmation" type="password" class="field"
                        :class="{ 'is--error': register.errors.password_confirmation || register.errors.password }"
                        name="password_confirmation" placeholder="••••••••" required>
                    <div v-if="register.errors.password_confirmation" v-text="register.errors.password_confirmation"
                        class="field__error"></div>
                </div>
                <div class="field__wrp">
                    <button class="button is--black" :disabled="register.processing">
                        Register </button>
                    <Link class="link-arrow" :href="route('auth.login')" preserve-scroll>Already have an
                    account? Sign in here
                    <Icon name="arrow-up" />
                    </Link>
                    <div v-if="register.errors.all" v-text="register.errors.all" class="field__error is--submit"></div>
                </div>
            </form>

            <form v-else-if="this.$page.props.overlay.forgot" v-if="!$page.props.flash.success"
                @submit.prevent="submit('forgot')" class="form">
                <div class="field__wrp">
                    <label for="email" class="field__label">Email address</label>
                    <div v-if="forgot.errors.email" v-text="forgot.errors.email" class="field__error"></div>
                    <input v-model="forgot.email" class="field" :class="{ 'is--error': forgot.errors.email }" name="email"
                        placeholder="example@email.com" required />
                </div>
                <div class="field__wrp">
                    <button class="button is--black" :disabled="forgot.processing">
                        Send me my link! </button>
                    <Link class="link-arrow" :href="route('auth.registration')" preserve-scroll>Dont have an
                    account? Register
                    here
                    <Icon name="arrow-up" />
                    </Link>
                    <div v-if="forgot.errors.all" v-text="forgot.errors.all" class="field__error is--submit">
                    </div>
                </div>
            </form>

            <div v-if="$page.props.flash.success" v-text="$page.props.flash.success"
                class="field__error is--static is--success"></div>
        </div>
    </aside>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'

let login = useForm({
    email: '',
    password: '',
    remember: '',
});

let register = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

let forgot = useForm({
    email: '',
});

let submit = ($form) => {

    if ($form == 'login') {
        login.post('/login', {

            preserveScroll: true,

            onError: function () {
                usePage().props.overlay.visible = true;
                usePage().props.overlay.login = true;
                login.reset("password");
            },

            onFinish: () => login.reset("password"),

            onSuccess: () => login.reset("password"),
        });
    } else if ($form == 'register') {

        register.post('/register', {

            preserveScroll: true,

            onError: function () {
                usePage().props.overlay.visible = true;
                usePage().props.overlay.register = true;
                register.reset("password", "password_confirmation");
            },

            onFinish: () => register.reset("password", "password_confirmation"),

            onSuccess: () => register.reset("password", "password_confirmation"),
        });

    } else if ($form == 'forgot') {
        forgot.post('/forgot-password', {

            preserveScroll: true,
            preserveState: true,

            onError: function () {
                usePage().props.overlay.visible = true;
                usePage().props.overlay.forgot = true;
            },
        });
    }
};
</script>

<script>

import Lightbox from './Lightbox.vue';
import AuthForms from './AuthForms.vue'

export default {

    components: {
        Lightbox,
        AuthForms,
    },

    computed: {
        visible() {
            return this.$page.props.overlay.visible;
        },

        title() {
            if (this.$page.props.overlay.login) return this.$page.props.poster ? 'You need an account to save poster' : 'Log in';
            else if (this.$page.props.overlay.register) return this.$page.props.poster ? 'You need an account to save poster' : 'Register';
            else if (this.$page.props.overlay.forgot) return 'Forgot password?';
        },

        text() {
            if (this.$page.props.overlay.login) return 'Trying to log in';
            else if (this.$page.props.overlay.register) return 'Trying to register';
            else if (this.$page.props.overlay.forgot) return 'Trying to forget';

        }
    },

    methods: {
        clickToClose(e) {
            if (e.target.closest('.overlay') && !e.target.closest('.content')) this.$page.props.overlay.visible = false;
            return
        },

        pressToClose(e) {
            if (this.$page.props.overlay.visible && e.key == 'Escape') this.$page.props.overlay.visible = false;
            return
        },
    },

    watch: {

        visible() {
            if (this.$page.props.overlay.visible) {
                window.addEventListener('keydown', this.pressToClose)
                window.addEventListener('click', this.clickToClose)
            } else {
                window.removeEventListener('keydown', this.pressToClose)
                window.removeEventListener('click', this.clickToClose)
            }
        },
    },
}
</script>