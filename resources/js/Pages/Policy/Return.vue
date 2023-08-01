<template>
    <section class="is--pt">
        <div class="container">
            <h1>Return Policy</h1>
            <br><br>
            <h2>What's your return policy?</h2>
            <p>We don't offer returns and exchanges, but if there's something wrong with your order, please let
                us know by
                <Link :href="route('contact.index')">contacting us. </Link>
            </p>
            <br><br>
            <h2>Do you offer refunds?</h2>
            <p>Refunds are only offered to customers that receive the wrong items or damaged items. If any of
                these apply, please
                <Link :href="route('contact.index')"> contact us </Link> with photos of wrong/damaged
                items and we'll sort that out for you.
            </p>

            <br><br>

            <h2>Can I exchange an item for a different size/design?</h2>
            <p>At this time, we don't offer exchanges. It's possible that an item you ordered came with a faulty design. If
                that's the case,
                <Link :href="route('contact.index')"> please let
                us know </Link> within a week after receiving your order. We will ask you for
                order number and photos of the mislabeled item by email, and we'll send you a new one, or issue a
                refund!
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