<template>
    <section class="is--pt">
        <div class="container">
            <h1>Shipping Policy</h1>
            <br><br>

            <h2>When will I get my order?</h2>

            <p>Usually, it takes 3-7 days to fulfill an order, after which it's shipped out. The shipping time
                depends on your location, but can be estimated as follows:</p>

            <ul style="list-style: circle; padding-left: 2em; font-size: 1.2em;">
                <li>USA: 3-4 business days</li>
                <li>Europe: 6-8 business days</li>
                <li>Australia: 2-14 business days</li>
                <li>Japan: 4-8 business days</li>
                <li>International: 10-20 business days</li>
            </ul>

            <br><br>
            <h2>Where will my order ship from?</h2>

            <p>We work with an on-demand order fulfillment company with facilities worldwide.</p>

            <br><br>
            <h2>Will I be charged customs for my order?</h2>
            <p>An additional customs and tax fee can occur on international orders. This fee is not in our control
                and is assessed by your local customs office. Customs policies vary widely for every country so
                please check with your local customs office directly to see if they apply duties and taxes to your
                purchases.</p>

            <br><br>
            <h2>My order should be here by now, but I still don't have it. What should I do?</h2>

            <p>Before getting in touch with us, please help us out by doing the following:</p>

            <ul style="list-style: circle; padding-left: 2em; font-size: 1.2em;">
                <li>Check your shipping confirmation email for any mistakes in the delivery address</li>
                <li>Ask your local post office if they have your package</li>
                <li>Stop by your neighbors in case the courier left the package with them</li>
            </ul>

            <p>
                If the shipping address was correct, and the package wasn't left at the post office or at your
                neighbor's,
                <Link :href="route('contact.index')">get in touch with us </Link> with your order number.
                If you did find a mistake in your delivery address, we will send you a replacement order, but
                shipping will be at your own cost.
            </p>
        </div>
    </section>
</template>

<script>
import AppLayout from "../../Layouts/App.vue";

export default {
    layout: AppLayout
}
</script>