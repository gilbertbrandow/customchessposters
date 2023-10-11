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
                [
                    {
                        alt: 'Poster design shown on a light grey wall with no frame',
                        src: '/images/environments/poster-mockup-no-frame-light-grey-300x373.webp',
                        srcset: [
                            '/images/environments/poster-mockup-no-frame-light-grey-1200x1490.webp 1200w',
                            '/images/environments/poster-mockup-no-frame-light-grey-600x745.webp 600w',
                            '/images/environments/poster-mockup-no-frame-light-grey-300x373.webp 300w'
                        ]
                    },

                    {
                        alt: 'Poster design shown on a chestnut-colored wall with no frame',
                        src: '/images/environments/poster-mockup-no-frame-chestnut-300x373.webp',
                        srcset: [
                            '/images/environments/poster-mockup-no-frame-chestnut-1200x1490.webp 1200w',
                            '/images/environments/poster-mockup-no-frame-chestnut-600x745.webp 600w',
                            '/images/environments/poster-mockup-no-frame-chestnut-300x373.webp 300w',
                        ]
                    },

                    {
                        alt: 'Poster design shown on a light blue wall with no frame',
                        src: '/images/environments/light-blue.jpg',
                    },

                ],

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

                {
                    alt: 'Poster design shown in kitchen environment with a white frame',
                    src: '/images/environments/poster-mockup-white-frame-300x372.webp',
                    srcset: [
                        '/images/environments/poster-mockup-white-frame-1200x1490.webp 1200w',
                        '/images/environments/poster-mockup-white-frame-600x745.webp 600w',
                        '/images/environments/poster-mockup-white-frame-300x372.webp 300w'
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
            //If null on environment, choose a random mockup from [0], else pick the index. If 0 selected, pick first of no frame mockups
            return this.environment ?
                 this.$data.environments[this.environment] : 
                 this.$data.environments[0][this.environment === 0 ? 0 : this.getRandomInt(this.$data.environments[0].length)];
        }
    }

}
</script>