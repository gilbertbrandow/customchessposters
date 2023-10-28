<template>
    <h2>Information</h2>
    <form v-if="!this.rates.length" @submit.prevent="submit()" style="align-self: stretch;">
        <div class="field__wrp">
            <label for="email" class="field__label">Email address</label>
            <div v-if="form.errors.email" v-text="form.errors.email" class="field__error"></div>
            <input v-model="form.email" class="field" name="email" id="email" placeholder="example@email.com"
                :class="{ 'is--error': form.errors.email }" autocomplete="on" />
        </div>

        <h3 class="is--margin-top">Shipping address</h3>
        <div class="field__wrp">
            <label for="country" class="field__label">Country</label>
            <div v-if="form.errors.country_code" v-text="form.errors.country_code" class="field__error"></div>
            <select v-model="this.country" @change="updateCountry($event.target.value)" id="country" class="field"
                name="country" :class="{ 'is--error': form.errors.country_code }" autocomplete="on">
                <option :value="null">Country</option>
                <option v-for="(country, index) in $page.props.countries" v-bind:data-index="index"
                    :value="country.code + ', ' + country.name">{{ country.name }}</option>
            </select>
        </div>
        <div class="field__wrp" v-if="this.states?.length">
            <label for="country" class="field__label">State</label>
            <div v-if="form.errors.state_code" v-text="form.errors.state_code" class="field__error"></div>
            <select v-model="form.state_code" id="country" class="field" name="state"
                :class="{ 'is--error': form.errors.state_code }">
                <option :value="null">State</option>
                <option v-for="state in this.states" :value="state.code">{{ state.name }}</option>
            </select>
        </div>
        <div class="field__wrp">
            <label for="name" class="field__label">Full name</label>
            <div v-if="form.errors.name" v-text="form.errors.name" class="field__error"></div>
            <input v-model="form.name" class="field" name="name" id="name" placeholder="Jane Doe"
                :class="{ 'is--error': form.errors.name }" autocomplete="on" />
        </div>
        <div class="field__wrp">
            <label for="address1" class="field__label">Street Address</label>
            <div v-if="form.errors.address1" v-text="form.errors.address1" class="field__error"></div>
            <input type="address" v-model="form.address1" class="field" id="address1" name="address1"
                placeholder="19749 Dearborn St" :class="{ 'is--error': form.errors.address1 }" autocomplete="on" />
        </div>
        <div class="field__wrp">
            <label for="address2" class="field__label">Address line 2 (Optional)</label>

            <input type="address" v-model="form.address2" class="field" id="address2" name="address2"
                placeholder="Apt, Suite, Bldg." />
        </div>
        <div class="row">
            <div class="field__wrp">
                <label for="zip" class="field__label">Zip code</label>
                <div v-if="form.errors.zip" v-text="form.errors.zip" class="field__error"></div>
                <input v-model="form.zip" class="field" name="firstname" id="zip" placeholder="NY 10118"
                    :class="{ 'is--error': form.errors.zip }" />
            </div>

            <div class="field__wrp">
                <label for="city" class="field__label">City</label>
                <div v-if="form.errors.city" v-text="form.errors.city" class="field__error"></div>
                <input v-model="form.city" class="field" name="city" id="city" type="text" placeholder="New York"
                    :class="{ 'is--error': form.errors.city }" />
            </div>
        </div>

        <div v-if="$page.props.auth" class="is--margin-top"><input v-model="form.save" type="checkbox" id="save"> <label for="save">Do you want to save this address for future purchases?</label></div>

        <div class="field__wrp">
            <button :disabled="form.processing" class="button is--black is--less-border-radius is--flex is--space-between">
                {{ $page.props.address ? 'Update And ' : '' }}Proceeed To Shipping Alternatives
                <Icon name="arrow-right" />
            </button>
            <div v-if="false" v-text="'Test'" class="field__error is--submit"></div>
        </div>
    </form>
</template>

<script>
import Checkout from "../../Layouts/Checkout.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    layout: Checkout,

    data() {
        return {

            cart: this.$page.props.cart,
            country: this.$page.props.address ? this.$page.props.address.country_code + ', ' + this.$page.props.address.country : null,
            form: useForm({
                email: this.$page.props.address ? this.$page.props.address.email : '',
                country_code: this.$page.props.address ? this.$page.props.address.country_code + ', ' + this.$page.props.address.country : null,
                country: this.$page.props.address ? this.$page.props.address.country : null,
                state_code: this.$page.props.address ? this.$page.props.address.state_code : null,
                name: this.$page.props.address ? this.$page.props.address.name : '',
                address1: this.$page.props.address ? this.$page.props.address.address1 : '',
                address2: this.$page.props.address ? this.$page.props.address.address2 : '',
                zip: this.$page.props.address ? this.$page.props.address.zip : '',
                city: this.$page.props.address ? this.$page.props.address.city : '',
                save: false, 
            }),
            states: null,
            rates: {},
        }
    },

    methods: {

        updateCountry() {

            this.states = null;

            if (!this.country) return;

            let countryArray = this.country.split(', ');

            this.form.country_code = countryArray[0];
            this.form.country = countryArray[1];

            this.$page.props.countries.forEach(element => {
                if (element.code == countryArray[0]) {
                    this.states = element.states;
                    return;
                }
            });
        },

        submit() {

            this.form.processing = true;
            this.form.errors = {};

            this.form.post('/checkout/' + this.$page.props.route.params.orderId + '/shipping', {
                preserveScroll: true,
                preserveState: true,
                onError: () => this.$page.props.errors.shippingMethod ? this.setErrors(this.$page.props.errors.shippingMethod) : '',
            });
        },

        setErrors(error) {
            if (error.toLowerCase().includes('country')) this.form.errors.country_code = error;
            else if (error.toLowerCase().includes('state')) this.form.errors.state_code = error;
        }
    },

    mounted() {
        this.updateCountry();
    }
}
</script>