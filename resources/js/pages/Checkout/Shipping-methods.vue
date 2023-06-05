<template>
    <h2>Shipping Methods</h2>
    <form @submit.prevent="submit()" class="form is--no-max-width">
        <div v-for="(method, index) in this.$page.props.shippingMethods" class="field__wrp radio">
            <input v-model="this.form.method" type="radio" :id="index" name="methods" :value="method.id"
                :checked="method.name == this.$page.props.shippingMethod.shipping">
            <label :for="index">
                <Icon :name="method.name == 'STANDARD' ? 'shipping' : 'sustainable-shipping'" />
                <div class="is--flex">
                    <span v-text="method.name.toLowerCase().replace(/_/g, ' ')"></span>
                    <span v-text="method.desc"></span>
                </div>
                <span v-text="'$ ' + (method.cost / 100).toFixed(2)"></span>
            </label>
        </div>

        <div class="field__wrp">
            <button :disabled="form.processing || !this.form.method"
                class="button is--black is--less-border-radius is--flex is--space-between">
                {{ this.form.method != null ? 'Proceed to paymnet' : 'You need to choose an option before you continue' }}
                <Icon v-if="this.form.method != null" name="arrow-right" />
            </button>
        </div>
    </form>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
import Checkout from "../../Layouts/Checkout.vue";

export default {
    layout: Checkout,

    data() {
        return {
            form: useForm({
                method: null,
            }),
        }
    },

    methods: {
        submit() {
            this.form.post('/checkout/' + this.$page.props.route.params.orderId + '/shipping-method', {
                preserveScroll: true,
                preserveState: true,
            });
        }
    },

    mounted() {

        if (!this.$page.props.shippingMethod) this.form.method = null
        else {
            this.$page.props.shippingMethods.forEach(element => {
                if (element.name === this.$page.props.shippingMethod.shipping) this.form.method = element.id;
            });
        }
    }
}

</script>