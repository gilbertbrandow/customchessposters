<template>
    <div class="content card">
        <h2>Information</h2>
        <form @submit.prevent style="align-self: stretch;">
            <div class="field__wrp">
                <label for="email" class="field__label">Email address</label>
                <div v-if="form.errors.email" v-text="form.errors.email" class="field__error"></div>
                <input v-model="form.email" class="field" :class="{ 'is--error': form.errors.email }" name="email"
                    placeholder="example@email.com" required />
            </div>
            <h3 class="is--margin-top">Shipping</h3>
            <div class="field__wrp">
                <label for="country" class="field__label">Country</label>
                <select v-model="form.country" id="country" class="field" name="country">
                    <option :value="null">Country</option>
                    <option>Sweden</option>
                </select>

            </div>
            <div class="row">
                <div class="field__wrp">
                    <label for="firstname" class="field__label">First name</label>
                    <input v-model="form.firstName" class="field" name="firstname" id="firstname" placeholder="Jane" />
                </div>

                <div class="field__wrp">
                    <label for="lastName" class="field__label">Last name</label>
                    <input v-model="form.lastName" class="field" name="lastName" id="lastName" type="text" maxlength="4"
                        placeholder="Doe" />
                </div>
            </div>
            <div class="field__wrp">
                <label for="address" class="field__label">Address</label>
                <div v-if="form.errors.email" v-text="form.errors.email" class="field__error"></div>
                <input v-model="form.email" class="field" :class="{ 'is--error': form.errors.email }" name="email"
                    placeholder="example@email.com" required />
            </div>
            <div class="row">
                <div class="field__wrp">
                    <label for="zipcode" class="field__label">Zip code</label>
                    <input v-model="form.zipCode" class="field" name="firstname" id="zipcode" placeholder="NY 10118" />
                </div>

                <div class="field__wrp">
                    <label for="city" class="field__label">City</label>
                    <input v-model="form.city" class="field" name="city" id="city" type="text" maxlength="4"
                        placeholder="New York" />
                </div>
            </div>
            <div class="field__wrp">
                <button class="button is--black" :disabled="form.processing">
                    Proceed to shipping alternatives </button>
                <div v-if="form.errors.all" v-text="form.errors.all" class="field__error is--submit"></div>
            </div>
        </form>
    </div>
</template>

<script>
import Checkout from "../Layouts/Checkout.vue";
import { useForm } from '@inertiajs/vue3'

export default {
    layout: Checkout,

    data() {
        return {
            cart: this.$page.props.cart,
            form: useForm({
                email: '',
                country: null,
            })
        }
    },

    methods: {

        submit() {
            this.form.post('/shipping/create', {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => '',
            });
        }
    }
}
</script>