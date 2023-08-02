<template>
    <section>
        <div class="container is--grid-4 is--less-padding-bottom">
            <div v-for="feature in features" :key="feature.id" class="feature">
                <div class="feature__icn"><Icon :name="feature.icon" /></div>
                <h2 v-text="feature.title"></h2>
                <p v-html="feature.text"></p>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    data() {
        return {
            features: [
                {
                id: 1,
                title: 'Your Very Own', 
                text:'Upload or input your own game in our editor, change style and add players, results, move comment and title.', 
                icon: 'custom',
                }, 
                {
                id: 2,
                title: 'High Quality', 
                text:'All posters, regardless of size are printed on enhanced matte paper, with high resolution using digital printing.', 
                icon: 'quality',
                }, 
                {
                id: 3,
                title: 'Worldwide Shipping', 
                text:'We ship for affordable prices all over the world. If you would like to know more, you can read our <a href="/shipping-policy">shipping policy</a>.', 
                icon: 'shipping',
                },
                {
                id: 4,
                title: 'Safe Payments', 
                text:'Rest assured we offer many of the largest payment methods to our customers to ensure you pay how you want to.', 
                icon: 'safe',
                }, 
            ]
        }
    }

}

</script>
