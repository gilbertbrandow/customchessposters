<template>
    <div class="newsletter-wrp">
        <h2>Signup for our Newsletter</h2>
        <form @submit.prevent="submit" class="form is--newsletter">
            <div class="field__wrp">
                <label for="email" class="field__label">Email address</label>
                <div v-if="form.errors.email" v-text="form.errors.email" class="field__error"></div>
                <input v-model="form.email" class="field" :class="{ 'is--error': form.errors.email }" name="email"
                    placeholder="example@email.com" required />
            </div>

            <button class="button is--black" :disabled="form.processing"> Sign up </button>
        </form>

    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

let form = useForm({
    email: '',
});

let submit = () => {
    form.post('/newsletter');
}

</script>