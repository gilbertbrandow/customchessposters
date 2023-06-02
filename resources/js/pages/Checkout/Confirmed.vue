<template>
    <header>
        <div class="container is--less-padding is--flex is--space-between">
            <Logotype />
        </div>
    </header>
    <main>
        <section>
            <div class="container">
                <h1>Payment recieved for order #{{ this.$page.props.route.params.orderId }}</h1>

                <canvas height="1000px" width="2000px" id="posterCanvas"></canvas>
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
                    console.log("Payment succeeded!");
                    break;
                case "processing":
                    console.log("Your payment is processing.");
                    break;
                case "requires_payment_method":
                    console.log("Your payment was not successful, please try again.");
                    break;
                default:
                    console.log("Something went wrong.");
                    break;
            }
        },
    },

    mounted() {
        this.checkStatus();
    },
}
</script>