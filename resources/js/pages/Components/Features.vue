<template>
    <section>
        <div class="container"><h2>Our Benefits</h2>- Among other things</div>
        <div class="container is--grid-4 is--no-pt">
            <div v-for="feature in features" :key="feature.id" class="feature">
                <div class="feature__icn"><Icon :name="feature.icon" /></div>
                <h3 v-text="feature.title"></h3>
                <p v-text="feature.text"></p>
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
                text:'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum', 
                icon: 'custom',
                }, 
                {
                id: 2,
                title: 'High Quality', 
                text:'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum', 
                icon: 'quality',
                }, 
                {
                id: 3,
                title: 'Worldwide Shipping', 
                text:'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum', 
                icon: 'shipping',
                },
                {
                id: 4,
                title: 'Safe Payments', 
                text:'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum', 
                icon: 'safe',
                }, 
            ]
        }
    }

}

</script>
