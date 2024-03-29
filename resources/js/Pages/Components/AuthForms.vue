<template>
    <div class="content slide-out"
        v-if="($page.props.overlay.login || $page.props.overlay.register || $page.props.overlay.forgot) && (!Object.keys($page.props.overlay.lightbox).length)">
        <button class="button__rnd-icn" @click="$page.props.overlay.visible = false">
            <Icon name="close" />
        </button>

        <h2 v-text="title"></h2>
        <div v-if="$page.props.poster && !$page.props.overlay.forgot" class="currentPoster">
            <div><Icon name="bookmark" /></div>"{{ $page.props.poster.title }}"
        </div>
        <p v-text="text"></p>

        <form v-if="$page.props.overlay.login" @submit.prevent="submit('login')" class="form">
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
                <Link class="link-arrow" :href="route('register.index')" preserve-scroll>Dont have an
                account? Register
                here
                <Icon name="arrow-up" />
                </Link>
                <div v-if="login.errors.all" v-text="login.errors.all" class="field__error is--submit">
                </div>
            </div>
        </form>

        <form v-else-if="$page.props.overlay.register" @submit.prevent="submit('register')" class="form">
            <div class="field__wrp">
                <label for="name" class="field__label">Name</label>
                <div v-if="register.errors.name" v-text="register.errors.name" class="field__error"></div>
                <input v-model="register.name" class="field" :class="{ 'is--error': register.errors.name }" name="name"
                    placeholder="John Doe" maxlength="25"  required />
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

        <form v-else-if="$page.props.overlay.forgot" v-if="!$page.props.flash.success"
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
                <Link class="link-arrow" :href="route('register.index')" preserve-scroll>Dont have an
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

            onError: function () {
                usePage().props.authenticate.visible = true;
                usePage().props.authenticate.login = true;
                login.reset("password");
            },

            onFinish: () => login.reset("password"),

            onSuccess: () => login.reset("password"),
        });
    } else if ($form == 'register') {

        register.post('/register', {

            onError: function () {
                usePage().props.authenticate.visible = true;
                usePage().props.authenticate.register = true;
                register.reset("password", "password_confirmation");
            },

            onFinish: () => register.reset("password", "password_confirmation"),

            onSuccess: () => register.reset("password", "password_confirmation"),
        });

    } else if ($form == 'forgot') {
        forgot.post('/forgot-password', {
            onError: function () {
                usePage().props.authenticate.visible = true;
                usePage().props.authenticate.forgot = true;
            },
        });
    }
};
</script>

<script>
export default {

    computed: {
        title() {
            if(this.$page.props.overlay.login) return 'Log in';
            else if(this.$page.props.overlay.register) return this.$page.props.poster ? 'Register to save Poster' : 'Register';
            else if(this.$page.props.overlay.forgot) return 'Forgot password?';
        },

        text() {
            if(this.$page.props.overlay.login) return 'Trying to log in';
            else if(this.$page.props.overlay.register) return 'Trying to register';
            else if(this.$page.props.overlay.forgot) return 'Trying to forget';

        }
    }
}
</script>