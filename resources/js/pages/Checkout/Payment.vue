<template>
    <h1>Payment</h1>
    <form @submit.prevent="this.submit()" style="width: 100%;">
        <div id="link-authentication-element">
        </div>
        <div id="payment-element">
        </div>
        <button id="submit" class="button is--black is--less-border-radius is--flex is--space-between is--margin-top">
            Pay now
        </button>
        <div id="payment-message" class="hidden"></div>
    </form>
</template>

<script>
import Checkout from "../../Layouts/Checkout.vue";

export default {
    layout: Checkout,

    data() {
        return {
            stripe: Stripe("pk_test_51MMadbE1I2SLYKPNXR2Hl7kXtba7Yl0DVHPq9LHGeCtWmR5sVNJQpimdm3LSfrHNC0u8XAyPI46vs1uGezp1KdVH00u7FqjZ8C"),
            elements: null,
        }
    },

    methods: {
        initialize(clientSecret) {

            this.elements = this.stripe.elements({
                clientSecret,
                appearance: {
                    theme: 'stripe',
                    variables: {
                        colorPrimary: '#000',
                        colorBackground: '#ffffff',
                        colorText: '#000',
                        colorDanger: '#df1b41',
                        fontFamily: 'Ideal Sans, system-ui, sans-serif',
                        spacingUnit: '4px',
                        borderRadius: '4px',
                    }
                },
                fonts: [{
                    family: 'CabinetGrotesk',
                    src: 'url(https://localhost/resources/fonts/CabinetGrotesk-Variable.woff2")',
                    weight: '500',
                }],
            });

            this.elements.create("payment", {
                layout: {
                    type: 'accordion',
                    defaultCollapsed: false,
                    radios: true,
                    spacedAccordionItems: false
                }
            }).mount("#payment-element");

        },

        async submit() {

            const elements = this.elements; 

            const { error } = await this.stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: "http://localhost/checkout/" + this.$page.props.route.params.orderId + '/confirmed',
                },
            });

            if (error.type === "card_error" || error.type === "validation_error") {
                console.log(error.message);
            } else {
                console.log("An unexpected error occurred.");
            }

        },
    },

    mounted() {

        this.initialize(this.$page.props.clientSecretKey);
        checkStatus();

        async function checkStatus() {
            const clientSecret = new URLSearchParams(window.location.search).get(
                "payment_intent_client_secret"
            );

            if (!clientSecret) {
                return;
            }

            const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

            switch (paymentIntent.status) {
                case "succeeded":
                    showMessage("Payment succeeded!");
                    break;
                case "processing":
                    showMessage("Your payment is processing.");
                    break;
                case "requires_payment_method":
                    showMessage("Your payment was not successful, please try again.");
                    break;
                default:
                    showMessage("Something went wrong.");
                    break;
            }
        }

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function () {
                messageContainer.classList.add("hidden");
                messageText.textContent = "";
            }, 4000);
        }
    }
}
</script>