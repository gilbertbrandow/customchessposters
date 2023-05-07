<template>
    <div v-if="this.$page.props.overlay.cart" class="content slide-out">
        <button class="button__rnd-icn" @click="this.$page.props.overlay.visible = false, this.$page.props.overlay.cart = false">
            <Icon name="close" />
        </button>
        <h2>Cart</h2>
        <ul>
            <li v-for="item in this.$page.props.cart">
                {{ item.name + ' | Size: ' + item.size + ' | Qantity: ' + item.quantity}}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {

    },

    data() {
        return {

        }
    },

    methods: {
    }, 

    mounted() {
        console.log(this.$page.props.cart); 
    }
}
</script>