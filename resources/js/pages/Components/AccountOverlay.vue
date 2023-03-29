<template>
    <aside v-if="this.$page.props.authenticate.visible">
        <div class="slide-out__wrp">
            <div class="slide-out">
                <button @click="this.$page.props.authenticate.visible = false">
                    <Icon name="close" />
                </button>
                <div v-if="this.$page.props.authenticate.login">
                    <h1>Sign in</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros
                        elementum
                        tristique. </p>
                    <div v-if="$page.props.flash.success" v-text="$page.props.flash.success"
                        class="field__error is--static is--success"></div>
                    <form @submit.prevent="submit('login')" class="form">
                        <div class="field__wrp">
                            <label for="email" class="field__label">Email address</label>
                            <div v-if="login.errors.email" v-text="login.errors.email" class="field__error"></div>
                            <input v-model="login.email" class="field" :class="{ 'is--error': login.errors.email }"
                                name="email" placeholder="example@email.com" required />
                        </div>
                        <div class="field__wrp">
                            <label for="password" class="field__label">Password</label>
                            <input v-model="login.password" type="password" class="field"
                                :class="{ 'is--error': login.errors.password }" name="password"
                                placeholder="••••••••" required>
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
                </div>
                <div v-else-if="this.$page.props.authenticate.register">
                    <h1>Register</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros
                        elementum
                        tristique. </p>
                    <form @submit.prevent="submit('register')" class="form">
                        <div class="field__wrp">
                            <label for="name" class="field__label">Name</label>
                            <div v-if="register.errors.name" v-text="register.errors.name" class="field__error"></div>
                            <input v-model="register.name" class="field" :class="{ 'is--error': register.errors.name }"
                                name="name" placeholder="John Doe" required />
                        </div>
                        <div class="field__wrp">
                            <label for="email" class="field__label">Email address</label>
                            <div v-if="register.errors.email" v-text="register.errors.email" class="field__error"></div>
                            <input v-model="register.email" class="field"
                                :class="{ 'is--error': register.errors.email }" name="email"
                                placeholder="example@email.com" required />
                        </div>
                        <div class="field__wrp">
                            <label for="password" class="field__label">Password</label>
                            <input v-model="register.password" type="password" class="field"
                                :class="{ 'is--error': register.errors.password }" name="password"
                                placeholder="••••••••" required>
                            <div v-if="register.errors.password" v-text="register.errors.password" class="field__error">
                            </div>
                        </div>
                        <div class="field__wrp">
                            <label for="password_confirmation" class="field__label">Confirm Password</label>
                            <input v-model="register.password_confirmation" type="password" class="field"
                                :class="{ 'is--error': register.errors.password_confirmation || register.errors.password }"
                                name="password_confirmation" placeholder="••••••••" required>
                            <div v-if="register.errors.password_confirmation"
                                v-text="register.errors.password_confirmation" class="field__error"></div>
                        </div>
                        <div class="field__wrp">
                            <button class="button is--black" :disabled="register.processing">
                                Register </button>
                            <Link class="link-arrow" :href="route('auth.login')" preserve-scroll>Already have an
                            account? Sign in here
                            <Icon name="arrow-up" />
                            </Link>
                            <div v-if="register.errors.all" v-text="register.errors.all"
                                class="field__error is--submit"></div>
                        </div>
                    </form>
                </div>

                <div v-else-if="this.$page.props.authenticate.forgot">

                    <h1 v-text="$page.props.flash.success ? 'We sent you an email!' : 'Forgot Your Password?'"></h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros
                        elementum
                        tristique. </p>
                    <form v-if="!$page.props.flash.success" @submit.prevent="submit('forgot')" class="form">
                        <div class="field__wrp">
                            <label for="email" class="field__label">Email address</label>
                            <div v-if="forgot.errors.email" v-text="forgot.errors.email" class="field__error"></div>
                            <input v-model="forgot.email" class="field" :class="{ 'is--error': forgot.errors.email }"
                                name="email" placeholder="example@email.com" required />
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
            </div>
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
        visible() {
            return this.$page.props.authenticate.visible;
        },
    },


    methods: {
        clickToClose(e) {

            if (e.target.closest('.slide-out__wrp') && !e.target.closest('.slide-out')) this.$page.props.authenticate.visible = false;
            return
        },
    },

    watch: {

        visible() {
            if (this.$page.props.authenticate.visible) {
                window.addEventListener('click', this.clickToClose)
            } else {
                window.removeEventListener('click', this.clickToClose)
            }
        },
    },
}
</script>