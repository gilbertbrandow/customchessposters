<template>
    <h2>Delivery Options</h2>
    <form @submit.prevent="submit()">
        <div v-for="(rate, index) in this.$page.props.deliveryOptions" class="field__wrp radio">
            {{ rate }}
            <!-- <input type="radio" :id="index" name="rates" :value="rate.id">
                <label :for="index" v-text="rate.name"></label> -->
        </div>
    </form>
</template>

<script>
import Checkout from "../../Layouts/Checkout.vue";

export default {
    layout: Checkout,
}

</script>