<template>
    <section>
        <h1>Account</h1>
        <h3>Reset password?</h3>
        <form @submit.prevent="submit()" class="form">
            <div class="field__wrp">
                <label for="email" class="field__label">Email address</label>
                <div
                    v-if="forgot.errors.email"
                    v-text="forgot.errors.email"
                    class="field__error"
                ></div>
                <input
                    v-model="forgot.email"
                    class="field"
                    :class="{ 'is--error': forgot.errors.email }"
                    name="email"
                    placeholder="example@email.com"
                    required
                />
            </div>
            <div class="field__wrp">
                <button class="button is--black" :disabled="forgot.processing">
                    Send me my link to reset password
                </button>
                <div
                    v-if="forgot.errors.all"
                    v-text="forgot.errors.all"
                    class="field__error is--submit"
                ></div>
            </div>
        </form>
    </section>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'

let forgot = useForm({
    email: "",
});

let submit = ($form) => {
    forgot.post("/forgot-password", {});
};
</script>
<script>
import App from "../../Layouts/App.vue";
import AccountNav from "../../Layouts/AccountNav.vue";

export default {
    layout: (h, page) => {
        return h(App, () => h(AccountNav, () => page));
    },
};
</script>
