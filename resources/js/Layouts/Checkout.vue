<template>
    <Overlay></Overlay>
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
            <div class="container is--flex is--less-padding">
                <slot>
                </slot>

                <div class="checkout-total">
                    <h3>Your order</h3>
                    <ul>
                        <li>
                            <ul class="cart-items" style="height: auto; overflow: visible;">
                                <li v-for="item in this.$page.props.cart">
                                    <template v-if="item.type == 'Poster'">
                                        <Poster :poster="item" :controls="{ 'small': true }"
                                            environment="/images/environments/builder-mockup.jpeg" />
                                        <div class="content">
                                            <h3 v-text="item.name"></h3>
                                            <span>{{ 'Size: ' + item.width + ' x ' + item.height + ' cm, ' }}
                                            </span>

                                            <div class="is--flex">
                                                <strong v-text="'$' + item.price / 100"></strong> x {{ item.quantity }}
                                            </div>

                                        </div>
                                    </template>
                                </li>
                            </ul>
                        </li>
                        <li class="is--flex is--space-between is--border-bottom">
                            <h4>Subtotal</h4><span>$ 100.00</span>
                        </li>
                        <li class="is--flex is--space-between is--border-bottom">
                            <h4>Shipping</h4><span>$ 100.00</span>
                        </li>
                        <li class="is--flex is--no-column-gap is--border-bottom">
                            <h4>Total </h4><span class="is--small" style="flex: 1; margin-left: 1em">Including $ 20.00 in
                                taxes</span><span>$ 100.00</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import Logotype from '../Pages/Components/Logotype.vue'
import Poster from '../Pages/Components/Poster.vue'
import Overlay from "../Pages/Components/Overlay.vue"

export default {
    components: {
        Overlay,
        Logotype,
        Poster
    },
    mounted() {
        console.log(this.$page.props.cart);
    }
}
</script>