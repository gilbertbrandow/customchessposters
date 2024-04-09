<template>
    <svg width="200" height="200" fill="none" viewbox="0 0 200 200" :x="this.getX(this.$props.from)"
        :y="this.getY(this.$props.from)">
        <defs>
            <filter id="inner-shadow-from">
                <feOffset input="SourceAlpha" />
                <feGaussianBlur stdDeviation="30" result="blur" />
                <feFlood flood-color="rgba(255, 118, 0, 0.5)" result="color" />
                <feComposite operator="out" in="SourceGraphic" in2="blur" />
                <feComposite operator="in" in="color" />
                <feComposite operator="in" in2="SourceGraphic" />
            </filter>
        </defs>
        <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#inner-shadow-from)">
            <path d="M0,0H200V200H0Z" fill="#fff" />
        </g>
    </svg>

    <svg width="200" height="200" fill="none" viewbox="0 0 200 200" :x="this.getX(this.$props.to)"
        :y="this.getY(this.$props.to)">
        <defs>
            <filter id="inner-shadow-to">
                <feOffset input="SourceAlpha" />
                <feGaussianBlur stdDeviation="30" result="blur" />
                <feFlood flood-color="rgba(255, 118, 0, 1)" result="color" />
                <feComposite operator="out" in="SourceGraphic" in2="blur" />
                <feComposite operator="in" in="color" />
                <feComposite operator="in" in2="SourceGraphic" />
            </filter>
        </defs>
        <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#inner-shadow-to)">
            <path d="M0,0H200V200H0Z" fill="#fff" />
        </g>
    </svg>
</template>
  
<script>
export default {
    mounted() {
        console.log(this.$props.to);
        console.log(this.$props.orientation);
        console.log("x", this.$props.orientation ? (this.$props.to.charCodeAt(0) - 97) * 200 : 7 - (this.$props.to.charCodeAt(0) - 97) * 200);
        console.log("y", this.$props.orientation ? (this.$props.to[1] - 1) * 200 : 8 - this.$props.to[1] - 97 * 200)
    },

    props: {
        to: {
            type: String,
            default: ""
        },

        from: {
            type: String,
            default: ""
        },

        orientation: {
            type: Number,
            default: 1
        },

        theme: {
            type: Number,
            default: 1
        },
    },

    methods: {
        getX(san) {
            return this.$props.orientation ? (san.charCodeAt(0) - 97) * 200 : (7 - san.charCodeAt(0) + 97) * 200;
        },
        getY(san) {
            return this.$props.orientation ? (8 - san[1]) * 200 : (san[1] - 1) * 200;
        }
    }
}

</script>