<template>
    <svg width="330" height="330" :x="this.getX(this.$props.from) - 60" :y="this.getY(this.$props.from) - 60"
        viewBox="0 0 330 330">
        <defs>
            <filter id="Rectangle_16" x="0" y="0" width="330" height="330" filterUnits="userSpaceOnUse">
                <feOffset input="SourceAlpha" />
                <feGaussianBlur stdDeviation="60" result="blur" />
                <feFlood flood-color="#ff7600" :flood-opacity="isWhiteSquare(this.$props.from) ? '0.4' : '0.6'" />
                <feComposite operator="in" in2="blur" />
            </filter>
        </defs>
        <g id="Group_98" data-name="Group 98" transform="translate(0 0)">
            <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Rectangle_16)">
                <rect id="Rectangle_16-2" data-name="Rectangle 16" width="150" height="150" transform="translate(90 90)"
                    fill="#fff" />
            </g>
            <rect id="Rectangle_17" data-name="Rectangle 17" width="200" height="200" transform="translate(7003 5588)"
                fill="none" />
        </g>
    </svg>

    <svg width="330" height="330" :x="this.getX(this.$props.to) - 60" :y="this.getY(this.$props.to) - 60"
        viewBox="0 0 330 330">
        <defs>
            <filter id="to_filter" x="0" y="0" width="330" height="330" filterUnits="userSpaceOnUse">
                <feOffset input="SourceAlpha" />
                <feGaussianBlur stdDeviation="40" result="blur" />
                <feFlood flood-color="#ff7600" flood-opacity="1" />
                <feComposite operator="in" in2="blur" />
            </filter>
        </defs>
        <g id="Group_98" data-name="Group 98" transform="translate(0 0)">
            <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#to_filter)">
                <rect id="to-filter-rect" data-name="Rectangle 16" width="150" height="150" transform="translate(90 90)" />
            </g>
            <rect id="Rectangle_17" data-name="Rectangle 17" width="200" height="200" transform="translate(7003 5588)"
                fill="none" />
        </g>
    </svg>

    <!--     <svg width="200" height="200" viewBox="0 0 200 200" :x="this.getX(this.$props.from)" :y="this.getY(this.$props.from)">
        <defs>
            <filter id="Rectangle_16" x="0" y="0" width="200" height="200" filterUnits="userSpaceOnUse">
                <feOffset input="SourceAlpha" />
                <feGaussianBlur stdDeviation="20" result="blur" />
                <feFlood flood-color="#ff7600" flood-opacity="0.4" />
                <feComposite operator="in" in2="blur" />
            </filter>
        </defs>
        <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Rectangle_16)">
            <rect id="Rectangle_16-2" data-name="Rectangle 16" width="200" height="200" fill="#fff" />
        </g>
    </svg>

    <svg width="200" height="200" fill="none" viewbox="0 0 200 200" :x="this.getX(this.$props.to)"
        :y="this.getY(this.$props.to)">
        <defs>
            <filter id="inner-shadow-to">
                <feOffset input="SourceAlpha" />
                <feGaussianBlur stdDeviation="50" result="blur" />
                <feFlood
                    :flood-color="this.isWhiteSquare(this.$props.to) ? 'rgba(255, 118, 0, 0.7)' : 'rgba(255, 118, 0, 1)'"
                    result="color" />
                <feComposite operator="out" in="SourceGraphic" in2="blur" />
                <feComposite operator="in" in="color" />
                <feComposite operator="in" in2="SourceGraphic" />
            </filter>
        </defs>
        <g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#inner-shadow-to)">
            <path d="M0,0H200V200H0Z" fill="#fff" />
        </g>
    </svg> -->
</template>
  
<script>
export default {
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
        },
        isWhiteSquare(san) {
            return (san.charCodeAt(0) - 97 + san[1]) % 2 == 2;
        }
    }
}

</script>