<template>
    <img class="poster__environment" :src="this.environmentObject.src" :srcset="this.environmentObject.srcset"
        :alt="this.environmentObject.alt" />
</template>

<script>
export default {
    props: {
        environment: null,
    },

    data() {
        return {
            environments: [
                {
                    alt: 'Poster design shown in on a wall with no frame',
                    src: '/images/environments/poster-mockup-300x372.webp',
                    srcset: [
                        '/images/environments/poster-mockup-1200x1490.webp 1200w',
                        '/images/environments/poster-mockup-600x745.webp 600w',
                        '/images/environments/poster-mockup-300x372.webp 300w'
                    ]
                },

                {
                    alt: 'Poster design shown in a black frame with sunlight',
                    src: '/images/environments/poster-mockup-black-frame-300x372.webp',
                    srcset: [
                        '/images/environments/poster-mockup-black-frame-1200x1490.webp 1200w',
                        '/images/environments/poster-mockup-black-frame-600x745.webp 600w',
                        '/images/environments/poster-mockup-black-frame-300x372.webp 300w'
                    ]
                },

                {
                    alt: 'Poster design shown in a warmly lit room with an oak frame',
                    src: '/images/environments/poster-mockup-oak-frame-300x372.webp',
                    srcset: [
                        '/images/environments/poster-mockup-oak-frame-1200x1490.webp 1200w',
                        '/images/environments/poster-mockup-oak-frame-600x745.webp 600w',
                        '/images/environments/poster-mockup-oak-frame-300x372.webp 300w'
                    ]
                },
            ]
        }
    },

    methods: {
        getRandomInt(max) {
            return Math.floor(Math.random() * max);
        }
    },

    computed: {
        environmentObject() {
            let index = this.environment ?? this.getRandomInt(this.$data.environments.length);
            return this.$data.environments[index];
        }
    }

}
</script>