<template>
    <header>
        <div class="container is--less-padding is--flex is--space-between">
            <Logotype />
        </div>
    </header>
    <main>
        <section>
            <div class="container">
                <h1 v-text="this.title"></h1>
                <p> {{ this.desc }}</p>
                <Link class="button is--black is--margin-top" style="display: inline-block;" :href="route('home.index')">Get back to home page</Link>
            </div>
        </section>
    </main>
</template>

<script>
import Logotype from '../Components/Logotype.vue'

export default {
    components: {
        Logotype,
    },

    data() {
        return {
            stripe: Stripe("pk_test_51MMadbE1I2SLYKPNXR2Hl7kXtba7Yl0DVHPq9LHGeCtWmR5sVNJQpimdm3LSfrHNC0u8XAyPI46vs1uGezp1KdVH00u7FqjZ8C"),
            title: 'Loading...',
            desc: '', 
        }
    },

    methods: {
        async checkStatus() {
            const clientSecret = new URLSearchParams(window.location.search).get(
                "payment_intent_client_secret"
            );

            if (!clientSecret) {
                return;
            }

            const { paymentIntent } = await this.stripe.retrievePaymentIntent(clientSecret);

            switch (paymentIntent.status) {
                case "succeeded":
                    this.title = "Thank you!"; 
                    this.desc = "We have recieved your order #" + this.$page.props.route.params.orderId + " and you will be recieving and order confirmation email soon.";
                    break;
                case "processing":
                    this.title = "We are still processing the payment for your order #" + this.$page.props.route.params.orderId;
                    break;
                case "requires_payment_method":
                    this.title = "Your payment was not successful, please try again.";
                    break;
                default:
                    this.title = "Something went wrong";
                    break;
            }
        },
    },

    mounted() {
        this.checkStatus();
    },
}
</script>