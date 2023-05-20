<template>
    <header>
        <div class="container is--less-padding is--flex is--space-between">
            <Logotype />
            <div class="navigation">
                Information -
                Shipping -
                Payment
            </div>
        </div>
    </header>
    <main>
        <section class="is--no-pt">
            <div class="container is--flex">
                <slot>
                </slot>

                <div class="checkout-total">
                    <h3>Your order</h3>
                    <ul>
                        <li>
                            <ul class="">
                                <li>
                                   
                                </li>
                            </ul>
                        </li>
                        <li class="is--flex is--space-between">
                            <h4>Subtotal</h4><span>$ 100.00</span>
                        </li>
                        <li class="is--flex is--space-between">
                            <h4>Shipping</h4><span>$ 100.00</span>
                        </li>
                        <li class="is--flex is--space-between">
                            <h4>Total</h4> <span>$ 100.00</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import Logotype from '../Pages/Components/Logotype.vue'

export default {
    components: {
        Logotype,
    }
}
</script>