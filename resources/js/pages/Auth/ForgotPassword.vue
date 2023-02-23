<template>
    <section class="section__hero">
        <div class="container">
            <h1>Forgot Your Password?</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum
                tristique. </p>
            <form v-if="!$page.props.flash.success" @submit.prevent="submit" class="form">
                <div class="field__wrp">
                    <label for="email" class="field__label">Email address</label>
                    <div v-if="form.errors.email" v-text="form.errors.email" class="field__error"></div>
                    <input v-model="form.email" class="field" :class="{ 'is--error': form.errors.email }" name="email"
                        placeholder="example@email.com" required />
                </div>
                <div class="field__wrp">
                    <button class="button is--black" :disabled="form.processing">
                        Send me my link! </button>
                        <Link class="link-arrow" :href="route('auth.registration')">Dont have an account? Register here <Icon name="arrow-up" /></Link>
                    <div v-if="form.errors.all" v-text="form.errors.all" class="field__error is--submit"></div>
                </div>
            </form>
            <div v-if="$page.props.flash.success" v-text="$page.props.flash.success"
                class="field__error is--static is--success"></div>

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
});

let submit = () => {
    form.post('/forgot-password');
};

</script>