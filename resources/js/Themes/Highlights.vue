<template>
    <template v-if="this.$props.theme == 2">
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
                    <rect id="to-filter-rect" data-name="Rectangle 16" width="150" height="150"
                        transform="translate(90 90)" />
                </g>
                <rect id="Rectangle_17" data-name="Rectangle 17" width="200" height="200" transform="translate(7003 5588)"
                    fill="none" />
            </g>
        </svg>
    </template>
    <template v-else-if="this.$props.theme == 1">
        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200" :x="this.getX(this.$props.to)" :y="this.getY(this.$props.to)">
            <g id="Group_110" data-name="Group 110" transform="translate(-8896 -3124)">
                <rect id="Rectangle_31" data-name="Rectangle 31" width="200" height="200" transform="translate(8896 3124)"
                    fill="none" />
                <path id="Path_323" data-name="Path 323"
                    d="M7228.461,3542.9s17.361-4.816,50.356-4.572,48.871,4.984,81.623,5.549,49.838-1.92,49.838-1.92,2.357,8.835,2.729,54.42c.158,19.328-4.966,44.933-5.441,68.776a339.556,339.556,0,0,0,4.2,59.146s4.288,4.069-41.5,4.018c-21.384-.024-53.208-8.674-81.771-9.657a253.845,253.845,0,0,0-59.886,5.437s-5.56-14.639-5.6-60.51c-.019-23.486,5.741-55.336,7.15-80.833a212.946,212.946,0,0,0-1.7-42.142"
                    transform="translate(1677.988 -408.316)" fill="none" stroke="#43231d" stroke-width="5" />
            </g>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200" :x="this.getX(this.$props.from)" :y="this.getY(this.$props.from)">
            <g id="Group_110" data-name="Group 110" transform="translate(-8896 -3124)">
                <rect id="Rectangle_31" data-name="Rectangle 31" width="200" height="200" transform="translate(8896 3124)"
                    fill="none" />
                <path id="Path_323" data-name="Path 323"
                    d="M7228.461,3542.9s17.361-4.816,50.356-4.572,48.871,4.984,81.623,5.549,49.838-1.92,49.838-1.92,2.357,8.835,2.729,54.42c.158,19.328-4.966,44.933-5.441,68.776a339.556,339.556,0,0,0,4.2,59.146s4.288,4.069-41.5,4.018c-21.384-.024-53.208-8.674-81.771-9.657a253.845,253.845,0,0,0-59.886,5.437s-5.56-14.639-5.6-60.51c-.019-23.486,5.741-55.336,7.15-80.833a212.946,212.946,0,0,0-1.7-42.142"
                    transform="translate(1677.988 -408.316)" fill="none" stroke="#43231d" stroke-width="5" />
            </g>
        </svg>
    </template>
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