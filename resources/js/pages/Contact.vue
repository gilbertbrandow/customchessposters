<template>
    <AppLayout>
        <section class="is--pt">
            <div class="container">
                <h1>Contact us</h1>
                <form @submit.prevent="submit" class="form">
                    <div class="field__wrp">
                        <label for="name" class="field__label">Name</label>
                        <div v-if="form.errors.name" v-text="form.errors.name" class="field__error"></div>
                        <input v-model="form.name" class="field"
                            :class="{ 'is--error': form.errors.name }" name="name" placeholder="John Doe"
                            required />
                    </div>
                    <div class="field__wrp">
                        <label for="email" class="field__label">Email address</label>
                        <div v-if="form.errors.email" v-text="form.errors.email" class="field__error"></div>
                        <input v-model="form.email" class="field"
                            :class="{ 'is--error': form.errors.email }" name="email" placeholder="example@email.com"
                            required />
                    </div>
                    <div class="field__wrp">
                        <label for="message" class="field__label">Message</label>
                        <textarea v-model="form.message" class="field"
                            :class="{ 'is--error': form.errors.password }" name="password" placeholder="Lorem ipsum dolor set ami..."
                            required>
                        </textarea>
                        <div v-if="form.errors.message" v-text="form.errors.message" class="field__error"></div>
                    </div>
                    <div class="field__wrp">
                        <button class="button is--black" :disabled="form.processing">
                           Send </button>
                        <div v-if="form.errors.all" v-text="form.errors.all" class="field__error is--submit"></div>
                    </div>
                </form>
            </div>
        </section>
    </AppLayout>
</template>

<script>
import AppLayout from "../Layouts/App.vue";

export default {
    components: {
        AppLayout
    }
}
</script>

<script setup>
import { useForm } from '@inertiajs/vue3';


let form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});

let submit = () => {
    form.post('/register');
}

</script>