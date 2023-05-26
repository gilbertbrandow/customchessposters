<template>
    <div class="content card">
        <h2>Shipping</h2>
        <form @submit.prevent="submit()" style="align-self: stretch;">
            <div class="field__wrp">
                <label for="email" class="field__label">Email address</label>
                <div v-if="form.errors.email" v-text="form.errors.email[0]" class="field__error"></div>
                <input v-model="form.email" class="field" name="email" placeholder="example@email.com"
                    :class="{ 'is--error': form.errors.email }" />
            </div>
            <div class="field__wrp">
                <label for="country" class="field__label">Country</label>
                <div v-if="form.errors.country_code" v-text="form.errors.country_code[0]" class="field__error"></div>
                <select v-model="form.country_code" @change="setStates($event.target.value)" id="country" class="field"
                    name="country" :class="{ 'is--error': form.errors.country_code }">
                    <option :value="null">Country</option>
                    <option v-for="(country, index) in this.$page.props.countries" v-bind:data-index="index"
                        :value="country.code">{{ country.name }}</option>
                </select>
            </div>
            <div class="field__wrp" v-if="this.states">
                <label for="country" class="field__label">State</label>
                <div v-if="form.errors.state_code" v-text="form.errors.state_code[0]" class="field__error"></div>
                <select v-model="form.state_code" id="country" class="field" name="state"
                    :class="{ 'is--error': form.errors.state_code }">
                    <option :value="null">State</option>
                    <option v-for="state in this.states" :value="state.code">{{ state.name }}</option>
                </select>
            </div>
            <div class="field__wrp">
                <label for="name" class="field__label">Full name</label>
                <div v-if="form.errors.name" v-text="form.errors.name[0]" class="field__error"></div>
                <input v-model="form.name" class="field" name="name" id="name" placeholder="Jane Doe"
                    :class="{ 'is--error': form.errors.name }" />
            </div>
            <div class="field__wrp">
                <label for="address1" class="field__label">Street Address</label>
                <div v-if="form.errors.address1" v-text="form.errors.address1[0]" class="field__error"></div>
                <input type="address" v-model="form.address1" class="field" name="address" placeholder="19749 Dearborn St"
                    :class="{ 'is--error': form.errors.address1 }" />
            </div>
            <div class="field__wrp">
                <label for="address" class="field__label">Address line 2 (Optional)</label>

                <input type="address" v-model="form.address2" class="field" name="address2"
                    placeholder="Apt, Suite, Bldg." />
            </div>
            <div class="row">
                <div class="field__wrp">
                    <label for="zip" class="field__label">Zip code</label>
                    <div v-if="form.errors.zip" v-text="form.errors.zip[0]" class="field__error"></div>
                    <input v-model="form.zip" class="field" name="firstname" id="zip" placeholder="NY 10118"
                        :class="{ 'is--error': form.errors.zip }" />
                </div>

                <div class="field__wrp">
                    <label for="city" class="field__label">City</label>
                    <div v-if="form.errors.city" v-text="form.errors.city[0]" class="field__error"></div>
                    <input v-model="form.city" class="field" name="city" id="city" type="text" placeholder="New York"
                        :class="{ 'is--error': form.errors.city }" />
                </div>
            </div>
            <div class="field__wrp">
                <button :disabled="form.processing"
                    class="button is--black is--less-border-radius is--flex is--space-between">
                    Proceeed To Shipping Alternatives
                    <Icon name="arrow-right" />
                </button>
                <div v-if="false" v-text="'Test'" class="field__error is--submit"></div>
            </div>
        </form>
    </div>
</template>

<script>
import Checkout from "../Layouts/Checkout.vue";
import axios from 'axios'
import { onMounted } from "vue";

export default {
    layout: Checkout,

    data() {
        return {

            cart: this.$page.props.cart,
            form: {
                email: '',
                country_code: null,
                state_code: null,
                name: '',
                address1: '',
                address2: '',
                zip: '',
                city: '',
                errors: {},
            },
            states: null,
            rates: {},
        }
    },

    methods: {

        setStates(countryCode) {

            this.states = null;

            this.$page.props.countries.forEach(element => {
                if (element.code == countryCode) {
                    this.states = element.states;

                    return
                }
            });
        },

        submit() {

            this.form.processing = true;
            this.form.errors = {};

            axios
                .post('/shipping', this.form)
                .then(response => (
                    console.log(response.data),
                    this.form.processing = false,
                    this.rates = response.data
                ))
                .catch((error) => (
                    this.setErrors(error.response.data),
                    this.form.processing = false
                ))
        },

        setErrors(error) {

            if (typeof error == 'string') {

                if (error.toLowerCase().includes('country')) this.form.errors.country_code = Array(error);
                else if (error.toLowerCase().includes('state')) this.form.errors.state_code = Array(error);
            } else {
                this.form.errors = error.errors;
            }
        }
    },

    mounted() {
        //console.log(this.$page.props.countries);
    }
}
</script>