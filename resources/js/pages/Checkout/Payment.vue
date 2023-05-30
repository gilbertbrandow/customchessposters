<template>
    <h1>Payment</h1>
    <form id="payment-form" style="width: 100%;">
        <div id="link-authentication-element">
            <!--Stripe.js injects the Link Authentication Element-->
        </div>
        <div id="payment-element">
            <!--Stripe.js injects the Payment Element-->
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

    mounted() {
        const stripe = Stripe("pk_test_51MMadbE1I2SLYKPNXR2Hl7kXtba7Yl0DVHPq9LHGeCtWmR5sVNJQpimdm3LSfrHNC0u8XAyPI46vs1uGezp1KdVH00u7FqjZ8C");

        let elements;

        initialize(this.$page.props.clientSecretKey);
        checkStatus();

        document
            .querySelector("#payment-form")
            .addEventListener("submit", handleSubmit);

        // Fetches a payment intent and captures the client secret
        function initialize(clientSecret) {

            elements = stripe.elements({
                clientSecret, appearance: {
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

            const paymentElement = elements.create("payment", {
                layout: {
                    type: 'accordion',
                    defaultCollapsed: false,
                    radios: true,
                    spacedAccordionItems: false
                }
            });
            paymentElement.mount("#payment-element");
        }

        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: "http://localhost/",
                },
            });

            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }

            setLoading(false);
        }

        // Fetches the payment intent status after payment submission
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

        // ------- UI helpers -------

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function () {
                messageContainer.classList.add("hidden");
                messageText.textContent = "";
            }, 4000);
        }

        // Show a spinner on payment submission
        function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        }
    }
}
</script>