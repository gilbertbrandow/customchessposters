<template>
    <AppLayout>
        <section class="section__hero">
            <div class="container">
                <h1>Reset Password</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum
                    tristique. </p>
                <form @submit.prevent="submit" class="form">
                    <div class="field__wrp">
                        <label for="email" class="field__label">Email address</label>
                        <div v-if="form.errors.email" v-text="form.errors.email" class="field__error"></div>
                        <input v-model="form.email" class="field"
                            :class="{ 'is--error': form.errors.email }" name="email" placeholder="example@email.com"
                            required />
                    </div>
                    <div class="field__wrp">
                        <label for="password" class="field__label">Password</label>
                        <input v-model="form.password" type="password" class="field"
                            :class="{ 'is--error': form.errors.password }" name="password" placeholder="***********"
                            required>
                        <div v-if="form.errors.password" v-text="form.errors.password" class="field__error"></div>
                    </div>
                    <div class="field__wrp">
                        <label for="password_confirmation" class="field__label">Confirm Password</label>
                        <input v-model="form.password_confirmation" type="password" class="field"
                            :class="{ 'is--error': form.errors.password_confirmation || form.errors.password }" name="password_confirmation" placeholder="***********"
                            required>
                        <div v-if="form.errors.password_confirmation" v-text="form.errors.password_confirmation" class="field__error"></div>
                    </div>
                    <div class="field__wrp">
                        <button class="button is--black" :disabled="form.processing">
                           Reset Password </button>
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

    </AppLayout>
</template>

<script>
import AppLayout from "../../Layouts/App.vue";

export default {
    components: {
        AppLayout
    }
}

</script>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

let form = useForm({
    email: '',
    password: '', 
    password_confirmation: '', 
    token: usePage().props.route.params.token
});

let submit = () => {
    form.post('/reset-password');
};

</script>