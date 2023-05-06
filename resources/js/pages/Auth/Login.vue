<template>
    <section class="section__hero">
        <div class="container">
            <h1>Sign in</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum
                tristique. </p>
            <div v-if="$page.props.flash.success" v-text="$page.props.flash.success"
                class="field__error is--static is--success"></div>
            <form @submit.prevent="submit" class="form">
                <div class="field__wrp">
                    <label for="email" class="field__label">Email address</label>
                    <div v-if="form.errors.email" v-text="form.errors.email" class="field__error"></div>
                    <input v-model="form.email" class="field" :class="{ 'is--error': form.errors.email }" name="email"
                        placeholder="example@email.com" required />
                </div>
                <div class="field__wrp">
                    <label for="password" class="field__label">Password</label>
                    <input v-model="form.password" type="password" class="field"
                        :class="{ 'is--error': form.errors.password }" name="password" placeholder="••••••••"
                        required>
                    <div v-if="form.errors.password" v-text="form.errors.password" class="field__error"></div>
                </div>
                <div class="form__bottom">
                    <div class="field__checkbox"><input v-model="form.remember" type="checkbox" id="remember"
                            name="remember" /><label for="remember">Remember me</label></div>
                    <Link class="link-arrow" :href="route('auth.forgotPassword')">Forgot your password?</Link>
                </div>
                <div class="field__wrp">
                    <button class="button is--black" :disabled="form.processing">
                        Sign in </button>
                    <Link class="link-arrow" :href="route('register.index')">Dont have an account? Register here <Icon name="arrow-up" /></Link>
                    <div v-if="form.errors.all" v-text="form.errors.all" class="field__error is--submit"></div>
                </div>
            </form>
        </div>
        <div class="poster">
            <img src="/images/environments/warm.webp" alt="" class="poster__environment">
            <div class="poster__svg-wrp">
                <img src="/images/posters/poster-test.svg" alt="" class="poster__img">
            </div>
        </div>
    </section>
</template>

<script>
import AppLayout from "../../Layouts/App.vue";

export default {
    layout: AppLayout
}
</script>

<script setup>
import { useForm } from '@inertiajs/vue3';

let form = useForm({
    email: '',
    password: '',
    remember: '',
});

let submit = () => {
    form.post('/login', {

        onError: () => form.reset("password"),

        onFinish: () => form.reset("password"),

        onSuccess: () => form.reset("password"),
    });
};

</script>