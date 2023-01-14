<template>
    <section>
        <div class="container is--grid-4 is--no-pt">
            <div v-for="feature in features" :key="feature.id" class="feature">
                <div class="feature__icn"><img :src="`/images/icons/${ feature.icon }.svg`" alt=""></div>
                <h3 v-text="feature.title"></h3>
                <p v-text="feature.text"></p>
                <!---<Link class="link-arrow" :href="feature.url">Read more <img class="link-arrow__icn"
                    src="../../../public/images/icons/arrow-up.svg" alt=""></Link>-->
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
                title: 'Your very own', 
                text:'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum', 
                icon: 'custom',
                url: '/your-own'
                }, 
                {
                id: 2,
                title: 'Safe payment', 
                text:'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum', 
                icon: 'safe',
                url: '',
                }, 
                {
                id: 3,
                title: 'Fast shipping', 
                text:'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum', 
                icon: 'shipping',
                url: '',
                }, 
                {
                id: 4,
                title: 'High quality', 
                text:'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum', 
                icon: 'quality',
                url: '',
                }, 
            ]
        }
    }

}

</script>
